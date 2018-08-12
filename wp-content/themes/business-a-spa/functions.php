<?php 
if( !class_exists('business_a_settings_array')){
	class business_a_settings_array {
		function default_data(){
			return array(
			
			/* GENRAL SETTINGS */
			'header-left-text1'=>'',
			'header-left-text2'=>'',
			'header-facebook-url'=>'',
			'header-twitter-url'=>'',
			'header-linkedin-url'=>'',
			'header-googleplus-url'=>'',
			'header-social-target'=>true,
			'top-header-hide'=>false,
			'layout' => false,
			'custom_color_scheme'=>'#62377d',
			
			'footer_copyright'=> '',
			'footer_socialicon_enable'=> true,
			'footer_socialicon_title'=> '',
			'footer_menu'=> true,
			'theme_color'=>'#62377d',
			'custom_color_enable'=>false,
			'footer_background'=>'#2c2c2c',
			'footer_info_background'=>'#242424',
			'site_title'=>'#242424',
			
			/* HOME PAGE SETTINGS */
			'slider_enable'=> true,
			'slider_animation_type'=> 'slide',
			'slider_speed'=> 3000,
			'slider_cat'=> 1,
			
			/* HOME PAGE SERVICE SETTINGS */
			'service_section_backgorund_color'=> '#ffffff',
			'service_section_image'=> '',
			'service_section_image_repeat'=>'',
			'service_section_enable'=>true,
			'service_section_title'=>'',
			'service_section_description'=>'',
			
			/* HOME PAGE SHOP SETTINGS */
			'shop_section_backgorund_color'=> '#ffffff',
			'shop_section_image'=> '',
			'shop_section_image_repeat'=>'',
			'shop_section_enable'=>true,
			'shop_section_title'=>'',
			'shop_section_description'=>'',
			'shop_no_of_show'=>4,
			
			/* HOME PAGE NEWS SETTINGS */
			'news_section_backgorund_color'=> '#3c3c3c',
			'news_section_image'=> '',
			'news_section_image_repeat'=>'',
			'news_section_enable'=>true,
			'news_section_title'=>'',
			'news_section_description'=>'',
			'news_no_of_show'=>4,
			'news_category_show'=>1,

			/* HOME PAGE TEAM SETTINGS */
			'team_section_backgorund_color'=> '#ffffff',
			'team_section_image'=> '',
			'team_section_image_repeat'=>'',
			'team_section_enable'=>true,
			'team_section_title'=>'',
			'team_section_description'=>'',

			/* HOME PAGE TESTIMONIAL SETTINGS */
			'testimonial_section_backgorund_color'=> '#ffffff',
			'testimonial_section_enable'=> true,
			'testimonial_section_image'=> '',
			'testimonial_section_image_repeat'=>'',
			'testimonial_section_title'=>'',
			'testimonial_section_description'=>'',
			
			/* HOME PAGE CONTACT SETTINGS */
			'contact_section_enable'=> true,
			'contact_section_title'=>'',
			'contact_section_description'=>'',
			'contact_contactform_shortcode'=>'',
			
			/* BLOGS SETTINGS */
			'blog_feature_image_enable'=>true,
			'blog_meta_enable'=>true,
			
			/* PAGE SETTINGS */
			'page_feature_image_enable'=>true,
			'page_meta_enable'=>false,
			
			/* TYPOGRAPHY SETTINGS */
			
			'general_fontsize'=>14,
			'general_fontfamily'=>'Roboto',
			'general_fontstyle'=>'normal',
			
			'h1_fontsize'=>36,
			'h1_fontfamily'=>'Roboto Slab',
			'h1_fontstyle'=>'normal',
			
			'h2_fontsize'=>30,
			'h2_fontfamily'=>'Roboto Slab',
			'h2_fontstyle'=>'normal',
			
			'h3_fontsize'=>24,
			'h3_fontfamily'=>'Roboto Slab',
			'h3_fontstyle'=>'normal',
			
			'h4_fontsize'=>18,
			'h4_fontfamily'=>'Roboto Slab',
			'h4_fontstyle'=>'normal',
			
			'h5_fontsize'=>14,
			'h5_fontfamily'=>'Roboto Slab',
			'h5_fontstyle'=>'normal',
			
			'h6_fontsize'=>12,
			'h6_fontfamily'=>'Roboto Slab',
			'h6_fontstyle'=>'normal',
			
			);
		}
	}
}

/* sanitize_callback function for hex color */
function business_a_spa_sanitize_hex_color( $color ) {
	if ( '' === $color ) {
		return '';
	}
	// 3 or 6 hex digits, or the empty string.
	if ( preg_match('|^#([A-Fa-f0-9]{3}){1,2}$|', $color ) ) {
		return $color;
	}
}

function business_a_spa_sanitize_checkbox( $checked ) {
	// Boolean check.
	return ( ( isset( $checked ) && true == $checked ) ? true : false );
}


