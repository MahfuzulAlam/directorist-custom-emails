<?php
/**
 * Shared helper functions.
 *
 * @package DirectoristCustomEmails
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'directorist_custom_emails_is_plugin_active' ) ) {
	/**
	 * Determine whether a plugin is active.
	 *
	 * @param string $plugin Plugin basename.
	 * @return bool
	 */
	function directorist_custom_emails_is_plugin_active( $plugin ) {
		return in_array( $plugin, (array) get_option( 'active_plugins', array() ), true ) || directorist_custom_emails_is_plugin_active_for_network( $plugin );
	}
}

if ( ! function_exists( 'directorist_custom_emails_is_plugin_active_for_network' ) ) {
	/**
	 * Determine whether a plugin is network-active.
	 *
	 * @param string $plugin Plugin basename.
	 * @return bool
	 */
	function directorist_custom_emails_is_plugin_active_for_network( $plugin ) {
		if ( ! is_multisite() ) {
			return false;
		}

		$plugins = get_site_option( 'active_sitewide_plugins', array() );

		return isset( $plugins[ $plugin ] );
	}
}

if ( ! function_exists( 'directorist_custom_emails_render_template' ) ) {
	/**
	 * Render a plugin template and return the markup.
	 *
	 * @param string $template_name Relative template path.
	 * @param array  $args          Template data.
	 * @return string
	 */
	function directorist_custom_emails_render_template( $template_name, $args = array() ) {
		$template_name = ltrim( (string) $template_name, '/\\' );
		$template_path = wp_normalize_path( DIRECTORIST_CUSTOM_EMAILS_DIR . 'templates/' . $template_name );

		if ( ! file_exists( $template_path ) ) {
			return '';
		}

		if ( ! empty( $args ) ) {
			extract( $args, EXTR_SKIP ); // phpcs:ignore WordPress.PHP.DontExtract.extract_extract
		}

		ob_start();
		include $template_path;

		return (string) ob_get_clean();
	}
}

if ( ! function_exists( 'directorist_custom_emails_get_notice_message' ) ) {
	/**
	 * Get admin notice text for a result code.
	 *
	 * @param string $reason Failure reason slug.
	 * @return string
	 */
	function directorist_custom_emails_get_notice_message( $reason ) {
		$messages = array(
			'missing_page'  => __( 'Failed to send the edit link: Add Listing page is not configured.', 'directorist-custom-emails' ),
			'invalid_page'  => __( 'Failed to send the edit link: Add Listing page URL could not be generated.', 'directorist-custom-emails' ),
			'missing_email' => __( 'Failed to send the edit link: listing author email was not found.', 'directorist-custom-emails' ),
			'mail_failed'   => __( 'Failed to send the edit link.', 'directorist-custom-emails' ),
		);

		return isset( $messages[ $reason ] ) ? $messages[ $reason ] : __( 'Failed to send the edit link.', 'directorist-custom-emails' );
	}
}
