<?php 
function business_a_page_settings_fucntion( $wp_customize ){

	/* PAGE SETTINGS */
		
		/* PAGE Settings Sections */
		$wp_customize->add_section( 'pagesettingssection' , array(
			'title'      => __('Page Settings', 'business-a' ),
			'priority'       => 45,
		) );
			
			// enable feature image
			$wp_customize->add_setting( 'business_option[page_feature_image_enable]' , array(
			'default'    => true,
			'sanitize_callback' => 'business_a_sanitize_checkbox',
			'type'=>'option'
			));

			$wp_customize->add_control('business_option[page_feature_image_enable]' , array(
			'label' => __('Enable Page Featured Image','business-a' ),
			'section' => 'pagesettingssection',
			'type'=>'checkbox',
			) );
			
			// enable post meta
			$wp_customize->add_setting( 'business_option[page_meta_enable]' , array(
			'default'    => true,
			'sanitize_callback' => 'business_a_sanitize_checkbox',
			'type'=>'option'
			));

			$wp_customize->add_control('business_option[page_meta_enable]' , array(
			'label' => __('Enable Page Meta','business-a' ),
			'section' => 'pagesettingssection',
			'type'=>'checkbox',
			) );
}
add_action( 'customize_register', 'business_a_page_settings_fucntion' );