if( ! function_exists('business_a_genral_settings_fucntion')){
function business_a_genral_settings_fucntion( $wp_customize ){
	$wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
	
	/* GENRAL SETTINGS */
	$wp_customize->add_panel( 'general_settings', array(
		'priority'       => 30,
		'capability'     => 'edit_theme_options',
		'title'      => __('Appearance Settings', 'business-a-spa' ),
	) );
		
		/* Top Header */
		$wp_customize->add_section( 'top_header' , array(
			'title'      => __('Top Header', 'business-a-spa' ),
			'panel'  => 'general_settings',
			'priority'       => 5,
		) );
			
			// header left text1
			$wp_customize->add_setting( 'business_option[header-left-text1]' , array(
			'default'    => '',
			'sanitize_callback' => 'sanitize_text_field',
			'type'=>'option'
			));

			$wp_customize->add_control('business_option[header-left-text1]' , array(
			'label' => __('Phone Number:','business-a-spa' ),
			'section' => 'top_header',
			'type'=>'text',
			) );
			
			// header left text2
			$wp_customize->add_setting( 'business_option[header-left-text2]' , array(
			'default'    => '',
			'sanitize_callback' => 'sanitize_text_field',
			'type'=>'option'
			));

			$wp_customize->add_control('business_option[header-left-text2]' , array(
			'label' => __('Email Address:','business-a-spa' ),
			'section' => 'top_header',
			'type'=>'text',
			) );
			
			// facebook url
			$wp_customize->add_setting( 'business_option[header-facebook-url]' , array(
			'default'    => '',
			'sanitize_callback' => 'esc_url_raw',
			'type'=>'option',
			));

			$wp_customize->add_control('business_option[header-facebook-url]' , array(
			'label' => __('Header Facebook URL','business-a-spa' ),
			'section' => 'top_header',
			'type'=>'text',
			'input_attrs' => array(
				'placeholder' => __('Facebook URL','business-a-spa'),
			),
			) );
			
			// twitter url
			$wp_customize->add_setting( 'business_option[header-twitter-url]' , array(
			'default'    => '',
			'sanitize_callback' => 'esc_url_raw',
			'type'=>'option'
			));

			$wp_customize->add_control('business_option[header-twitter-url]' , array(
			'label' => __('Header Twitter URL','business-a-spa' ),
			'section' => 'top_header',
			'type'=>'text',
			'input_attrs' => array(
				'placeholder' => __('Twitter URL','business-a-spa'),
			),
			) );
			
			// linkedin url
			$wp_customize->add_setting( 'business_option[header-linkedin-url]' , array(
			'default'    => '',
			'sanitize_callback' => 'esc_url_raw',
			'type'=>'option'
			));

			$wp_customize->add_control('business_option[header-linkedin-url]' , array(
			'label' => __('Header Linked In URL','business-a-spa' ),
			'section' => 'top_header',
			'type'=>'text',
			'input_attrs' => array(
				'placeholder' => __('Linked-In URL','business-a-spa'),
			),
			) );
			
			// googleplus url
			$wp_customize->add_setting( 'business_option[header-googleplus-url]' , array(
			'default'    => '',
			'sanitize_callback' => 'esc_url_raw',
			'type'=>'option'
			));

			$wp_customize->add_control('business_option[header-googleplus-url]' , array(
			'label' => __('Header Google Plus URL','business-a-spa' ),
			'section' => 'top_header',
			'type'=>'text',
			'input_attrs' => array(
				'placeholder' => __('Google+ URL','business-a-spa'),
			),
			) );
			
			// open window
			$wp_customize->add_setting( 'business_option[header-social-target]' , array(
			'default'    => true,
			'sanitize_callback' => 'business_a_spa_sanitize_checkbox',
			'type'=>'option'
			));

			$wp_customize->add_control('business_option[header-social-target]' , array(
			'label' => __('Social icons open window in new tab','business-a-spa' ),
			'section' => 'top_header',
			'type'=>'checkbox',
			) );
			
			// hide top header
			$wp_customize->add_setting( 'business_option[top-header-hide]' , array(
			'default'    => false,
			'sanitize_callback' => 'business_a_spa_sanitize_checkbox',
			'type'=>'option'
			));

			$wp_customize->add_control('business_option[top-header-hide]' , array(
			'label' => __('Top header bar hide','business-a-spa' ),
			'section' => 'top_header',
			'type'=>'checkbox',
			) );
			
		/* Boxed Layout */
		$wp_customize->add_section( 'layout_section' , array(
			'title'      => __('Layout', 'business-a-spa' ),
			'panel'  => 'general_settings',
			'priority'       => 6,
		) );
		
			// boxed layout settings
			$wp_customize->add_setting( 'business_option[layout]' , array(
			'default'    => false,
			'sanitize_callback' => 'business_a_spa_sanitize_checkbox',
			'type'=>'option'
			));

			$wp_customize->add_control('business_option[layout]' , array(
			'label' => __('Boxed Layout','business-a-spa' ),
			'section' => 'layout_section',
			'type'=>'checkbox',
			) );
			
		/* footer settings */
		$wp_customize->add_section( 'footer_settings' , array(
			'title'      => __('Footer', 'business-a-spa' ),
			'panel'  => 'general_settings',
			'priority'  => 7,
		) );
		
			// footer copyright
			$wp_customize->add_setting( 'business_option[footer_copyright]' , array(
			'default'    => '',
			'type'=>'option',
			'sanitize_callback' => 'sanitize_text_field',
			));

			$wp_customize->add_control('business_option[footer_copyright]' , array(
			'label' => __('Footer Copyright Text','business-a-spa' ),
			'section' => 'footer_settings',
			'type'=>'text',
			) );
			
			// footer social icon enable / disable
			$wp_customize->add_setting( 'business_option[footer_socialicon_enable]' , array(
			'default'    => true,
			'sanitize_callback' => 'business_a_spa_sanitize_checkbox',
			'type'=>'option'
			));

			$wp_customize->add_control('business_option[footer_socialicon_enable]' , array(
			'label' => __('Footer Social Icons Enable','business-a-spa' ),
			'section' => 'footer_settings',
			'type'=>'checkbox',
			) );
			
			// footer social icon title
			$wp_customize->add_setting( 'business_option[footer_socialicon_title]' , array(
			'default'    => '',
			'type'=>'option',
			'sanitize_callback' => 'sanitize_text_field',
			));

			$wp_customize->add_control('business_option[footer_socialicon_title]' , array(
			'label' => __('Footer social icon title','business-a-spa' ),
			'section' => 'footer_settings',
			'type'=>'text',
			) );
			
			// footer menus
			$wp_customize->add_setting( 'business_option[footer_menu]' , array(
			'default'    => true,
			'sanitize_callback' => 'business_a_spa_sanitize_checkbox',
			'type'=>'option'
			));

			$wp_customize->add_control('business_option[footer_menu]' , array(
			'label' => __('Footer Menu Enable','business-a-spa' ),
			'section' => 'footer_settings',
			'type'=>'checkbox',
			) );
			
	$wp_customize->get_section( 'colors' )->panel = 'general_settings'; // color settings
	$wp_customize->get_section( 'header_image' )->panel = 'general_settings'; // header settings
	$wp_customize->get_section( 'background_image' )->panel = 'general_settings'; // backround settings
	
			// custom color scheme
			$wp_customize->add_setting( 'business_option[custom_color_scheme]' , array(
			'default'    => '#62377d',
			'sanitize_callback' => 'business_a_spa_sanitize_hex_color',
			'type'=>'option'
			));
			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize , 'business_option[custom_color_scheme]' , array(
			'label' => __('Primary Color','business-a-spa'),
			'description'      => __('Select your custom color scheme.', 'business-a-spa'),
			'section' => 'colors',
			'settings'=>'business_option[custom_color_scheme]'
			) ) );
			
			$wp_customize->add_setting( 'business_option[site_title]', array(
                'sanitize_callback' => 'business_a_spa_sanitize_hex_color',
                'default' => '#242424',
                'transport' => 'postMessage',
				'type'=>'option',
            ) );
            $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'business_option[site_title]',
                array(
                    'label'       => esc_html__( 'Site Title Color', 'business-a-spa' ),
                    'section'     => 'colors',
                    'description' => '',
                )
            ));
			
			$wp_customize->add_setting( 'business_option[footer_background]', array(
                'sanitize_callback' => 'business_a_spa_sanitize_hex_color',
                'default' => '#2c2c2c',
                'transport' => 'postMessage',
				'type'=>'option',
            ) );
            $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'business_option[footer_background]',
                array(
                    'label'       => esc_html__( 'Footer Background', 'business-a-spa' ),
                    'section'     => 'colors',
                    'description' => '',
                )
            ));
			
			$wp_customize->add_setting( 'business_option[footer_info_background]', array(
                'sanitize_callback' => 'business_a_spa_sanitize_hex_color',
                'default' => '#242424',
                'transport' => 'postMessage',
				'type'=>'option',
            ) );
            $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'business_option[footer_info_background]',
                array(
                    'label'       => esc_html__( 'Footer Info Background', 'business-a-spa' ),
                    'section'     => 'colors',
                    'description' => '',
                )
            ));
}
}

add_action( 'wp_enqueue_scripts' , 'business_a_spa_script' );
function business_a_spa_script() {
	$parent_style = 'parent-style'; // Replace this with parent style handle.
	wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
	wp_enqueue_style( 'business-a-spa-style', get_stylesheet_uri(), array( $parent_style ) );
}