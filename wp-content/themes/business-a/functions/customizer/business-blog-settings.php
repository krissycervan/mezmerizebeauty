<?php 
function business_a_blog_settings_fucntion( $wp_customize ){

	/* BLOG SETTINGS */
		
		/* Blog Settings Sections */
		$wp_customize->add_section( 'blogsettingssection' , array(
			'title'      => __('BlogPage Settings', 'business-a' ),
			'priority'       => 40,
		) );
			
			// enable feature image
			$wp_customize->add_setting( 'business_option[blog_feature_image_enable]' , array(
			'default'    => true,
			'sanitize_callback' => 'business_a_sanitize_checkbox',
			'type'=>'option'
			));

			$wp_customize->add_control('business_option[blog_feature_image_enable]' , array(
			'label' => __('Enable Post Featured Image','business-a' ),
			'section' => 'blogsettingssection',
			'type'=>'checkbox',
			) );
			
			// enable post meta
			$wp_customize->add_setting( 'business_option[blog_meta_enable]' , array(
			'default'    => true,
			'sanitize_callback' => 'business_a_sanitize_checkbox',
			'type'=>'option'
			));

			$wp_customize->add_control('business_option[blog_meta_enable]' , array(
			'label' => __('Enable Post Meta','business-a' ),
			'section' => 'blogsettingssection',
			'type'=>'checkbox',
			) );
}
add_action( 'customize_register', 'business_a_blog_settings_fucntion' );