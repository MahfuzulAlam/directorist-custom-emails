<?php
/**
 * Listing edit link email template.
 *
 * Available variables:
 * - $site_name
 * - $site_url
 * - $post_title
 * - $edit_url
 *
 * @package DirectoristCustomEmails
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title><?php echo esc_html( $site_name ); ?></title>
</head>
<body style="margin:0;padding:0;background-color:#f4f6f8;font-family:Arial,Helvetica,sans-serif;color:#1f2937;">
	<table role="presentation" cellpadding="0" cellspacing="0" width="100%" style="background-color:#f4f6f8;margin:0;padding:30px 15px;">
		<tr>
			<td align="center">
				<table role="presentation" cellpadding="0" cellspacing="0" width="100%" style="max-width:620px;background-color:#ffffff;border-radius:14px;overflow:hidden;box-shadow:0 6px 24px rgba(0,0,0,0.06);">
					<tr>
						<td style="padding:32px 36px;background:linear-gradient(135deg,#1d4ed8,#2563eb);text-align:center;">
							<div style="font-size:28px;line-height:1.2;font-weight:700;color:#ffffff;margin:0;">
								<?php echo esc_html( $site_name ); ?>
							</div>
							<div style="font-size:14px;line-height:1.6;color:rgba(255,255,255,0.88);margin-top:8px;">
								<?php esc_html_e( 'Listing Update Access', 'directorist-custom-emails' ); ?>
							</div>
						</td>
					</tr>
					<tr>
						<td style="padding:36px;">
							<h2 style="margin:0 0 16px;font-size:24px;line-height:1.3;color:#111827;font-weight:700;">
								<?php esc_html_e( 'Update your listing', 'directorist-custom-emails' ); ?>
							</h2>

							<p style="margin:0 0 16px;font-size:15px;line-height:1.8;color:#4b5563;">
								<?php esc_html_e( 'Hello,', 'directorist-custom-emails' ); ?>
							</p>

							<p style="margin:0 0 20px;font-size:15px;line-height:1.8;color:#4b5563;">
								<?php esc_html_e( 'You can update your directory listing by clicking the button below.', 'directorist-custom-emails' ); ?>
							</p>

							<div style="margin:0 0 24px;padding:18px 20px;background-color:#f9fafb;border:1px solid #e5e7eb;border-radius:10px;">
								<div style="font-size:12px;line-height:1.5;font-weight:700;letter-spacing:0.04em;text-transform:uppercase;color:#6b7280;margin-bottom:8px;">
									<?php esc_html_e( 'Listing', 'directorist-custom-emails' ); ?>
								</div>
								<div style="font-size:18px;line-height:1.5;font-weight:600;color:#111827;">
									<?php echo esc_html( $post_title ); ?>
								</div>
							</div>

							<div style="text-align:center;margin:30px 0;">
								<a href="<?php echo esc_url( $edit_url ); ?>" style="display:inline-block;background-color:#2563eb;color:#ffffff;text-decoration:none;font-size:15px;font-weight:700;line-height:1;padding:16px 28px;border-radius:10px;">
									<?php esc_html_e( 'Edit Listing', 'directorist-custom-emails' ); ?>
								</a>
							</div>

							<p style="margin:0 0 12px;font-size:14px;line-height:1.8;color:#4b5563;">
								<?php esc_html_e( 'If the button does not work, copy and paste this link into your browser:', 'directorist-custom-emails' ); ?>
							</p>

							<p style="margin:0 0 24px;font-size:14px;line-height:1.8;word-break:break-word;">
								<a href="<?php echo esc_url( $edit_url ); ?>" style="color:#2563eb;text-decoration:none;">
									<?php echo esc_html( $edit_url ); ?>
								</a>
							</p>

							<p style="margin:0;font-size:14px;line-height:1.8;color:#6b7280;">
								<?php esc_html_e( 'Best regards,', 'directorist-custom-emails' ); ?><br>
								<?php echo esc_html( $site_name ); ?>
							</p>
						</td>
					</tr>
					<tr>
						<td style="padding:20px 36px;background-color:#f9fafb;border-top:1px solid #e5e7eb;text-align:center;">
							<p style="margin:0 0 6px;font-size:13px;line-height:1.6;color:#6b7280;">
								<?php
								printf(
									/* translators: %s: site name. */
									esc_html__( 'This email was sent from %s', 'directorist-custom-emails' ),
									esc_html( $site_name )
								);
								?>
							</p>
							<p style="margin:0;font-size:13px;line-height:1.6;">
								<a href="<?php echo esc_url( $site_url ); ?>" style="color:#2563eb;text-decoration:none;">
									<?php echo esc_html( $site_url ); ?>
								</a>
							</p>
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
</body>
</html>
