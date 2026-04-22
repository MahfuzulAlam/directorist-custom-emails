# Directorist - Custom Emails

`Directorist - Custom Emails` is a WordPress extension for Directorist that lets an admin send a frontend listing edit link to the listing author/vendor directly from the WordPress admin listing table.

## Requirements

- WordPress 5.2 or higher
- PHP 7.4 or higher
- Directorist plugin installed and active
- A valid Directorist `Add Listing` page configured

## Download From GitHub

### Option 1: Download ZIP from GitHub

1. Open this repository on GitHub.
2. Click the green `Code` button.
3. Click `Download ZIP`.
4. Extract the ZIP file on your computer.
5. Locate the plugin folder: `directorist-custom-emails`

### Option 2: Clone with Git

```bash
git clone <your-github-repository-url>
```

After cloning, locate the plugin folder:

```text
directorist-custom-emails
```

## Install In WordPress

### Option 1: Upload from WordPress Admin

1. Compress the `directorist-custom-emails` folder into a ZIP file.
2. Log in to your WordPress admin panel.
3. Go to `Plugins > Add New`.
4. Click `Upload Plugin`.
5. Choose the ZIP file.
6. Click `Install Now`.
7. Click `Activate Plugin`.

### Option 2: Upload with File Manager or FTP

1. Open your WordPress site files.
2. Go to `wp-content/plugins/`
3. Upload the full `directorist-custom-emails` folder.
4. Log in to WordPress admin.
5. Go to `Plugins`.
6. Find `Directorist - Custom Emails`.
7. Click `Activate`.

## Directorist Setup

Before using the plugin, make sure Directorist is configured correctly:

1. Go to the Directorist settings in WordPress admin.
2. Confirm the `Add Listing` page is assigned.
3. Make sure the listing author/vendor has a valid email address.

If the `Add Listing` page is missing or the listing author does not have an email address, the email will not be sent.

## How To Use

1. Log in to WordPress admin.
2. Go to `Directory Listings` or the Directorist listings screen.
3. Find the listing you want to send an edit link for.
4. Hover over the listing row.
5. Click `Send Edit Link`.
6. The plugin will email the listing author/vendor a frontend edit link.

## What The Plugin Does

- Adds a `Send Edit Link` action to Directorist listing rows in wp-admin
- Generates the frontend edit URL based on the Directorist `Add Listing` page
- Sends an HTML email to the listing author/vendor
- Shows an admin success or failure notice after sending

## Troubleshooting

### The `Send Edit Link` action does not appear

Check the following:

- Directorist is active
- The post type is `at_biz_dir`
- Your user account has permission to edit the listing
- The plugin is activated

### The email was not sent

Check the following:

- The listing author has a valid email address
- The Directorist `Add Listing` page is configured
- Your WordPress site can send emails correctly
- SMTP is configured if your server does not reliably send mail with `wp_mail()`

### The link in the email is wrong

Check that:

- The correct Directorist `Add Listing` page is selected
- Your site permalink structure is working correctly
- The listing ID exists and belongs to the expected author

## File Structure

```text
directorist-custom-emails/
├── directorist-custom-emails.php
├── includes/
│   ├── classes/
│   └── functions/
├── templates/
│   └── emails/
└── README.md
```

## Security Notes

- Direct file access is blocked
- Admin actions are protected with capability checks and nonces
- Request values are sanitized before use
- Output is escaped following WordPress coding standards

## License

GPL v2 or later

## Author

- Author: wpXplore
- URL: https://wpxplore.com
