<?php 
/*
 * Business Sidebar Registers
 */
 add_action('widgets_init','business_a_sidebar_function');
 function business_a_sidebar_function(){
	
	register_sidebar( array(
	'name' => __( 'Primary Sidebar', 'business-a' ),
	'id' => 'sidebar-primary',
	'description' => __( 'The primary widget area', 'business-a' ),
	'before_widget' => '<aside id="%1$s" class="widget %2$s">',
	'after_widget'  => '</aside>',
	'before_title'  => '<h3 class="widget-title">',
	'after_title'   => '</h3>',
	) );

	register_sidebar( array(
	'name' => __( 'Footer Sidebar 1', 'business-a' ),
	'id' => 'footer-1',
	'description' => __( 'The footer sidebar widget area 1', 'business-a' ),
	'before_widget' => '<aside id="%1$s" class="widget %2$s">',
	'after_widget'  => '</aside>',
	'before_title'  => '<h3 class="widget-title">',
	'after_title'   => '</h3>',
	) );
	
	register_sidebar( array(
	'name' => __( 'Footer Sidebar 2', 'business-a' ),
	'id' => 'footer-2',
	'description' => __( 'The footer sidebar widget area 2', 'business-a' ),
	'before_widget' => '<aside id="%1$s" class="widget %2$s">',
	'after_widget'  => '</aside>',
	'before_title'  => '<h3 class="widget-title">',
	'after_title'   => '</h3>',
	) );
	
	register_sidebar( array(
	'name' => __( 'Footer Sidebar 3', 'business-a' ),
	'id' => 'footer-3',
	'description' => __( 'The footer sidebar widget area 3', 'business-a' ),
	'before_widget' => '<aside id="%1$s" class="widget %2$s">',
	'after_widget'  => '</aside>',
	'before_title'  => '<h3 class="widget-title">',
	'after_title'   => '</h3>',
	) );
	
	register_sidebar( array(
	'name' => __( 'Footer Sidebar 4', 'business-a' ),
	'id' => 'footer-4',
	'description' => __( 'The footer sidebar widget area 4', 'business-a' ),
	'before_widget' => '<aside id="%1$s" class="widget %2$s">',
	'after_widget'  => '</aside>',
	'before_title'  => '<h3 class="widget-title">',
	'after_title'   => '</h3>',
	) );
	
	register_sidebar( array(
	'name' => __( 'Woocommerce Sidebar', 'business-a' ),
	'id' => 'sidebar-woocommerce',
	'description' => __( 'Woocommerce widget area', 'business-a' ),
	'before_widget' => '<aside id="%1$s" class="widget %2$s">',
	'after_widget'  => '</aside>',
	'before_title'  => '<h3 class="widget-title">',
	'after_title'   => '</h3>',
	) );
 }