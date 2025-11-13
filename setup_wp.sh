set -euo pipefail

# ----- Config -----
REPO_URL="https://github.com/Black10998/ep-backup.git"
ROOT="$HOME/workspace"
APP="$ROOT/wpstack"
OLDSITE="$ROOT/oldsite"
THEME_SLUG="omnesolution-pro"
THEME_DIR="$APP/wpdata/wp-content/themes/$THEME_SLUG"

mkdir -p "$ROOT" && cd "$ROOT"

# ----- Tools -----
command -v docker >/dev/null || { echo "❌ Docker not found."; exit 1; }
for pkg in unzip rsync python3; do command -v $pkg >/dev/null || { sudo apt-get update -y && sudo apt-get install -y $pkg; }; done
command -v base64 >/dev/null || { echo "❌ base64 missing"; exit 1; }

# ----- Get mirrored ZIP from GitHub (ep-backup) -----
[ -d ep-backup ] || git clone "$REPO_URL"
cd ep-backup
ZIP="$(ls -1 *.zip | head -n1)"
[ -f "$ZIP" ] || { echo "❌ No ZIP found in ep-backup repo (upload your mirrored site ZIP, e.g. elektriker-pohl_Backup.zip)."; exit 1; }

rm -rf "$OLDSITE" && mkdir -p "$OLDSITE"
unzip -o "$ZIP" -d "$OLDSITE" >/dev/null
INDEX="$(find "$OLDSITE" -type f -iname index.html | head -n1)"
[ -f "$INDEX" ] || { echo "❌ index.html not found inside ZIP."; exit 1; }
MIR_DIR="$(dirname "$INDEX")"

# ----- Dockerized WordPress (German) -----
mkdir -p "$APP"
cat > "$APP/docker-compose.yml" <<'YML'
version: "3.9"
services:
  db:
    image: mariadb:11
    environment:
      MYSQL_DATABASE: wp_de
      MYSQL_USER: wp
      MYSQL_PASSWORD: wp
      MYSQL_ROOT_PASSWORD: root
    volumes: [ "dbdata:/var/lib/mysql" ]
  wp:
    image: wordpress:php8.2-apache
    depends_on: [ db ]
    environment:
      WORDPRESS_DB_HOST: db
      WORDPRESS_DB_USER: wp
      WORDPRESS_DB_PASSWORD: wp
      WORDPRESS_DB_NAME: wp_de
    ports: [ "8080:80" ]
    volumes: [ "wpdata:/var/www/html" ]
  cli:
    image: wordpress:cli-php8.2
    depends_on: [ wp ]
    environment:
      WORDPRESS_DB_HOST: db
      WORDPRESS_DB_USER: wp
      WORDPRESS_DB_PASSWORD: wp
      WORDPRESS_DB_NAME: wp_de
    volumes:
      - wpdata:/var/www/html
      - ../oldsite:/oldsite
volumes: { dbdata: {}, wpdata: {} }
YML

docker compose -f "$APP/docker-compose.yml" up -d
sleep 10
wp(){ docker compose -f "$APP/docker-compose.yml" run --rm cli wp "$@"; }

# ----- WP Core (German) -----
if ! wp core is-installed --path=/var/www/html >/dev/null 2>&1; then
  wp core download --locale=de_DE --force
  wp config create --dbname=wp_de --dbuser=wp --dbpass=wp --dbhost=db --skip-check
  wp core install --url="http://localhost:8080" --title="omnesolution" \
    --admin_user="admin" --admin_password="StrongAdmin!123" --admin_email="admin@example.com"
fi
wp option update blogdescription "Personal- & Staffing-Lösungen"
wp option update timezone_string "Europe/Vienna"
wp rewrite structure "/%postname%/" --hard
wp language core install de_DE --activate
wp option update WPLANG "de_DE"
wp plugin install classic-editor contact-form-7 yoast-seo wp-mail-smtp redirection health-check --activate

# ----- Theme skeleton -----
docker compose -f "$APP/docker-compose.yml" exec -T wp bash -lc "mkdir -p $THEME_DIR/assets/root $THEME_DIR/inc $THEME_DIR/patterns $THEME_DIR/template-parts $THEME_DIR/page-templates"

