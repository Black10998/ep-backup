# EP Restore Theme PRO

## Beschreibung

Dies ist die **PROFESSIONAL VERSION** - eine vollständig **dynamische, ACF-gesteuerte** 1:1 Wiederherstellung des Elektriker Pohl Designs aus dem Website-Backup. Das Theme wurde vollständig in deutschem Text erstellt und behält alle ursprünglichen Design-Elemente, Layouts und Inhalte bei.

**Version 3.0.0 - PRO Edition:**
- ✅ Vollständig dynamisch mit Advanced Custom Fields (ACF)
- ✅ Alle Texte und Bilder über WordPress-Admin editierbar
- ✅ ACF Options Page für globale Einstellungen
- ✅ Repeater-Felder für flexible Inhalte
- ✅ Fallback-Werte aus dem Original-Backup
- ✅ Content-Import via WXR-Datei
- ✅ Professionelle Theme-Struktur
- ✅ Optimiert für Produktionsumgebungen
- ✅ Vollständige Dokumentation
- ✅ Unabhängiges, eigenständiges Theme

## Theme-Struktur

### Hauptdateien
- `style.css` - Haupt-Stylesheet mit WordPress Theme-Header
- `functions.php` - Theme-Funktionen und Setup
- `header.php` - Header-Template mit Logo und Navigation
- `footer.php` - Footer-Template mit Links und Copyright
- `front-page.php` - Homepage-Template
- `index.php` - Standard-Template für Archiv-Seiten
- `page.php` - Template für statische Seiten
- `single.php` - Template für einzelne Beiträge

### Template Parts
- `template-parts/services.php` - Dienstleistungen-Sektion
- `template-parts/about.php` - Über-uns-Sektion
- `template-parts/contact.php` - Kontakt-Sektion mit Formular
- `template-parts/problems.php` - Typische Probleme-Sektion

### Assets
- `assets/css/` - Zusätzliche Stylesheets (falls benötigt)
- `assets/js/main.js` - JavaScript für Interaktivität
- `assets/img/` - Alle Bilder vom Original-Backup

## Features

### Design
- ✅ 1:1 identisches Layout zum Original
- ✅ Gleiche Farben, Schriften und Abstände
- ✅ Responsive Design für alle Geräte
- ✅ Sticky Header mit Logo und Telefon-Button
- ✅ Mobile Sticky Buttons am unteren Bildschirmrand

### Inhalte (100% Deutsch)
- ✅ Hero-Sektion mit Hauptüberschrift und Features
- ✅ Dienstleistungen-Sektion mit 3 Service-Boxen
- ✅ Über-uns-Sektion mit Bild
- ✅ Kontaktformular-Sektion
- ✅ Typische Probleme-Sektion
- ✅ Footer mit Links zu Impressum und Datenschutz

### Funktionalität
- ✅ Kontaktformular mit E-Mail-Versand
- ✅ Telefon-Links (tel:+4915777406869)
- ✅ Smooth Scrolling zu Ankern
- ✅ Formular-Validierung
- ✅ WordPress-Standard-Features (Custom Logo, Menüs, etc.)

## Installation

### Voraussetzungen
- WordPress 6.0 oder höher (getestet bis 6.8)
- PHP 7.4 oder höher
- **Advanced Custom Fields (ACF) Plugin** (kostenlose Version ausreichend)

### Theme-Informationen
- **Theme Name:** EP Restore Theme PRO
- **Version:** 3.0.0
- **Author:** ELEKTRO RECHBERGER GmbH
- **Author URI:** https://elektro-rechberger.at
- **Text Domain:** ep-restore-theme-pro

### Schritt-für-Schritt Anleitung

#### 1. WordPress lokal installieren
Verwenden Sie LocalWP, XAMPP, MAMP oder eine andere lokale WordPress-Umgebung:
- Laden Sie LocalWP herunter: https://localwp.com/
- Erstellen Sie eine neue WordPress-Site
- Notieren Sie sich die Admin-Zugangsdaten

