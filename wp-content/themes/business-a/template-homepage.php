<?php 
/**
 * Template Name: Home Page
 * This is custm home page template file
 *
 * @package WordPress
 * @subpackage business-a
 * @since Business-A 1.1
 */
$business_obj = new business_a_settings_array();
$option = wp_parse_args(  get_option( 'business_option', array() ), $business_obj->default_data() );
get_header();

	get_template_part('homepage','slider');

	get_template_part('homepage','service');
	
	get_template_part('homepage','shop');

    get_template_part('homepage','team');

    get_template_part('homepage','testimonial');

	get_template_part('homepage','news');
	 
	get_template_part('homepage','contact');
		
get_footer(); ?>