<?php
/*
 * enqueue scripts function
 */ 

if( !function_exists('business_a_scripts'))
{
	function business_a_scripts(){
		
		// business stylesheets
		wp_enqueue_style('bootstrap', BUSINESS_A_TEMPLATE_DIR_URI . '/css/bootstrap.min.css' );
		wp_enqueue_style('business-style', get_stylesheet_uri() );
		wp_enqueue_style('font-awesome', BUSINESS_A_TEMPLATE_DIR_URI . '/css/font-awesome/css/font-awesome.css' );
		wp_enqueue_style('business-woocommerce', BUSINESS_A_TEMPLATE_DIR_URI . '/css/woocommerce.css' );
		
		// business js
		wp_enqueue_script( 'bootstrap' , BUSINESS_A_TEMPLATE_DIR_URI . '/js/bootstrap.min.js' , array('jquery') );
		wp_enqueue_script( 'business-custom' , BUSINESS_A_TEMPLATE_DIR_URI . '/js/custom.js' );
		wp_enqueue_script( 'business-menu' , BUSINESS_A_TEMPLATE_DIR_URI . '/js/menu/menu.js' );
		
		if ( is_singular() ) wp_enqueue_script( "comment-reply" );	
	}
}
add_action('wp_enqueue_scripts','business_a_scripts');

// media upload
function business_a_upload_scripts()
{
	 wp_enqueue_media();	
	 wp_enqueue_script('media-upload');
     wp_enqueue_script('thickbox');
     wp_enqueue_script('upload_media_widget', BUSINESS_A_TEMPLATE_DIR_URI . '/js/upload-media.js', array('jquery'));
	 wp_enqueue_style('thickbox');
	 wp_enqueue_style('business-drag-drop',BUSINESS_A_TEMPLATE_DIR_URI.'/css/drag-drop.css');
	 wp_enqueue_style('business-about', BUSINESS_A_TEMPLATE_DIR_URI . '/css/about-theme.css' );
}
add_action("admin_enqueue_scripts","business_a_upload_scripts");


/**
 * Binds with Customizer preview reload changes.
 */
function business_a_customize_preview_js() {
    wp_enqueue_script( 'businessa_customizer_liveview', get_template_directory_uri() . '/js/customizer-liveview.js', array( 'customize-preview', 'customize-selective-refresh' ), false, true );
}
add_action( 'customize_preview_init', 'business_a_customize_preview_js', 65 );