#### 2. ACF Plugin installieren
1. Gehen Sie zu **Plugins → Installieren**
2. Suchen Sie nach "Advanced Custom Fields"
3. Installieren und aktivieren Sie das Plugin (kostenlose Version)

#### 3. Theme hochladen und aktivieren
1. Laden Sie den Ordner `ep-restore-theme-pro` in `wp-content/themes/` hoch
2. Gehen Sie zu **Design → Themes**
3. Aktivieren Sie "EP Restore Theme PRO"

#### 4. Content importieren
1. Gehen Sie zu **Werkzeuge → Daten importieren**
2. Installieren Sie den "WordPress Importer" falls noch nicht vorhanden
3. Klicken Sie auf "WordPress"
4. Wählen Sie die Datei `content-export.xml` aus dem Theme-Ordner
5. Klicken Sie auf "Datei hochladen und importieren"
6. Wählen Sie einen Autor oder erstellen Sie einen neuen
7. Aktivieren Sie "Anhänge herunterladen und importieren"
8. Klicken Sie auf "Absenden"

#### 5. Startseite festlegen
1. Gehen Sie zu **Einstellungen → Lesen**
2. Wählen Sie "Eine statische Seite"
3. Wählen Sie "Startseite" als Homepage
4. Speichern Sie die Änderungen

#### 6. ACF-Felder werden automatisch geladen
Die ACF-Feldgruppen werden automatisch aus dem `acf-json` Ordner geladen.
Sie sollten jetzt folgende Feldgruppen sehen:
- EP Global Settings (Options Page)
- Homepage - Hero Section
- Homepage - Services Section
- Homepage - About Section
- Homepage - Contact Section
- Homepage - Problems Section

#### 7. Inhalte anpassen (optional)
1. Gehen Sie zu **Design → EP Theme Settings** für globale Einstellungen
2. Bearbeiten Sie die Startseite unter **Seiten → Startseite** für seitenspezifische Inhalte

## Inhalte bearbeiten

### Globale Einstellungen (Header, Footer, etc.)
1. Gehen Sie zu **Design → EP Theme Settings**
2. Hier können Sie bearbeiten:
   - **Company Name:** Firmenname
   - **Phone Number:** Telefonnummer (Anzeige)
   - **Phone Link:** Telefonnummer für tel:-Links
   - **Topbar Text:** Text in der oberen schwarzen Leiste
   - **Logo Image:** Firmenlogo hochladen
   - **Footer Copyright Text:** Copyright-Text im Footer
   - **Impressum URL:** Link zur Impressum-Seite
   - **Datenschutz URL:** Link zur Datenschutz-Seite

### Homepage-Inhalte bearbeiten
1. Gehen Sie zu **Seiten → Startseite → Bearbeiten**
2. Scrollen Sie nach unten zu den ACF-Feldgruppen:

#### Hero Section
- **Hero Heading:** Hauptüberschrift
- **Hero Subheading:** Unterüberschrift
- **Hero Intro Text:** Einleitungstext
- **Hero Image:** Hauptbild hochladen
- **Hero Features:** Feature-Liste (Repeater)
  - Klicken Sie auf "Add Feature" um Punkte hinzuzufügen

#### Services Section
- **Service 1/2/3 Title:** Titel der Service-Boxen
- **Service 1/2/3 Text:** Beschreibungstext

#### About Section
- **About Heading:** Überschrift
- **About Text:** Beschreibungstext
- **About Image:** Bild hochladen
- **About Features:** Feature-Liste (Repeater)

#### Contact Section
- **Contact Heading:** Überschrift
- **Contact Intro Text:** Einleitungstext
- **Contact Form Heading:** Formular-Überschrift

#### Problems Section
- **Problems Section Heading:** Überschrift
- **Problems Intro Text:** Einleitungstext
- **Problems List:** Problem/Lösung-Liste (Repeater)
  - **Problem Title:** Titel (z.B. "✅ Steckdose defekt")
  - **Problem Solution Text:** Lösungsbeschreibung

