<?php 
/*
 * Business settings 
 */
if( !class_exists('business_a_settings_array') ){
	
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
			'custom_color_scheme'=>'#ED0A71',
			
			'footer_copyright'=> '',
			'footer_socialicon_enable'=> true,
			'footer_socialicon_title'=> '',
			'footer_menu'=> true,
			'theme_color'=>'#EE5547',
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