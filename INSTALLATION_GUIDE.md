# EP Restore Theme - Installation Guide

## 🎯 Quick Start (5 Steps)

### Step 1: Install WordPress Locally
1. Download and install [LocalWP](https://localwp.com/) (recommended)
2. Create a new WordPress site
3. Note your admin credentials

### Step 2: Install ACF Plugin
1. Login to WordPress admin
2. Go to **Plugins → Add New**
3. Search for "Advanced Custom Fields"
4. Install and activate the **free version**

### Step 3: Upload and Activate Theme
1. Download the theme from GitHub
2. Upload `ep-restore-theme` folder to `wp-content/themes/`
3. Go to **Appearance → Themes**
4. Click **Activate** on "EP Restore Theme"

### Step 4: Import Content
1. Go to **Tools → Import**
2. Click **WordPress** (install importer if needed)
3. Upload `content-export.xml` from the theme folder
4. Assign to an author or create new
5. Check "Download and import file attachments"
6. Click **Submit**

### Step 5: Set Homepage
1. Go to **Settings → Reading**
2. Select "A static page"
3. Choose "Startseite" as Homepage
4. Click **Save Changes**

## ✅ You're Done!

Your site should now look exactly like the original elektriker-pohl.de backup!

---

## 📝 Editing Content

### Global Settings (Header & Footer)
**Location:** Appearance → EP Theme Settings

Edit:
- Company name
- Phone number (display and link)
- Topbar text (24/7 message)
- Logo image
- Footer copyright text
- Impressum and Datenschutz page links

### Homepage Content
**Location:** Pages → Startseite → Edit

Scroll down to see ACF field groups:

#### Hero Section
- Main heading
- Subheading
- Intro text
- Hero image
- Feature list (add/remove items with "Add Feature" button)

#### Services Section
- Service 1/2/3 titles and descriptions

#### About Section
- Heading and text
- About image
- Feature list (repeater)

#### Contact Section
- Heading and intro text
- Form heading

#### Problems Section
- Section heading and intro
- Problems list (add/remove with "Add Problem" button)
  - Each problem has a title and solution text

### Other Pages
- **Impressum:** Pages → Impressum → Edit
- **Datenschutz:** Pages → Datenschutz → Edit

---

## 🔧 Troubleshooting

### ACF Fields Not Showing
**Solution:**
1. Make sure ACF plugin is installed and activated
2. Go to Custom Fields in admin menu
3. Check if field groups are present
4. If not, the JSON files should auto-sync from `acf-json/` folder

### Images Not Displaying
**Solution:**
1. Check if images exist in `assets/img/` folder
2. Upload new images via ACF image fields
3. Clear browser cache

### Homepage Not Using Front Page Template
**Solution:**
1. Settings → Reading
2. Make sure "A static page" is selected
3. Choose "Startseite" as Homepage
4. Save changes

### Content Not Imported
**Solution:**
1. Make sure WordPress Importer plugin is installed
2. Try importing `content-export.xml` again
3. Check if pages appear under Pages → All Pages

---

## 📊 What You Get

### Pages (3)
1. **Startseite** - Homepage with all sections
2. **Impressum** - Legal notice (German)
3. **Datenschutz** - Privacy policy (German)

### ACF Field Groups (6)
1. **EP Global Settings** - 8 fields for header/footer
2. **Homepage - Hero Section** - 5 fields including repeater
3. **Homepage - Services Section** - 6 fields for 3 services
4. **Homepage - About Section** - 4 fields including repeater
5. **Homepage - Contact Section** - 3 fields
6. **Homepage - Problems Section** - 3 fields including repeater

### Total Editable Fields: 30+

---

## 🎨 Design Notes

- **100% identical** to original backup
- **Fully responsive** (desktop, tablet, mobile)
- **German content** throughout
- **No translations needed** - everything is in German
- **Fallback system** - works even without ACF

---

## 📞 Support

If you encounter issues:
1. Check this guide first
2. Review README.md in theme folder
3. Check THEME_SUMMARY.md for technical details
4. Verify ACF plugin is active
5. Check WordPress debug logs

---

## 🚀 Next Steps

After installation:
1. Edit global settings (logo, phone, etc.)
2. Customize homepage content via ACF fields
3. Update Impressum with your company details
4. Update Datenschutz with your privacy policy
5. Test contact form functionality
6. Check mobile responsiveness

Enjoy your fully dynamic WordPress site! 🎉