### Andere Seiten bearbeiten
- **Impressum:** Gehen Sie zu **Seiten → Impressum**
- **Datenschutz:** Gehen Sie zu **Seiten → Datenschutz**

### Farben anpassen
Falls Sie die Farben ändern möchten, bearbeiten Sie `style.css`:
- Hauptfarbe (Schwarz): `#1a1a1a`
- Akzentfarbe (Grün): `#61CE70`
- Textfarbe: `#666`

## Browser-Kompatibilität

- ✅ Chrome/Edge (neueste Versionen)
- ✅ Firefox (neueste Versionen)
- ✅ Safari (neueste Versionen)
- ✅ Mobile Browser (iOS Safari, Chrome Mobile)

## ACF-Feldgruppen Übersicht

Das Theme verwendet folgende ACF-Feldgruppen:

### 1. EP Global Settings (Options Page)
- **Location:** Design → EP Theme Settings
- **Felder:**
  - company_name (Text)
  - phone_number (Text)
  - phone_link (Text)
  - topbar_text (Text)
  - logo_image (Image)
  - footer_copyright (Text)
  - impressum_url (Page Link)
  - datenschutz_url (Page Link)

### 2. Homepage - Hero Section
- **Location:** Front Page
- **Felder:**
  - hero_heading (Text)
  - hero_subheading (Text)
  - hero_intro (Textarea)
  - hero_image (Image)
  - hero_features (Repeater)
    - feature_text (Text)

### 3. Homepage - Services Section
- **Location:** Front Page
- **Felder:**
  - service_1_title (Text)
  - service_1_text (Textarea)
  - service_2_title (Text)
  - service_2_text (Textarea)
  - service_3_title (Text)
  - service_3_text (Textarea)

### 4. Homepage - About Section
- **Location:** Front Page
- **Felder:**
  - about_heading (Text)
  - about_text (Textarea)
  - about_image (Image)
  - about_features (Repeater)
    - feature_text (Text)

### 5. Homepage - Contact Section
- **Location:** Front Page
- **Felder:**
  - contact_heading (Text)
  - contact_intro (Textarea)
  - contact_form_heading (Text)

### 6. Homepage - Problems Section
- **Location:** Front Page
- **Felder:**
  - problems_heading (Text)
  - problems_intro (Textarea)
  - problems_list (Repeater)
    - problem_title (Text)
    - problem_text (Textarea)

## Fallback-System

Das Theme funktioniert auch **ohne ACF**! Wenn ACF nicht installiert ist oder Felder leer sind, werden automatisch die Original-Texte aus dem Backup als Fallback verwendet.

## Troubleshooting

### ACF-Felder werden nicht angezeigt
1. Stellen Sie sicher, dass ACF installiert und aktiviert ist
2. Gehen Sie zu **Custom Fields** und prüfen Sie, ob die Feldgruppen vorhanden sind
3. Falls nicht, kopieren Sie die JSON-Dateien aus `acf-json/` manuell

### Bilder werden nicht angezeigt
1. Prüfen Sie, ob die Bilder im Ordner `assets/img/` vorhanden sind
2. Laden Sie Bilder über ACF-Felder hoch für dynamische Verwaltung

### Startseite zeigt nicht die richtige Vorlage
1. Gehen Sie zu **Einstellungen → Lesen**
2. Stellen Sie sicher, dass "Eine statische Seite" ausgewählt ist
3. Wählen Sie "Startseite" als Homepage

## Support

Bei Fragen oder Problemen:
1. Prüfen Sie die ACF-Dokumentation: https://www.advancedcustomfields.com/resources/
2. Überprüfen Sie die WordPress Debug-Logs
3. Kontaktieren Sie den Theme-Entwickler

## Changelog

### Version 1.0.0
- Initiale Veröffentlichung
- 1:1 Wiederherstellung des Original-Designs
- Alle Inhalte in Deutsch
- Vollständig responsive
- Kontaktformular integriert
