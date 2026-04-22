<?php
/**
 * Plugin Name:       Directorist - Custom Emails
 * Plugin URI:        https://wpxplore.com
 * Description:       Send custom emails for Directorist listings, including a frontend listing edit link for the author/vendor.
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.4
 * Author:            wpXplore
 * Author URI:        https://wpxplore.com
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       directorist-custom-emails
 * Domain Path:       /languages
 *
 * @package DirectoristCustomEmails
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'DIRECTORIST_CUSTOM_EMAILS_VERSION', '1.0.0' );
define( 'DIRECTORIST_CUSTOM_EMAILS_FILE', __FILE__ );
define( 'DIRECTORIST_CUSTOM_EMAILS_BASENAME', plugin_basename( __FILE__ ) );
define( 'DIRECTORIST_CUSTOM_EMAILS_DIR', plugin_dir_path( __FILE__ ) );
define( 'DIRECTORIST_CUSTOM_EMAILS_URL', plugin_dir_url( __FILE__ ) );

require_once DIRECTORIST_CUSTOM_EMAILS_DIR . 'includes/functions/common.php';
require_once DIRECTORIST_CUSTOM_EMAILS_DIR . 'includes/classes/class-plugin.php';

if ( ! function_exists( 'directorist_custom_emails' ) ) {
	/**
	 * Retrieve the main plugin instance.
	 *
	 * @return Directorist_Custom_Emails
	 */
	function directorist_custom_emails() {
		return Directorist_Custom_Emails::instance();
	}
}

if ( directorist_custom_emails_is_plugin_active( 'directorist/directorist-base.php' ) ) {
	directorist_custom_emails();
}
