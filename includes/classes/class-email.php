<?php
/**
 * Email builder and sender.
 *
 * @package DirectoristCustomEmails
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Handle listing edit link emails.
 */
class Directorist_Custom_Emails_Email {

	/**
	 * Send the listing edit link email.
	 *
	 * @param WP_Post $post Listing post object.
	 * @return array{success:bool,reason:string}
	 */
	public function send( WP_Post $post ) {
		$add_listing_page_id = function_exists( 'get_directorist_option' ) ? absint( get_directorist_option( 'add_listing_page' ) ) : 0;

		if ( ! $add_listing_page_id ) {
			return array(
				'success' => false,
				'reason'  => 'missing_page',
			);
		}

		$add_listing_page_url = get_permalink( $add_listing_page_id );

		if ( empty( $add_listing_page_url ) ) {
			return array(
				'success' => false,
				'reason'  => 'invalid_page',
			);
		}

		$edit_url = trailingslashit( $add_listing_page_url ) . user_trailingslashit( 'edit/' . $post->ID );

		$author_id    = (int) $post->post_author;
		$author_email = $author_id ? get_the_author_meta( 'user_email', $author_id ) : '';

		if ( empty( $author_email ) || ! is_email( $author_email ) ) {
			return array(
				'success' => false,
				'reason'  => 'missing_email',
			);
		}

		$site_name  = wp_specialchars_decode( get_bloginfo( 'name' ), ENT_QUOTES );
		$site_url   = home_url( '/' );
		$post_title = wp_strip_all_tags( $post->post_title );
		$subject    = sprintf(
			/* translators: %s: listing title. */
			__( 'Update your listing: %s', 'directorist-custom-emails' ),
			$post_title
		);

		$message = directorist_custom_emails_render_template(
			'emails/listing-edit-link.php',
			array(
				'site_name'  => $site_name,
				'site_url'   => $site_url,
				'post_title' => $post_title,
				'edit_url'   => $edit_url,
			)
		);

		$headers = array( 'Content-Type: text/html; charset=UTF-8' );
		$sent    = wp_mail( $author_email, $subject, $message, $headers );

		return array(
			'success' => (bool) $sent,
			'reason'  => $sent ? '' : 'mail_failed',
		);
	}
}