# style.css
docker compose -f "$APP/docker-compose.yml" exec -T wp bash -lc "cat > $THEME_DIR/style.css <<'CSS'
/*
Theme Name: omnesolution-pro
Theme URI: https://omnesolution.at
Author: PAX
Version: 1.2.0
Text Domain: omnesolution
*/
:root{--brand:#0a3a81;--brand-2:#0e62ff;--accent:#0bb39b;--ink:#0e1420;--surface:#ffffff;--container:1100px;--radius:16px;}
CSS"

# theme.json (global styles)
docker compose -f "$APP/docker-compose.yml" exec -T wp bash -lc "cat > $THEME_DIR/theme.json <<'JSON'
{
  "$schema": "https://schemas.wp.org/trunk/theme.json",
  "version": 2,
  "settings": {
    "color": {
      "palette": [
        {"slug":"brand","name":"Brand","color":"#0a3a81"},
        {"slug":"brand-2","name":"Brand 2","color":"#0e62ff"},
        {"slug":"accent","name":"Accent","color":"#0bb39b"},
        {"slug":"ink","name":"Ink","color":"#0e1420"},
        {"slug":"surface","name":"Surface","color":"#ffffff"}
      ],
      "custom": true
    },
    "typography": {
      "fontFamilies": [
        {"fontFamily":"Inter, ui-sans-serif, system-ui, -apple-system, Segoe UI, Roboto, Arial, sans-serif","name":"Inter/Default","slug":"inter"}
      ],
      "customFontSize": true
    },
    "layout": { "contentSize": "1100px", "wideSize": "1400px" }
  },
  "styles": {
    "color": { "text": "var(--wp--preset--color--ink)", "background": "var(--wp--preset--color--surface)" },
    "typography": { "fontFamily": "var(--wp--preset--font-family--inter)" }
  }
}
JSON"

# functions.php (menus, supports, customizer vars, CPT Jobs, shortcode, register patterns cat)
docker compose -f "$APP/docker-compose.yml" exec -T wp bash -lc "cat > $THEME_DIR/functions.php <<'PHP'
<?php
if (!defined('ABSPATH')) exit;

// Theme supports + Menus
add_action('after_setup_theme', function(){
  add_theme_support('title-tag');
  add_theme_support('post-thumbnails');
  add_theme_support('editor-styles');
  add_theme_support('wp-block-styles');
  register_nav_menus([
    'primary' => __('Hauptmenü','omnesolution'),
    'footer'  => __('Footer Menü','omnesolution'),
  ]);
});

// Customizer (colors/layout)
add_action('customize_register', function($c){
  $c->add_section('omnes_pro_brand',['title'=>__('Corporate Design','omnesolution'),'priority'=>30]);
  $fields=[
    'primary_color' => ['#0a3a81','Primärfarbe'],
    'primary_2'     => ['#0e62ff','Primärfarbe 2'],
    'accent_color'  => ['#0bb39b','Akzent'],
    'ink_color'     => ['#0e1420','Textfarbe'],
    'surface_color' => ['#ffffff','Hintergrund']
  ];
  foreach($fields as $id=>$cfg){
    $c->add_setting($id,['default'=>$cfg[0],'sanitize_callback'=>'sanitize_hex_color']);
    $c->add_control(new WP_Customize_Color_Control($c,$id,['label'=>__($cfg[1],'omnesolution'),'section'=>'omnes_pro_brand']));
  }
  $c->add_section('omnes_pro_layout',['title'=>__('Layout','omnesolution'),'priority'=>31]);
  $c->add_setting('container_width',['default'=>'1100px','sanitize_callback'=>'sanitize_text_field']);
  $c->add_control('container_width',['label'=>__('Content Width','omnesolution'),'type'=>'text','section'=>'omnes_pro_layout']);
  $c->add_setting('border_radius',['default'=>'16px','sanitize_callback'=>'sanitize_text_field']);
  $c->add_control('border_radius',['label'=>__('Border Radius','omnesolution'),'type'=>'text','section'=>'omnes_pro_layout']);
});
add_action('wp_head', function(){
  printf('<style>:root{--brand:%1$s;--brand-2:%2$s;--accent:%3$s;--ink:%4$s;--surface:%5$s;--container:%6$s;--radius:%7$s}</style>',
    esc_attr(get_theme_mod('primary_color','#0a3a81')),
    esc_attr(get_theme_mod('primary_2','#0e62ff')),
    esc_attr(get_theme_mod('accent_color','#0bb39b')),
    esc_attr(get_theme_mod('ink_color','#0e1420')),
    esc_attr(get_theme_mod('surface_color','#ffffff')),
    esc_attr(get_theme_mod('container_width','1100px')),
    esc_attr(get_theme_mod('border_radius','16px'))
  );
});

// CPT Jobs + taxonomies + shortcode
add_action('init', function(){
  register_post_type('job',[
    'labels'=>['name'=>__('Jobs','omnesolution'),'singular_name'=>__('Job','omnesolution')],
    'public'=>true,'has_archive'=>true,'menu_icon'=>'dashicons-id',
    'supports'=>['title','editor','excerpt','custom-fields','revisions','thumbnail'],
    'rewrite'=>['slug'=>'jobs'],'show_in_rest'=>true
  ]);
  register_taxonomy('standort','job',['label'=>__('Standort','omnesolution'),'public'=>true,'hierarchical'=>false,'show_in_rest'=>true]);
  register_taxonomy('bereich','job',['label'=>__('Bereich','omnesolution'),'public'=>true,'hierarchical'=>true,'show_in_rest'=>true]);
});
add_shortcode('jobs_grid', function(){
  $q=new WP_Query(['post_type'=>'job','posts_per_page'=>9]);
  ob_start(); echo '<div class="jobs-grid" style="display:grid;grid-template-columns:repeat(auto-fit,minmax(260px,1fr));gap:20px">';
  if($q->have_posts()){ while($q->have_posts()){ $q->the_post();
    echo '<article class="card" style="border:1px solid #e5e7eb;border-radius:var(--radius);padding:16px;background:#fff">';
    if(has_post_thumbnail()){ the_post_thumbnail('large',['style'=>'border-radius:10px;margin-bottom:10px','loading'=>'lazy','decoding'=>'async']); }
    echo '<h3 style="margin:6px 0 8px">'.esc_html(get_the_title()).'</h3>';
    $loc=get_the_term_list(get_the_ID(),'standort','',' , ',''); $cat=get_the_term_list(get_the_ID(),'bereich','',' , ','');
    echo '<p style="color:#5f6b7e">'.($loc?wp_kses_post($loc).' · ':'').($cat?wp_kses_post($cat):'').'</p>';
    echo '<a class="btn" href="'.esc_url(get_permalink()).'" style="display:inline-flex;gap:8px;padding:8px 12px;border:1px solid #e5e7eb;border-radius:10px;text-decoration:none">'.__('Details','omnesolution').'</a>';
    echo '</article>';
  }} else { echo '<p>'.__('Derzeit keine offenen Stellen.','omnesolution').'</p>'; }
  echo '</div>'; wp_reset_postdata(); return ob_get_clean();
});

// Register pattern category
add_action('init', function(){ register_block_pattern_category('omnesolution',['label'=>'omnesolution']); });

// Runtime filter: rewrite relative src/href -> theme assets/root (safety net)
add_action('template_redirect', function(){
  ob_start(function($html){
    $base = get_stylesheet_directory_uri().'/assets/root/';
    return preg_replace('~(src|href)="(?!https?://|/)([^"]+)"~i', '$1="'.$base.'$2"', $html);
  });
});
PHP"

# ----- Patterns (Hero, Services, Jobs, Contact) -----
docker compose -f "$APP/docker-compose.yml" exec -T wp bash -lc "cat > $THEME_DIR/patterns/hero.php <<'PHP'
<?php
/**
 * Title: Corporate Hero
 * Slug: omnesolution/hero
 * Categories: featured
 */
?>
<!-- wp:group {\"style\":{\"spacing\":{\"padding\":{\"top\":\"40px\",\"bottom\":\"40px\"}}}} -->
<div class="wp-block-group" style="padding-top:40px;padding-bottom:40px">
  <!-- wp:heading {\"level\":2} --><h2>Talente, die liefern. Prozesse, die halten.</h2><!-- /wp:heading -->
  <!-- wp:paragraph --><p>Besetzung von Fach- &amp; Führungskräften – schnell, transparent, messbar.</p><!-- /wp:paragraph -->
  <!-- wp:buttons --><div class="wp-block-buttons">
    <!-- wp:button {\"backgroundColor\":\"brand-2\"} --><div class="wp-block-button"><a class="wp-block-button__link has-brand-2-background-color has-background" href="#leistungen">Für Unternehmen</a></div><!-- /wp:button -->
    <!-- wp:button {\"className\":\"is-style-outline\"} --><div class="wp-block-button is-style-outline"><a class="wp-block-button__link" href="#jobs">Für Bewerbende</a></div><!-- /wp:button -->
  </div><!-- /wp:buttons -->
</div>
<!-- /wp:group -->
PHP"

docker compose -f "$APP/docker-compose.yml" exec -T wp bash -lc "cat > $THEME_DIR/patterns/services.php <<'PHP'
<?php
/**
 * Title: Leistungen Grid
 * Slug: omnesolution/services
 * Categories: text, columns
 */
?>
<!-- wp:columns -->
<div class="wp-block-columns">
  <!-- wp:column --><div class="wp-block-column"><!-- wp:heading {\"level\":4} --><h4>Zeitarbeit</h4><!-- /wp:heading --><!-- wp:paragraph --><p>Flexible Kapazitäten ohne Risiko.</p><!-- /wp:paragraph --></div><!-- /wp:column -->
  <!-- wp:column --><div class="wp-block-column"><!-- wp:heading {\"level\":4} --><h4>Personalvermittlung</h4><!-- /wp:heading --><!-- wp:paragraph --><p>Direktbesetzung von Fach-/Führungskräften.</p><!-- /wp:paragraph --></div><!-- /wp:column -->
  <!-- wp:column --><div class="wp-block-column"><!-- wp:heading {\"level\":4} --><h4>Payrolling</h4><!-- /wp:heading --><!-- wp:paragraph --><p>Komplette Abwicklung aus einer Hand.</p><!-- /wp:paragraph --></div><!-- /wp:column -->
</div>
<!-- /wp:columns -->
PHP"

docker compose -f "$APP/docker-compose.yml" exec -T wp bash -lc "cat > $THEME_DIR/patterns/jobs.php <<'PHP'
<?php
/**
 * Title: Jobs (Shortcode)
 * Slug: omnesolution/jobs
 * Categories: widgets
 */
?>
<!-- wp:shortcode -->[jobs_grid]<!-- /wp:shortcode -->
PHP"

docker compose -f "$APP/docker-compose.yml" exec -T wp bash -lc "cat > $THEME_DIR/patterns/contact.php <<'PHP'
<?php
/**
 * Title: Kontakt
 * Slug: omnesolution/contact
 * Categories: text
 */
?>
<!-- wp:group -->
<div class="wp-block-group">
  <!-- wp:heading {\"level\":3} --><h3>Kontakt</h3><!-- /wp:heading -->
  <!-- wp:paragraph --><p>Schreiben Sie uns: <a href=\"mailto:info@yourdomain.at\">info@yourdomain.at</a></p><!-- /wp:paragraph -->
  <!-- wp:shortcode -->[contact-form-7 id=\"1\" title=\"Kontakt\"]<!-- /wp:shortcode -->
</div>
<!-- /wp:group -->
PHP"

# ----- Extract <head>/<body> from mirrored index + relative paths patch + Base64 -----
export INDEX ROOT
python3 - <<'PY'
import re,os
idx=os.environ['INDEX']; root=os.environ['ROOT']
html=open(idx,'r',encoding='utf-8',errors='ignore').read()
H=re.search(r'<head[^>]*>(.*?)</head>',html,flags=re.S|re.I)
B=re.search(r'<body[^>]*>(.*?)</body>',html,flags=re.S|re.I)
head=H.group(1) if H else ""; body=B.group(1) if B else ""
# Patch relative src/href -> assets/root (compile-time patch)
import re as R
def fix(txt):
  return R.sub(r'((?:src|href)=["\'])(?!https?://|/)([^"\']+)["\']',
               r'\1<?php echo get_stylesheet_directory_uri(); ?>/assets/root/\2"',
               txt)
open(root+'/HEAD.part','w',encoding='utf-8').write(fix(head))
open(root+'/BODY.part','w',encoding='utf-8').write(fix(body))
PY
B64_HEAD="$(base64 -w0 "$ROOT/HEAD.part")"
B64_BODY="$(base64 -w0 "$ROOT/BODY.part")"

# Copy ALL mirrored assets into theme
rsync -a "$MIR_DIR"/ "$APP/wpdata/wp-content/themes/$THEME_SLUG/assets/root"/ >/dev/null 2>&1 || true

# header / front-page / footer (Pixel-Perfect)
docker compose -f "$APP/docker-compose.yml" exec -T wp bash -lc "cat > $THEME_DIR/header.php <<'PHP'
<!doctype html><html <?php language_attributes(); ?>><head>
<meta charset="<?php bloginfo('charset'); ?>">
<?php echo base64_decode("REPLACE_HEAD_BASE64"); ?>
<?php wp_head(); ?>
</head>
<?php $classes = get_body_class(); ?><body class="<?php echo esc_attr(implode(' ', $classes)); ?>">
PHP"
docker compose -f "$APP/docker-compose.yml" exec -T wp bash -lc "cat > $THEME_DIR/front-page.php <<'PHP'
<?php get_header(); ?>
<base href="<?php echo get_stylesheet_directory_uri(); ?>/assets/root/">
<?php echo base64_decode('REPLACE_BODY_BASE64'); ?>
<?php get_footer(); ?>
PHP"
docker compose -f "$APP/docker-compose.yml" exec -T wp bash -lc "cat > $THEME_DIR/footer.php <<'PHP'
<?php wp_footer(); ?></body></html>
PHP"
docker compose -f "$APP/docker-compose.yml" exec -T wp bash -lc "sed -i \"s|REPLACE_HEAD_BASE64|$B64_HEAD|\" $THEME_DIR/header.php"
docker compose -f "$APP/docker-compose.yml" exec -T wp bash -lc "sed -i \"s|REPLACE_BODY_BASE64|$B64_BODY|\" $THEME_DIR/front-page.php"

# ----- Editable home template (Blocks) -----
docker compose -f "$APP/docker-compose.yml" exec -T wp bash -lc "cat > $THEME_DIR/page-templates/home-blocks.php <<'PHP'
<?php /* Template Name: Startseite (Blocks) */ get_header(); ?>
<main class="site-main" style="max-width:var(--container,1100px);margin:40px auto;padding:0 16px">
  <?php if (have_posts()) { while(have_posts()){ the_post();
    if (trim(get_the_content())==='') {
      $content = '<!-- wp:pattern {\"slug\":\"omnesolution/hero\"} /--><!-- wp:spacer {\"height\":\"20px\"} /--><!-- wp:pattern {\"slug\":\"omnesolution/services\"} /--><!-- wp:spacer {\"height\":\"20px\"} /--><!-- wp:pattern {\"slug\":\"omnesolution/jobs\"} /--><!-- wp:spacer {\"height\":\"20px\"} /--><!-- wp:pattern {\"slug\":\"omnesolution/contact\"} /-->';
      wp_update_post(['ID'=>get_the_ID(),'post_content'=>$content]); echo apply_filters('the_content',$content);
    } else { the_content(); }
  } } ?>
</main>
<?php get_footer(); ?>
PHP"

# ----- Pages (German) + set Editable as front page -----
wp theme activate "$THEME_SLUG"
wp option update show_on_front "page"
HP_PIXEL=$(wp post create --post_type=page --post_title="Startseite" --post_status=publish --porcelain)
HP_EDIT=$(wp post create --post_type=page --post_title="Startseite (Bearbeitbar)" --post_name="startseite-bearbeitbar" --post_status=publish --porcelain)
wp post meta set "$HP_EDIT" _wp_page_template "page-templates/home-blocks.php" >/dev/null
wp option update page_on_front "$HP_EDIT"
for P in "Über uns" "Leistungen" "Jobs" "Kontakt" "Datenschutz" "Impressum"; do
  wp post create --post_type=page --post_title="$P" --post_status=publish >/dev/null 2>&1 || true
done

# ----- Menu -----
wp menu create "Hauptmenü" || true
wp menu location assign "Hauptmenü" primary || true
wp menu item add-post "Hauptmenü" "$HP_EDIT" || true
wp menu item add-custom "Hauptmenü" "Leistungen" "/#leistungen" || true
wp menu item add-custom "Hauptmenü" "Jobs" "/jobs/" || true
wp menu item add-custom "Hauptmenü" "Kontakt" "/kontakt/" || true

# ----- Contact Form ID patch -----
wp plugin is-installed contact-form-7 && {
  wp post create --post_type="wpcf7_contact_form" --post_title="Kontakt" --post_status=publish >/dev/null 2>&1 || true
  CFID="$(wp post list --post_type=wpcf7_contact_form --format=ids | head -n1 || true)"
  if [ -n "$CFID" ]; then
    docker compose -f "$APP/docker-compose.yml" exec -T wp bash -lc "sed -i \"s/id=\\\"1\\\"/id=\\\"$CFID\\\"/\" $THEME_DIR/patterns/contact.php"
  fi
}

# ----- Admin toggle (Design → Startseite Modus) -----
docker compose -f "$APP/docker-compose.yml" exec -T wp bash -lc "cat > $THEME_DIR/inc/home-toggle.php <<'PHP'
<?php
if (!defined('ABSPATH')) exit;
add_action('admin_menu', function(){
  add_theme_page(__('Startseite Modus','omnesolution'), __('Startseite Modus','omnesolution'), 'manage_options', 'omnes-home-mode', function(){
    if(isset($_POST['omnes_mode']) && check_admin_referer('omnes_mode')){
      $mode = $_POST['omnes_mode']==='pixel' ? 'pixel' : 'blocks';
      update_option('omnes_home_mode',$mode);
      $pixel = get_page_by_title('Startseite');
      $blocks = get_page_by_path('startseite-bearbeitbar');
      if($mode==='pixel' && $pixel){ update_option('show_on_front','page'); update_option('page_on_front',$pixel->ID); }
      if($mode==='blocks' && $blocks){ update_option('show_on_front','page'); update_option('page_on_front',$blocks->ID); }
      echo '<div class=\"updated\"><p>'.__('Gespeichert.','omnesolution').'</p></div>';
    }
    $current = get_option('omnes_home_mode','blocks');
    echo '<div class=\"wrap\"><h1>'.esc_html__('Startseite Modus','omnesolution').'</h1>';
    echo '<form method=\"post\">'; wp_nonce_field('omnes_mode');
    echo '<p><label><input type=\"radio\" name=\"omnes_mode\" value=\"blocks\"'.checked($current,'blocks',false).'/> '.__('Blocks (bearbeitbar)','omnesolution').'</label></p>';
    echo '<p><label><input type=\"radio\" name=\"omnes_mode\" value=\"pixel\"'.checked($current,'pixel',false).'/> '.__('Pixel-Perfect (1:1)','omnesolution').'</label></p>';
    submit_button(__('Speichern','omnesolution')); echo '</form></div>';
  });
});
PHP"
docker compose -f "$APP/docker-compose.yml" exec -T wp bash -lc "php -r '
$f="${THEME_DIR}/functions.php";
$s=file_get_contents($f);
if (strpos($s,"inc/home-toggle.php")===false) { $s .= "\nrequire_once get_template_directory().'/' . 'inc/home-toggle.php';\n"; file_put_contents($f,$s); }
' >/dev/null"

echo
echo "✅ Ready! Site: http://localhost:8080  (WP Admin: admin / StrongAdmin!123)"
echo "🏠 Home (default): Startseite (Bearbeitbar)  — Pixel-Perfect page also created as 'Startseite'."
echo "🔀 Toggle: WP-Admin → Design → Startseite Modus (Pixel-Perfect / Blocks)"
echo "📂 Mirrored assets inside theme: wp-content/themes/${THEME_SLUG}/assets/root/"

