# Cloudcode Six Mile Bible Baptist Church Website

![Six Mile Bible Baptist Church Homepage](https://www.6milebiblebaptistchurch.org/sites/default/files/2024-09/6mbbc%20website%20screenshot.png)

This repository documents the design and development of the **Six Mile Bible Baptist Church** website, built using **Drupal 10** and customized using the **OpenChurch** module and theme. The website is located at [https://www.6milebiblebaptistchurch.org](https://www.6milebiblebaptistchurch.org).

## Overview

The Six Mile Bible Baptist Church website is designed to provide members and visitors with easy access to church services, sermons, and ministry information. It integrates custom Drupal modules and themes to meet the specific needs of the church. This project uses **Drupal 10**, leveraging the **OpenChurch** theme and module, along with several customized modules under the namespace `cloudcode`.

## Table of Contents

- [Project Overview](#overview)
- [Modules Used](#modules-used)
- [Custom CloudCode Modules](#custom-cloudcode-modules)
- [Theme Customizations](#theme-customizations)
- [Twig Configuration](#twig-configuration)
- [Website Content Structure](#website-content-structure)
- [Recaptcha Integration](#recaptcha-integration)
- [SendGrid Integration](#sendgrid-integration)
- [Cron Configuration](#cron-configuration)
- [Sitemap Configuration](#sitemap-configuration)
- [Contributing](#contributing)

---

## Modules Used

The website is built using several contributed Drupal modules and custom modules:

- **OpenChurch**: A base theme and module that provides church-specific features.
- **Cloudcode Mail Formatter**: A custom module to format emails sent via the contact form.
- **Simple XML Sitemap**: Used to generate the sitemap for SEO.
- **ReCaptcha**: Protects forms using Google's ReCaptcha v2 and v3.
- **SendGrid Integration**: Sends emails using the SendGrid API.

### Additional Contributed Modules:

- **Contact Form**: The standard Drupal contact form used on the website.
- **Admin Toolbar**: Enhances the administrative interface.
- **Pathauto**: Automatically generates SEO-friendly URLs for content.

---

## Custom CloudCode Modules

### CloudCode Mail Formatter
The `cloudcode_mail_formatter` module customizes the email formatting for contact form submissions.

- **Location**: `modules/custom/cloudcode/cloudcode_mail_formatter`
- **Description**: This module formats the emails before they are sent via the SendGrid API.
- **Key Features**:
  - Customizes the email content to include sender name, mobile number, and message in a structured format.
  - Ensures the email is sent in plain text for readability.

#### Custom Hook: `hook_mail_alter`
This hook is implemented to alter the `from` email address when sending mail via SendGrid:

```php
function cloudcode_mail_formatter_mail_alter(&$message) {
  if ($message['id'] == 'contact_page_mail') {
    $message['from'] = 'no-reply@6milebiblebaptistchurch.org';
  }
}

## Contribution

If you find this repository useful, please consider giving it a star on GitHub. Your support is much appreciated!

## License

This project is open-sourced under the GNU General Public License v3.0. See the [LICENSE.md](LICENSE.md) file for more details.

---
