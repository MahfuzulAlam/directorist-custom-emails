<?php
/**
 * Admin action handler.
 *
 * @package DirectoristCustomEmails
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register and handle admin listing actions.
 */
class Directorist_Custom_Emails_Admin {

	/**
	 * Email service.
	 *
	 * @var Directorist_Custom_Emails_Email
	 */
	private $email;

	/**
	 * Constructor.
	 *
	 * @param Directorist_Custom_Emails_Email $email Email service.
	 */
	public function __construct( Directorist_Custom_Emails_Email $email ) {
		$this->email = $email;
		$this->hooks();
	}

	/**
	 * Register hooks.
	 *
	 * @return void
	 */
	private function hooks() {
		add_filter( 'post_row_actions', array( $this, 'add_send_edit_link_action' ), 10, 2 );
		add_action( 'admin_action_booking_send_listing_edit_link', array( $this, 'handle_send_listing_edit_link' ) );
		add_action( 'admin_notices', array( $this, 'send_listing_edit_link_notice' ) );
	}

	/**
	 * Add "Send Edit Link" action to Directorist listings.
	 *
	 * @param array   $actions Existing row actions.
	 * @param WP_Post $post    Current post object.
	 * @return array
	 */
	public function add_send_edit_link_action( $actions, $post ) {
		if ( ! is_admin() || ! ( $post instanceof WP_Post ) ) {
			return $actions;
		}

		if ( 'at_biz_dir' !== $post->post_type ) {
			return $actions;
		}

		if ( ! current_user_can( 'edit_post', $post->ID ) ) {
			return $actions;
		}

		$url = wp_nonce_url(
			admin_url( 'admin.php?action=booking_send_listing_edit_link&post_id=' . absint( $post->ID ) ),
			'booking_send_listing_edit_link_' . $post->ID
		);

		$actions['booking_send_edit_link'] = sprintf(
			'<a href="%1$s">%2$s</a>',
			esc_url( $url ),
			esc_html__( 'Send Edit Link', 'directorist-custom-emails' )
		);

		return $actions;
	}

	/**
	 * Handle sending the frontend edit link.
	 *
	 * @return void
	 */
	public function handle_send_listing_edit_link() {
		if ( ! current_user_can( 'edit_posts' ) ) {
			wp_die( esc_html__( 'You are not allowed to do this.', 'directorist-custom-emails' ) );
		}

		$post_id = isset( $_GET['post_id'] ) ? absint( wp_unslash( $_GET['post_id'] ) ) : 0;

		if ( ! $post_id ) {
			wp_die( esc_html__( 'Invalid listing ID.', 'directorist-custom-emails' ) );
		}

		check_admin_referer( 'booking_send_listing_edit_link_' . $post_id );

		$post = get_post( $post_id );

		if ( ! $post instanceof WP_Post || 'at_biz_dir' !== $post->post_type ) {
			wp_die( esc_html__( 'Invalid listing.', 'directorist-custom-emails' ) );
		}

		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			wp_die( esc_html__( 'You are not allowed to edit this listing.', 'directorist-custom-emails' ) );
		}

		$result = $this->email->send( $post );

		$args = array(
			'post_type'      => 'at_biz_dir',
			'edit_link_sent' => $result['success'] ? '1' : '0',
		);

		if ( ! $result['success'] && ! empty( $result['reason'] ) ) {
			$args['reason'] = $result['reason'];
		}

		wp_safe_redirect(
			add_query_arg(
				$args,
				admin_url( 'edit.php' )
			)
		);
		exit;
	}

	/**
	 * Display the result notice after email processing.
	 *
	 * @return void
	 */
	public function send_listing_edit_link_notice() {
		if ( ! is_admin() ) {
			return;
		}

		$post_type = isset( $_GET['post_type'] ) ? sanitize_key( wp_unslash( $_GET['post_type'] ) ) : '';

		if ( 'at_biz_dir' !== $post_type || ! isset( $_GET['edit_link_sent'] ) ) {
			return;
		}

		$sent = sanitize_text_field( wp_unslash( $_GET['edit_link_sent'] ) );

		if ( '1' === $sent ) {
			printf(
				'<div class="notice notice-success is-dismissible"><p>%s</p></div>',
				esc_html__( 'Edit link sent successfully.', 'directorist-custom-emails' )
			);

			return;
		}

		$reason  = isset( $_GET['reason'] ) ? sanitize_key( wp_unslash( $_GET['reason'] ) ) : '';
		$message = directorist_custom_emails_get_notice_message( $reason );

		printf(
			'<div class="notice notice-error is-dismissible"><p>%s</p></div>',
			esc_html( $message )
		);
	}
}
