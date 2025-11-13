# Changelog - EP Restore Theme PRO

All notable changes to this project will be documented in this file.

## [3.0.0] - 2025-11-13

### 🎉 Initial PRO Release

This is the first release of the **EP Restore Theme PRO** - a professional, fully dynamic version of the EP Restore Theme.

### ✨ Features

#### Dynamic Content Management
- **ACF Integration:** Complete Advanced Custom Fields integration with 6 field groups
- **30+ Editable Fields:** All text, images, and content editable via WordPress admin
- **Options Page:** Global settings panel for header, footer, logo, phone, and more
- **Repeater Fields:** Flexible content with unlimited hero features, about features, and problems list

#### Content Import
- **WXR Import File:** Pre-configured content-export.xml with 3 German pages
- **Startseite (Homepage):** Complete homepage content ready for ACF
- **Impressum (Legal Notice):** Full German legal text
- **Datenschutz (Privacy Policy):** GDPR-compliant German privacy policy

#### Theme Architecture
- **Fallback System:** Works with or without ACF using original backup texts
- **Helper Functions:** `ep_get_field()` and `ep_get_option()` for easy field access
- **ACF JSON Sync:** Automatic field group synchronization from acf-json folder
- **Text Domain:** Properly internationalized with 'ep-restore-theme-pro'

#### Design & Layout
- **1:1 Design Fidelity:** Exact replica of original elektriker-pohl.de backup
- **Fully Responsive:** Mobile, tablet, and desktop optimized
- **German Content:** All default values and content in German
- **No Translation Needed:** Production-ready German business site

#### Documentation
- **README.md:** Complete installation and usage guide
- **CHANGELOG.md:** Version history and changes
- **ACF Field Documentation:** Detailed field group descriptions
- **Installation Guide:** Step-by-step setup instructions

### 📦 Included Files

#### Core Theme Files
- `style.css` - Theme stylesheet with PRO header
- `functions.php` - Theme functions with ACF support
- `header.php` - Dynamic header with ACF fields
- `footer.php` - Dynamic footer with ACF fields
- `front-page.php` - Dynamic homepage template
- `index.php` - Archive template
- `page.php` - Page template
- `single.php` - Single post template

#### Template Parts
- `template-parts/services.php` - Dynamic services section
- `template-parts/about.php` - Dynamic about section with repeater
- `template-parts/contact.php` - Dynamic contact section
- `template-parts/problems.php` - Dynamic problems section with repeater

#### ACF Field Groups (6)
- `acf-json/group_ep_global_settings.json` - Global options
- `acf-json/group_ep_homepage_hero.json` - Hero section
- `acf-json/group_ep_homepage_services.json` - Services section
- `acf-json/group_ep_homepage_about.json` - About section
- `acf-json/group_ep_homepage_contact.json` - Contact section
- `acf-json/group_ep_homepage_problems.json` - Problems section

#### Assets
- `assets/img/` - 7 images from original backup
- `assets/js/main.js` - JavaScript for smooth scrolling and form validation
- `assets/css/` - Additional stylesheets (if needed)

#### Content & Documentation
- `content-export.xml` - WXR import file with 3 pages
- `README.md` - Complete user guide
- `CHANGELOG.md` - This file
- `screenshot.png` - Theme screenshot

### 🔧 Technical Details

#### ACF Field Groups

**1. EP Global Settings (Options Page)**
- company_name
- phone_number
- phone_link
- topbar_text
- logo_image
- footer_copyright
- impressum_url
- datenschutz_url

**2. Homepage - Hero Section**
- hero_heading
- hero_subheading
- hero_intro
- hero_image
- hero_features (repeater)

**3. Homepage - Services Section**
- service_1_title / service_1_text
- service_2_title / service_2_text
- service_3_title / service_3_text

**4. Homepage - About Section**
- about_heading
- about_text
- about_image
- about_features (repeater)

**5. Homepage - Contact Section**
- contact_heading
- contact_intro
- contact_form_heading

**6. Homepage - Problems Section**
- problems_heading
- problems_intro
- problems_list (repeater)

### 🎯 Requirements

- WordPress 6.0+
- PHP 7.4+
- Advanced Custom Fields (free version)

### 📝 Installation

1. Install WordPress locally (LocalWP recommended)
2. Install ACF plugin
3. Upload theme to wp-content/themes/
4. Activate "EP Restore Theme PRO"
5. Import content-export.xml
6. Set Startseite as homepage
7. Edit content via ACF fields

### 🔗 Links

- **GitHub:** https://github.com/Black10998/ep-restore-theme-pro
- **Author:** ELEKTRO RECHBERGER GmbH
- **Author Website:** https://elektro-rechberger.at

### 📄 License

GPLv2 or later - http://www.gnu.org/licenses/gpl-2.0.html

---

## Previous Versions

### [2.0.0] - 2025-11-13
- Initial dynamic ACF version (ep-restore-theme)
- Added ACF field groups
- Created WXR import file
- Updated all templates to use dynamic fields

### [1.0.0] - 2025-11-13
- Initial static version (ep-restore-theme)
- 1:1 design restoration from backup
- Static German content
- Basic WordPress theme structure
