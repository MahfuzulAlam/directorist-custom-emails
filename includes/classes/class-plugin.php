<?php
/**
 * Main plugin class.
 *
 * @package DirectoristCustomEmails
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Bootstrap the plugin.
 */
final class Directorist_Custom_Emails {

	/**
	 * Plugin instance.
	 *
	 * @var Directorist_Custom_Emails|null
	 */
	private static $instance = null;

	/**
	 * Get plugin instance.
	 *
	 * @return Directorist_Custom_Emails
	 */
	public static function instance() {
		if ( null === self::$instance ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * Constructor.
	 */
	private function __construct() {
		$this->includes();
		$this->hooks();
	}

	/**
	 * Load required files.
	 *
	 * @return void
	 */
	private function includes() {
		require_once DIRECTORIST_CUSTOM_EMAILS_DIR . 'includes/classes/class-email.php';
		require_once DIRECTORIST_CUSTOM_EMAILS_DIR . 'includes/classes/class-admin.php';
	}

	/**
	 * Register plugin hooks.
	 *
	 * @return void
	 */
	private function hooks() {
		add_action( 'plugins_loaded', array( $this, 'load_textdomain' ) );

		if ( is_admin() ) {
			new Directorist_Custom_Emails_Admin( new Directorist_Custom_Emails_Email() );
		}
	}

	/**
	 * Load translations.
	 *
	 * @return void
	 */
	public function load_textdomain() {
			load_plugin_textdomain(
			'directorist-custom-emails',
			false,
			dirname( DIRECTORIST_CUSTOM_EMAILS_BASENAME ) . '/languages'
		);
	}
}
