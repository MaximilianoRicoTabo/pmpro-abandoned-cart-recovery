<?php

class PMPro_Email_Template_PMProACR_Reminder_3 extends PMPro_Email_Template {

	/**
	 * The parent user.
	 *
	 * @var WP_User
	 */
	protected $user;

	/**
	 * The level.
	 *
	 * @var StdClass
	 */
	protected $level;

	/**
	 * Constructor.
	 *
	 * @since TBD
	 *
	 * @param WP_User $member The user applying for membership.
	 * @param StdClass $level The level object.
	 */
	public function __construct( WP_User $user, StdClass $level ) {
		$this->user = $user;
		$this->level = $level;
	}

	/**
	 * Get the email template slug.
	 *
	 * @since TBD
	 *
	 * @return string The email template slug.
	 */
	public static function get_template_slug() {
		return 'pmproacr_reminder_3';
	}

	/**
	 * Get the "nice name" of the email template.
	 *
	 * @since TBD
	 *
	 * @return string The "nice name" of the email template.
	 */
	public static function get_template_name() {
		return esc_html__( 'Abandoned Cart Recovery - Reminder 3', 'pmpro-abandoned-cart-recovery' );
	}

	/**
	 * Get "help text" to display to the admin when editing the email template.
	 *
	 * @since TBD
	 *
	 * @return string The "help text" to display to the admin when editing the email template.
	 */
	public static function get_template_description() {
		return  esc_html__( 'This email is sent as the third reminder to complete a purchase.', 'pmpro-abandoned-cart-recovery' );
	}

	/**
	 * Get the default subject for the email.
	 *
	 * @since TBD
	 *
	 * @return string The default subject for the email.
	 */
	public static function get_default_subject() {
		return esc_html__( 'Final Reminder: Complete membership checkout at !!sitename!! today.', 'pmpro-abandoned-cart-recovery' );
	}

	/**
	 * Get the default body content for the email.
	 *
	 * @since TBD
	 *
	 * @return string The default body content for the email.
	 */
	public static function get_default_body() {
		return wp_kses_post( '<p>' . esc_html__( 'This is your final reminder to complete your !!membership_level_name!! membership checkout at !!sitename!!.', 'pmpro-abandoned-cart-recovery' ) . '</p>

<p><a href="!!checkout_url!!">' . esc_html__( 'Complete Your Purchase Now', 'pmpro-abandoned-cart-recovery' ) . '</a></p>' );
	}

	/**
	 * Get the email template variables for the email paired with a description of the variable.
	 *
	 * @since TBD
	 *
	 * @return array The email template variables for the email (key => value pairs).
	 */
	public static function get_email_template_variables_with_description() {
		return array(
			'!!user_login!!' => esc_html__( 'The user\'s login name.', 'pmpro-abandoned-cart-recovery' ),
			'!!user_email!!' => esc_html__( 'The user\'s email address.', 'pmpro-abandoned-cart-recovery' ),
			'!!display_name!!' => esc_html__( 'The user\'s display name.', 'pmpro-abandoned-cart-recovery' ),
			'!!membership_id!!' => esc_html__( 'The ID of the membership level.', 'pmpro-abandoned-cart-recovery' ),
			'!!membership_level_name!!' => esc_html__( 'The name of the membership level.', 'pmpro-abandoned-cart-recovery' ),
			'!!checkout_url!!' => esc_html__( 'The URL to the checkout page.', 'pmpro-abandoned-cart-recovery' ),
			'!!opt_out_url!!' => esc_html__( 'The URL to opt out of future emails.', 'pmpro-abandoned-cart-recovery' ),

		);
	}

	/**
	 * Get the email template variables for the email.
	 *
	 * @since TBD
	 *
	 * @return array The email template variables for the email (key => value pairs).
	 */
	public function get_email_template_variables() {
		$user = $this->user;
		$level = $this->level;

		$email_template_variables = array(
			'user_login' => $user->user_login,
			'user_email' => $user->user_email,
			'display_name' => $user->display_name,
			'membership_id' => $level->id,
			'membership_level_name' => $level->name,
			'checkout_url' => pmpro_login_url( pmpro_url( 'checkout', '?pmpro_level=' . $level->id ) ),
			'opt_out_url' => add_query_arg( 'pmproacr_opt_out', urlencode( $user->user_email ), home_url() ),
		);
		return $email_template_variables;
	}

	/**
	 * Get the email address to send the email to.
	 *
	 * @since TBD
	 *
	 * @return string The email address to send the email to.
	 */
	public function get_recipient_email() {
		return $this->user->user_email;
	}

	/**
	 * Get the name of the email recipient.
	 *
	 * @since TBD
	 *
	 * @return string The name of the email recipient.
	 */
	public function get_recipient_name() {
		$user = $this->user;
		return empty( $user->display_name ) ? esc_html__( 'User', 'pmpro-abandoned-cart-recovery' ) : $user->display_name;
	}
}
/**
 * Register the email template.
 *
 * @since TBD
 *
 * @param array $email_templates The email templates (template slug => email template class name)
 * @return array The modified email templates array.
 */
function pmpro_email_template_pmpro_acr_reminder_3( $email_templates ) {
	$email_templates['pmproacr_reminder_3'] = 'PMPro_Email_Template_PMProACR_Reminder_3';
	return $email_templates;
}
add_filter( 'pmpro_email_templates', 'pmpro_email_template_pmpro_acr_reminder_3' );
