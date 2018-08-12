<?php
/**
 * Customizer functionality for the Theme Info section.
 */

$upsell_theme_info_path = trailingslashit( get_template_directory() ) . 'functions/customizer/customizer-theme-info/class-businessa-control-upsell-theme-info.php';
if ( file_exists( $upsell_theme_info_path ) ) {
	require_once( $upsell_theme_info_path );
}

$theme_info_path = trailingslashit( get_template_directory() ) . 'functions/customizer/customizer-theme-info/class-businessa-customizer-theme-info.php';
if ( file_exists( $theme_info_path ) ) {
	require_once( $theme_info_path );
}

/**
 * Hook controls for Features section to Customizer.
 *
 */
function Business_a_theme_info_customize_register( $wp_customize ) {

	if ( ! class_exists( 'Business_a_Control_Upsell_Theme_Info' ) ) {
		return;
	}

	$wp_customize->add_section(
		'business_theme_info_main_section', array(
			'title'    => esc_html__( 'PRO Features', 'business-a' ),
			'priority' => 0,
		)
	);

	$wp_customize->add_setting(
		'business_theme_info_main_control', array(
			'sanitize_callback' => 'sanitize_text_field',
		)
	);

	$wp_customize->add_control(
		new Business_a_Control_Upsell_Theme_Info(
			$wp_customize, 'business_theme_info_main_control', array(
				'section'            => 'business_theme_info_main_section',
				'priority'           => 100,
				'options'            => array(
					esc_html__( 'FrontPage Shop Section', 'business-a' ),
					esc_html__( 'Full Color Settings', 'business-a' ),
					esc_html__( 'Portfolio Features', 'business-a' ),
					esc_html__( 'Testimonial Features', 'business-a' ),
					esc_html__( 'Pricing Features', 'business-a' ),
					esc_html__( 'Team Features', 'business-a' ),
					esc_html__( 'Client Features', 'business-a' ),
					esc_html__( 'Google Map Features', 'business-a' ),
					esc_html__( 'Section Manager', 'business-a' ),
					esc_html__( '1 year quality support', 'business-a' ),
				),
				'explained_features' => array(
					esc_html__( 'You can access of shop section in FrontPage of Business-A Pro theme.', 'business-a' ),
					esc_html__( 'Full customizable color settings added in Pro version.', 'business-a' ),
					esc_html__( 'Portfolio section in FrontPage.', 'business-a' ),
					esc_html__( 'Testimonial section in FrontPage.', 'business-a' ),
					esc_html__( 'Pricing Support functionality added in Pro version.', 'business-a' ),
					esc_html__( 'Team Section features available in Business-A Pro version.', 'business-a' ),
					esc_html__( 'Client Section also availble in Pro version.', 'business-a' ),
					esc_html__( 'Google Map Features support in FrontPage and Contact Page.', 'business-a' ),
					esc_html__( 'Section Manager settings used to ordering homepage sections.', 'business-a' ),
					esc_html__( '24/7 Professional Support.', 'business-a' ),
				),
				'button_url'         => esc_url( 'https://www.webdzier.com/themes/business-a/' ),
				'button_text'        => esc_html__( 'BuyNow Pro Version', 'business-a' ),
			)
		)
	);

}

add_action( 'customize_register', 'Business_a_theme_info_customize_register' );
