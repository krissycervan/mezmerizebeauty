<?php 
/*
 * All themes functions
 *
 */

 
/*
 * business featured image
 *
 */
if ( ! function_exists( 'business_a_post_thumbnail' ) ) :
function business_a_post_thumbnail() {
$business_obj = new business_a_settings_array();
$option = wp_parse_args(  get_option( 'business_option', array() ), $business_obj->default_data() );
	
	if($option['blog_feature_image_enable']==true):

		if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
			return;
		}

		if ( is_singular() ) :
		?>
			<?php if( has_post_thumbnail() ){ ?>
			<div class="rdn-featured-image">
				<?php the_post_thumbnail(); ?>
			</div>
			<?php } ?>
			
		<?php
			 
		else : ?>
		
		<?php if( has_post_thumbnail() ){ ?>
		<div class="rdn-featured-image">
			<a href="<?php the_permalink(); ?>" class="post-thumbnail">
				<?php the_post_thumbnail(); ?>
			</a>
		</div>
		<?php } ?>

		<?php endif; // End is_singular()
		
	endif;
}
endif;

/*
 * business meta
 *
 */
if ( ! function_exists( 'business_a_post_meta' ) ) :
function business_a_post_meta(){
$business_obj = new business_a_settings_array();
$option = wp_parse_args(  get_option( 'business_option', array() ), $business_obj->default_data() );
	
	if($option['blog_meta_enable']==true):
	?>
	<div class="entry-meta">
		<span class="author"><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) );?>"><?php _e('Posted by: ','business-a' ); echo get_the_author_link();?></a></span>
		<span class="entry-date">
			<a href="<?php echo esc_url( get_month_link( get_post_time('Y') ,get_post_time('m') ) ); ?>">
				<?php _e('Posted on: ','business-a' ); echo esc_attr( get_the_date( get_option('date_format') ) ); ?>
			</a>
		</span>
		<?php the_tags( '<span class="tag-links">', ' , ', '</span>' ); ?>
	</div>
	<?php
	endif;
}
endif;


/**
 * Sets the content width in pixels.
 *
 * @global int $content_width
 */
function business_a_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'business_a_content_width', 728 );
}
add_action( 'after_setup_theme', 'business_a_content_width', 0 );

add_filter('get_avatar','business_a_gravatar_class');
function business_a_gravatar_class($class) {
    $class = str_replace("class='avatar", "class='img-circle", $class);
    return $class;
}

if ( ! function_exists( 'business_a_author_detail' ) ) :
function business_a_author_detail(){
?>
<section class="blog-author">
	<div class="media">
		<div class="pull-left">
			<?php echo get_avatar( get_the_author_meta( 'ID') , 103); ?>
		</div>
		<div class="media-body">
			<h3 class="author-title"><?php the_author(); ?></h3>
			<p><?php the_author_meta( 'description' ); ?></p>
		</div>
	</div>
</section>
<?php 
}
endif;

if ( ! function_exists( 'business_a_shop_content' ) ) :
/**
 * Displays shop section products
 *
 */
function business_a_shop_content( $shop_items, $is_callback = false ) {
	$args = array(
		'post_type' => 'product',
	);
	
	$args['posts_per_page'] = ! empty( $shop_items ) ? absint( $shop_items ) : 4;
	
	$loop = new WP_Query( $args );
	if ( $loop->have_posts() ) :
	$i = 1;
		echo '<div class="row">';
		while ( $loop->have_posts() ) :
			$loop->the_post();
			global $product;
			global $post;
			?>
			<div class="col-md-3 col-sm-6 product_item">
				<div class="product-item-area">
				
					<?php if ( has_post_thumbnail() ) : ?>
					<div class="product-image-area">
						<a href="<?php echo esc_url( get_permalink() ); ?>" title="<?php the_title_attribute(); ?>">
							<?php the_post_thumbnail(); ?>
						</a>
					</div>
					<?php endif; ?>
					
					<div class="product-category">
						<?php 
						if ( function_exists( 'wc_get_product_category_list' ) ) {
								$prod_id = get_the_ID();
								$product_categories = wc_get_product_category_list( $prod_id );
							} else {
								$product_categories = $product->get_categories();
							}
							
						if ( ! empty( $product_categories ) ) {
							$allowed_html = array(
								'a' => array(
									'href' => array(),
									'rel' => array(),
								),
							);
							echo '<h6 class="category">';
							echo wp_kses( $product_categories, $allowed_html );
							echo '</h6>';
						} ?>
					</div>
					
					<div class="product-content">
						<div class="product-title">
							<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
								<h3><?php esc_html( the_title() ); ?></h3>
							</a>
						</div>
						
						<?php if ( $post->post_excerpt ) : ?>
						<div class="product-description">
							<?php echo apply_filters( 'woocommerce_short_description', $post->post_excerpt ); ?>
						</div>
						<?php endif; ?>
						
						<div class="product-footer">
								<?php
							$product_price = $product->get_price_html();

							if ( ! empty( $product_price ) ) {

								echo '<div class="price"><h3>';

								echo wp_kses(
									$product_price, array(
										'span' => array(
											'class' => array(),
										),
										'del' => array(),
									)
								);

								echo '</h3></div>';

							}
							?>

							<div class="start-add-to-cart">
								<?php business_a_add_to_cart(); ?>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php
			if ( $i % 4 == 0 ) {
					echo '<div class="clearfix"></div>';
				}
				$i++;
				
		endwhile;
		echo '</div>';
	endif;
}
endif;
if ( ! function_exists( 'business_a_the_custom_logo' ) ) :
/**
 * Displays the optional custom logo.
 *
 */
function business_a_the_custom_logo() {
	the_custom_logo();
}
endif;
add_action('wp_head','business_a_color_scheme');
/* Business-a color scheme settings */
function business_a_color_scheme(){
	$obj = new business_a_settings_array();
	$option = wp_parse_args(  get_option( 'business_option', array() ), $obj->default_data() );
	$color = $option['custom_color_scheme'];
	echo '<style>';
		business_a_set_color( $color );
	echo '</style>';
}
function business_a_set_color( $color ){
	$obj = new business_a_settings_array();
	$option = wp_parse_args(  get_option( 'business_option', array() ), $obj->default_data() );
	
	list($r, $g, $b) = sscanf( $color, "#%02x%02x%02x");
	?>
	::selection{
		background-color:<?php echo $color; ?>;
		color:#fff;
	}
	#rdn-top-header,
	#rdn-footer .widget .tagcloud a{ background-color: <?php echo $color; ?>; }
	
	.navbar-default .navbar-nav > li > a:hover,
	.navbar-default .navbar-nav > li > a:focus,
	.navbar-default .navbar-nav > .active > a,
	.navbar-default .navbar-nav > .active > a:hover,
	.navbar-default .navbar-nav > .active > a:focus,
	.navbar-default .navbar-nav > .open > a,
	.navbar-default .navbar-nav > .open > a:hover,
	.navbar-default .navbar-nav > .open > a:focus,
	.navbar-default .navbar-nav > .dropdown.active > a,
	.dropdown-menu > .active > a, 
	.dropdown-menu > li > a:hover, 
	.dropdown-menu > li > a:focus,
	.dropdown-menu > .active > a:hover, 
	.dropdown-menu > .active > a:focus{
		background-color: <?php echo $color; ?>;
	}
	
	.dropdown-menu > .active > a, 
	.dropdown-menu > li > a:hover, 
	.dropdown-menu > li > a:focus,
	.dropdown-menu > .active > a:hover, 
	.dropdown-menu > .active > a:focus,
	.navbar-default .navbar-nav .open .dropdown-menu > li > a:hover, 
	.navbar-default .navbar-nav .open .dropdown-menu > li > a:focus,
	.navbar-default .navbar-nav .open .dropdown-menu > .active > a,
	.navbar-default .navbar-nav .open .dropdown-menu > .active > a:hover, 
	.navbar-default .navbar-nav .open .dropdown-menu > .active > a:focus{
		background-color: <?php echo $color; ?>;
	}

	a,
	a:hover,
	a:focus,
	a:active {
		color:<?php echo $color; ?>;
	}


	/*
	* slider
	*/
	.carousel-control{ color:<?php echo $color; ?>; }
	.carousel-control:hover{ background-color:<?php echo $color; ?>; border:1px solid <?php echo $color; ?>; }
	.carousel-indicators .active{ background-color:<?php echo $color; ?>; }
	.carousel-caption .rdn-slider-btn{ border:2px solid <?php echo $color; ?>; background-color:<?php echo $color; ?>; }

	.carousel-control{ border:1px solid <?php echo $color; ?>; }
	
	/*
	* callout
	*/
	#rdn-callout{ background-color:<?php echo $color; ?>; }
	.rdn-callout-btn:hover{ color:<?php echo $color; ?>; }

	/*
	* service
	*/
	.section-desc:before{ background-color:<?php echo $color; ?>; }
	.rdn-service-btn,.rdn-service-btn:hover{ 
		color:<?php echo $color; ?>;
		background-image: -webkit-gradient(linear, left bottom, left top, from(transparent), color-stop(0.0625em, transparent), color-stop(0.0625em, <?php echo $color; ?>), color-stop(0.125em, <?php echo $color; ?>), color-stop(0.125em, transparent));
		
		background-image: linear-gradient(to top, transparent, transparent 0.0625em, <?php echo $color; ?> 0.0625em, <?php echo $color; ?> 0.125em, transparent 0.125em);
	}
	.rdn-service-icon i.fa{ color:<?php echo $color; ?>; }

	/*
	* home news
	*/
	.more-link{ border:2px solid <?php echo $color; ?>; color:<?php echo $color; ?>; }
	.more-link:hover, .more-link:focus{ background-color:<?php echo $color; ?>; }

	/*
	* portfolio
	*/
	.portfolio-overlay{
	}

	.rdn-portfolio-tabs li a{
		color:<?php echo $color; ?>;
	}

	.rdn-portfolio-tabs .active{
		background-color:<?php echo $color; ?>;
	}


	/*
	* testimonial
	*/
	.testimonial-more{	border-bottom:1px dotted <?php echo $color; ?>; }

	/*
	* team
	*/
	.team-title h3, 
	.team-title:hover h3,
	.team-title:focus h3 { color:<?php echo $color; ?>; }
	.team-more-link{ background-color:<?php echo $color; ?>; }



	/*
	* contact
	*/
	.contact_section_heading{ color:<?php echo $color; ?>; }
	.rdn-page-social li:hover{ background-color:<?php echo $color; ?>; border:1px solid <?php echo $color; ?>;}
	.entry-title a:hover,
	.entry-title a:focus, 
	.entry-meta span a:hover, 
	.entry-meta span a:focus{
		color:<?php echo $color; ?>;
	}
	
	/*
	* clinet
	*/
	.carousel-control-client.left,  
	.carousel-control-client.right{ background-color:<?php echo $color; ?>; }

	/*
	* button
	*/
	button,
	button[disabled]:hover,
	button[disabled]:focus,
	input[type="button"],
	input[type="button"][disabled]:hover,
	input[type="button"][disabled]:focus,
	input[type="reset"],
	input[type="reset"][disabled]:hover,
	input[type="reset"][disabled]:focus,
	input[type="submit"],
	input[type="submit"][disabled]:hover,
	input[type="submit"][disabled]:focus {
		border: 2px solid <?php echo $color; ?>;
		color:<?php echo $color; ?>;
	}

	button:hover,
	button:focus,
	input[type="button"]:hover,
	input[type="button"]:focus,
	input[type="reset"]:hover,
	input[type="reset"]:focus,
	input[type="submit"]:hover,
	input[type="submit"]:focus {
		background: <?php echo $color; ?>;
	}

	/*
	* input
	*/
	input[type="text"],
	input[type="email"],
	input[type="url"],
	input[type="password"],
	input[type="search"],
	input[type="tel"],
	input[type="number"],
	textarea {
		border-bottom: 1px solid <?php echo $color; ?>;
	}

	blockquote { border-left: 4px solid <?php echo $color; ?>; }

	/*
	* Widgets
	*/
	.widget .widget-title:after, 
	.widget_search .search-submit,  
	.widget_calendar #wp-calendar caption, 
	.tagcloud a:hover,
	.tagcloud a:focus{ background-color:<?php echo $color; ?>; }

	.widget-title a, 
	.widget-title a:hover,  
	.widget-title a:focus, 
	.widget  li  a:hover, 
	.widget  li  a:focus,  
	.widget li:before, 
	.widget_calendar #wp-calendar th, 
	.tagcloud a, 
	.widget_text a:hover, 
	.widget_text a:focus, 
	#rdn-footer .widget .news-title a:hover, 
	#rdn-footer .widget .news-title a:focus{ color:<?php echo $color; ?>; }

	#rdn-footer .widget li a:hover, 
	#rdn-footer .widget li a:focus, 
	#rdn-footer .widget li a:active, 
	.widget .news-title a:hover, 
	.widget .news-title a:focus{
		color:<?php echo $color; ?>;
	}

	/*
	* footer
	*/
	.footer-social-icons li:hover{ background-color:<?php echo $color; ?>; }
	.rdn-copyright p > a, .rdn-copyright p > a:hover, .rdn-copyright p > a:focus { color:<?php echo $color; ?>; }
	.rdn-footer-menu li a:hover, 
	.rdn-footer-menu li a:focus{ 
		color:<?php echo $color; ?>; 
	}

	#rdn-footer .widget a:hover, 
	#rdn-footer .widget a:focus{
		color:<?php echo $color; ?>;
	}

	/*
	* sub header
	*/
	.rdn-sub-header li .active, 
	.rdn-sub-header ul li:before{ color:<?php echo $color; ?>; }
	.rdn-sub-header ul li:first-child:before{ display:none; }


	/*
	* comment
	*/
	.comments-title:after, 
	.comment-reply-title:after{
		border-bottom:1px solid <?php echo $color; ?>;
	}
	.reply:before{
		color:<?php echo $color; ?>;
	}


	/*
	* pagination
	*/

	.pagination li a{
		color:<?php echo $color; ?>;
	}

	.pagination li a, 
	.pagination li a:hover, 
	.pagination li a:focus,
	.nav-links li span.current, 
	.nav-links li:hover span.current, 
	.nav-links li:focus span.current{
		border:1px solid <?php echo $color; ?>;
	}

	.pagination .current a, 
	.pagination .current:hover a, 
	.pagination .current:focus a,
	.pagination li:hover a, 
	.pagination li:focus a,
	.nav-links li span.current,
	.nav-links li:hover span.current, 
	.nav-links li:focus span.current
	{
		background-color:<?php echo $color; ?>;
	}

	.page-links a {
		border:1px solid <?php echo $color; ?>;
		color:<?php echo $color; ?>;
	}
	.page-links > a:hover{
		background-color:<?php echo $color; ?>;
	}

	/*
	* post stylish
	*/
	.post-style-header{
		background-color:<?php echo $color; ?>;
	}

	.entry-style-content{
		/* border-bottom:2px solid <?php echo $color; ?>; */
	}

	.entry-style-date span strong{
		color:<?php echo $color; ?>;
		border:5px solid <?php echo $color; ?>;
	}


	/*
	* page scroll
	*/
	.rdn_page_scroll{
		background-color:<?php echo $color; ?>;
	}
	
	/*
	 * Woocommerce color css
	 */
	.woocommerce #respond input#submit.alt, 
	 .woocommerce a.button.alt, 
	 .woocommerce button.button.alt, 
	 .woocommerce input.button.alt,
	 .woocommerce #respond input#submit.alt:hover, 
	 .woocommerce a.button.alt:hover, 
	 .woocommerce button.button.alt:hover, 
	 .woocommerce input.button.alt:hover,
	 .woocommerce #respond input#submit.disabled:hover, 
	 .woocommerce #respond input#submit:disabled:hover, 
	 .woocommerce #respond input#submit:disabled[disabled]:hover, 
	 .woocommerce a.button.disabled:hover, 
	 .woocommerce a.button:disabled:hover, 
	 .woocommerce a.button:disabled[disabled]:hover, 
	 .woocommerce button.button.disabled:hover, 
	 .woocommerce button.button:disabled:hover, 
	 .woocommerce button.button:disabled[disabled]:hover, 
	 .woocommerce input.button.disabled:hover, 
	 .woocommerce input.button:disabled:hover, 
	 .woocommerce input.button:disabled[disabled]:hover,
	 .woocommerce #respond input#submit.disabled, 
	 .woocommerce #respond input#submit:disabled, 
	 .woocommerce #respond input#submit:disabled[disabled], 
	 .woocommerce a.button.disabled, .woocommerce a.button:disabled, 
	 .woocommerce a.button:disabled[disabled], 
	 .woocommerce button.button.disabled, 
	 .woocommerce button.button:disabled, 
	 .woocommerce button.button:disabled[disabled], 
	 .woocommerce input.button.disabled, 
	 .woocommerce input.button:disabled, 
	 .woocommerce input.button:disabled[disabled],
	 .woocommerce #respond input#submit, 
	 .woocommerce a.button, 
	 .woocommerce button.button, 
	 .woocommerce input.button,
	 #add_payment_method .wc-proceed-to-checkout a.checkout-button, 
	 .woocommerce-cart .wc-proceed-to-checkout a.checkout-button, 
	 .woocommerce-checkout .wc-proceed-to-checkout a.checkout-button,
	 .woocommerce span.onsale,
	 .woocommerce .widget_price_filter .ui-slider .ui-slider-range,
	 .woocommerce .widget_price_filter .ui-slider .ui-slider-handle,
	 .product_item .added_to_cart.wc-forward{
		background: <?php echo $color; ?>;
	 }
	
	/*
	 * pricing table
	 */
	 
	.pricing_wrapper.active{
		border-color: <?php echo $color; ?>;
	}
	.pricing_wrapper .pricing_header h1{
		color: <?php echo $color; ?>;
	}
	.pricing_wrapper.active .pricing_footer a{
		background-color: <?php echo $color; ?>;
		border-color: <?php echo $color; ?>;
	}
	.pricing_wrapper.active .pricing_footer a:hover,
	.pricing_wrapper.active .pricing_footer a:focus{
		color: <?php echo $color; ?>;
	}
	.pricing_wrapper .pricing_footer a{
		color: <?php echo $color; ?>;
	}
	.pricing_wrapper .pricing_footer a:hover, 
	.pricing_wrapper .pricing_footer a:focus{
		background-color: <?php echo $color; ?>;
		border-color: <?php echo $color; ?>;
		color: #ffffff;
	}
	.pricing_ribben{
		background-color: <?php echo $color; ?>;
	}
	
	
	<?php if( $option['site_title'] != '' ){ ?>
	.site-title{ color: <?php echo $option['site_title']; ?>; }
	<?php } ?>
	
	<?php if( $option['footer_background'] != '' ){ ?>
	.rdn-footer-top{
		    background: <?php echo $option['footer_background']; ?>;
	}
	<?php } ?>
	
	<?php if( $option['footer_info_background'] != '' ){ ?>
	.rdn-footer-bottom{
		    background: <?php echo $option['footer_info_background']; ?>;
	}
	<?php } ?>
	
	body { 
		<?php if( $option['general_fontsize'] != '' ){ ?>
		font-size: <?php echo $option['general_fontsize']; ?>px; 
		<?php } ?>
		<?php if( $option['general_fontfamily'] != '' ){ ?>
		font-family: '<?php echo $option['general_fontfamily']; ?>', sans-serif; 
		<?php } ?>
		<?php if( $option['general_fontstyle'] != '' ){ ?>
		font-style: <?php echo $option['general_fontstyle']; ?>; 
		<?php } ?>
	}
	h1, .h1 { 
		<?php if( $option['h1_fontsize'] != '' ){ ?>
		font-size: <?php echo $option['h1_fontsize']; ?>px; 
		<?php } ?>
		<?php if( $option['h1_fontfamily'] != '' ){ ?>
		font-family: '<?php echo $option['h1_fontfamily']; ?>', sans-serif; 
		<?php } ?>
		<?php if( $option['h1_fontstyle'] != '' ){ ?>
		font-style: <?php echo $option['h1_fontstyle']; ?>; 
		<?php } ?> 
	}
	h2, .h2 { 
		<?php if( $option['h2_fontsize'] != '' ){ ?>
		font-size: <?php echo $option['h2_fontsize']; ?>px; 
		<?php } ?>
		<?php if( $option['h2_fontfamily'] != '' ){ ?>
		font-family: '<?php echo $option['h2_fontfamily']; ?>', sans-serif; 
		<?php } ?>
		<?php if( $option['h2_fontstyle'] != '' ){ ?>
		font-style: <?php echo $option['h2_fontstyle']; ?>; 
		<?php } ?>
	}
	h3, .h3 { 
		<?php if( $option['h3_fontsize'] != '' ){ ?>
		font-size: <?php echo $option['h3_fontsize']; ?>px; 
		<?php } ?>
		<?php if( $option['h3_fontfamily'] != '' ){ ?>
		font-family: '<?php echo $option['h3_fontfamily']; ?>', sans-serif; 
		<?php } ?>
		<?php if( $option['h3_fontstyle'] != '' ){ ?>
		font-style: <?php echo $option['h3_fontstyle']; ?>; 
		<?php } ?> 
	}
	h4, .h4 { 
		<?php if( $option['h4_fontsize'] != '' ){ ?>
		font-size: <?php echo $option['h4_fontsize']; ?>px; 
		<?php } ?>
		<?php if( $option['h4_fontfamily'] != '' ){ ?>
		font-family: '<?php echo $option['h4_fontfamily']; ?>', sans-serif; 
		<?php } ?>
		<?php if( $option['h4_fontstyle'] != '' ){ ?>
		font-style: <?php echo $option['h4_fontstyle']; ?>; 
		<?php } ?>
	}
	h5, .h5 { 
		<?php if( $option['h5_fontsize'] != '' ){ ?>
		font-size: <?php echo $option['h5_fontsize']; ?>px; 
		<?php } ?>
		<?php if( $option['h5_fontfamily'] != '' ){ ?>
		font-family: '<?php echo $option['h5_fontfamily']; ?>', sans-serif; 
		<?php } ?>
		<?php if( $option['h5_fontstyle'] != '' ){ ?>
		font-style: <?php echo $option['h5_fontstyle']; ?>; 
		<?php } ?>
	}
	h6, .h6 { 
		<?php if( $option['h6_fontsize'] != '' ){ ?>
		font-size: <?php echo $option['h6_fontsize']; ?>px; 
		<?php } ?>
		<?php if( $option['h6_fontfamily'] != '' ){ ?>
		font-family: '<?php echo $option['h6_fontfamily']; ?>', sans-serif; 
		<?php } ?>
		<?php if( $option['h6_fontstyle'] != '' ){ ?>
		font-style: <?php echo $option['h6_fontstyle']; ?>; 
		<?php } ?>
	}
	
	
	<?php
}


/* Business Typography Settings */
function business_a_font_size(){
	$font_size = array();
	for( $i=9; $i<=100; $i++ ){		
	
		$font_size[$i] = $i;
		
	}
	return $font_size;
}
function business_a_font_family(){

	$font_family = array(	"ABeeZee" => "ABeeZee",
							"Abel" => "Abel",
							"Abril Fatface" => "Abril Fatface",
							"Aclonica" => "Aclonica",
							"Acme" => "Acme",
							"Actor" => "Actor",
							"Adamina" => "Adamina",
							"Advent Pro" => "Advent Pro",
							"Aguafina Script" => "Aguafina Script",
							"Akronim" => "Akronim",
							"Aladin" => "Aladin",
							"Aldrich" => "Aldrich",
							"Alegreya" => "Alegreya",
							"Alegreya SC" => "Alegreya SC",
							"Alex Brush" => "Alex Brush",
							"Alfa Slab One" => "Alfa Slab One",
							"Alice" => "Alice",
							"Alike" => "Alike",
							"Alike Angular" => "Alike Angular",
							"Allan" => "Allan",
							"Allerta" => "Allerta",
							"Allerta Stencil" => "Allerta Stencil",
							"Allura" => "Allura",
							"Almendra" => "Almendra",
							"Almendra Display" => "Almendra Display",
							"Almendra SC" => "Almendra SC",
							"Amarante" => "Amarante",
							"Amaranth" => "Amaranth",
							"Amatic SC" => "Amatic SC",
							"Amethysta" => "Amethysta",
							"Anaheim" => "Anaheim",
							"Andada" => "Andada",
							"Andika" => "Andika",
							"Angkor" => "Angkor",
							"Annie Use Your Telescope" => "Annie Use Your Telescope",
							"Anonymous Pro" => "Anonymous Pro",
							"Antic" => "Antic",
							"Antic Didone" => "Antic Didone",
							"Antic Slab" => "Antic Slab",
							"Anton" => "Anton",
							"Arapey" => "Arapey",
							"Arbutus" => "Arbutus",
							"Arbutus Slab" => "Arbutus Slab",
							"Architects Daughter" => "Architects Daughter",
							"Archivo Black" => "Archivo Black",
							"Archivo Narrow" => "Archivo Narrow",
							"Arimo" => "Arimo",
							"Arizonia" => "Arizonia",
							"Armata" => "Armata",
							"Artifika" => "Artifika",
							"Arvo" => "Arvo",
							"Asap" => "Asap",
							"Asset" => "Asset",
							"Astloch" => "Astloch",
							"Asul" => "Asul",
							"Atomic Age" => "Atomic Age",
							"Aubrey" => "Aubrey",
							"Audiowide" => "Audiowide",
							"Autour One" => "Autour One",
							"Average" => "Average",
							"Average Sans" => "Average Sans",
							"Averia Gruesa Libre" => "Averia Gruesa Libre",
							"Averia Libre" => "Averia Libre",
							"Averia Sans Libre" => "Averia Sans Libre",
							"Averia Serif Libre" => "Averia Serif Libre",
							"Bad Script" => "Bad Script",
							"Balthazar" => "Balthazar",
							"Bangers" => "Bangers",
							"Basic" => "Basic",
							"Battambang" => "Battambang",
							"Baumans" => "Baumans",
							"Bayon" => "Bayon",
							"Belgrano" => "Belgrano",
							"Belleza" => "Belleza",
							"BenchNine" => "BenchNine",
							"Bentham" => "Bentham",
							"Berkshire Swash" => "Berkshire Swash",
							"Bevan" => "Bevan",
							"Bigelow Rules" => "Bigelow Rules",
							"Bigshot One" => "Bigshot One",
							"Bilbo" => "Bilbo",
							"Bilbo Swash Caps" => "Bilbo Swash Caps",
							"Bitter" => "Bitter",
							"Black Ops One" => "Black Ops One",
							"Bokor" => "Bokor",
							"Bonbon" => "Bonbon",
							"Boogaloo" => "Boogaloo",
							"Bowlby One" => "Bowlby One",
							"Bowlby One SC" => "Bowlby One SC",
							"Brawler" => "Brawler",
							"Bree Serif" => "Bree Serif",
							"Bubblegum Sans" => "Bubblegum Sans",
							"Bubbler One" => "Bubbler One",
							"Buda" => "Buda",
							"Buenard" => "Buenard",
							"Butcherman" => "Butcherman",
							"Butterfly Kids" => "Butterfly Kids",
							"Cabin" => "Cabin",
							"Cabin Condensed" => "Cabin Condensed",
							"Cabin Sketch" => "Cabin Sketch",
							"Caesar Dressing" => "Caesar Dressing",
							"Cagliostro" => "Cagliostro",
							"Calligraffitti" => "Calligraffitti",
							"Cambo" => "Cambo",
							"Candal" => "Candal",
							"Cantarell" => "Cantarell",
							"Cantata One" => "Cantata One",
							"Cantora One" => "Cantora One",
							"Capriola" => "Capriola",
							"Cardo" => "Cardo",
							"Carme" => "Carme",
							"Carrois Gothic" => "Carrois Gothic",
							"Carrois Gothic SC" => "Carrois Gothic SC",
							"Carter One" => "Carter One",
							"Caudex" => "Caudex",
							"Cedarville Cursive" => "Cedarville Cursive",
							"Ceviche One" => "Ceviche One",
							"Changa One" => "Changa One",
							"Chango" => "Chango",
							"Chau Philomene One" => "Chau Philomene One",
							"Chela One" => "Chela One",
							"Chelsea Market" => "Chelsea Market",
							"Chenla" => "Chenla",
							"Cherry Cream Soda" => "Cherry Cream Soda",
							"Cherry Swash" => "Cherry Swash",
							"Chewy" => "Chewy",
							"Chicle" => "Chicle",
							"Chivo" => "Chivo",
							"Cinzel" => "Cinzel",
							"Cinzel Decorative" => "Cinzel Decorative",
							"Clicker Script" => "Clicker Script",
							"Coda" => "Coda",
							"Coda Caption" => "Coda Caption",
							"Codystar" => "Codystar",
							"Combo" => "Combo",
							"Comfortaa" => "Comfortaa",
							"Coming Soon" => "Coming Soon",
							"Concert One" => "Concert One",
							"Condiment" => "Condiment",
							"Content" => "Content",
							"Contrail One" => "Contrail One",
							"Convergence" => "Convergence",
							"Cookie" => "Cookie",
							"Copse" => "Copse",
							"Corben" => "Corben",
							"Courgette" => "Courgette",
							"Cousine" => "Cousine",
							"Coustard" => "Coustard",
							"Covered By Your Grace" => "Covered By Your Grace",
							"Crafty Girls" => "Crafty Girls",
							"Creepster" => "Creepster",
							"Crete Round" => "Crete Round",
							"Crimson Text" => "Crimson Text",
							"Croissant One" => "Croissant One",
							"Crushed" => "Crushed",
							"Cuprum" => "Cuprum",
							"Cutive" => "Cutive",
							"Cutive Mono" => "Cutive Mono",
							"Damion" => "Damion",
							"Dancing Script" => "Dancing Script",
							"Dangrek" => "Dangrek",
							"Dawning of a New Day" => "Dawning of a New Day",
							"Days One" => "Days One",
							"Delius" => "Delius",
							"Delius Swash Caps" => "Delius Swash Caps",
							"Delius Unicase" => "Delius Unicase",
							"Della Respira" => "Della Respira",
							"Denk One" => "Denk One",
							"Devonshire" => "Devonshire",
							"Didact Gothic" => "Didact Gothic",
							"Diplomata" => "Diplomata",
							"Diplomata SC" => "Diplomata SC",
							"Domine" => "Domine",
							"Donegal One" => "Donegal One",
							"Doppio One" => "Doppio One",
							"Dorsa" => "Dorsa",
							"Dosis" => "Dosis",
							"Dr Sugiyama" => "Dr Sugiyama",
							"Droid Sans" => "Droid Sans",
							"Droid Sans Mono" => "Droid Sans Mono",
							"Droid Serif" => "Droid Serif",
							"Duru Sans" => "Duru Sans",
							"Dynalight" => "Dynalight",
							"EB Garamond" => "EB Garamond",
							"Eagle Lake" => "Eagle Lake",
							"Eater" => "Eater",
							"Ek Mukta"=>"Ek Mukta",
							"Economica" => "Economica",
							"Electrolize" => "Electrolize",
							"Elsie" => "Elsie",
							"Elsie Swash Caps" => "Elsie Swash Caps",
							"Emblema One" => "Emblema One",
							"Emilys Candy" => "Emilys Candy",
							"Engagement" => "Engagement",
							"Englebert" => "Englebert",
							"Enriqueta" => "Enriqueta",
							"Erica One" => "Erica One",
							"Esteban" => "Esteban",
							"Euphoria Script" => "Euphoria Script",
							"Ewert" => "Ewert",
							"Exo" => "Exo",
							"Expletus Sans" => "Expletus Sans",
							"Fanwood Text" => "Fanwood Text",
							"Fascinate" => "Fascinate",
							"Fascinate Inline" => "Fascinate Inline",
							"Faster One" => "Faster One",
							"Fasthand" => "Fasthand",
							"Federant" => "Federant",
							"Federo" => "Federo",
							"Felipa" => "Felipa",
							"Fenix" => "Fenix",
							"Finger Paint" => "Finger Paint",
							"Fjalla One" => "Fjalla One",
							"Fjord One" => "Fjord One",
							"Flamenco" => "Flamenco",
							"Flavors" => "Flavors",
							"Fondamento" => "Fondamento",
							"Fontdiner Swanky" => "Fontdiner Swanky",
							"Forum" => "Forum",
							"Francois One" => "Francois One",
							"Freckle Face" => "Freckle Face",
							"Fredericka the Great" => "Fredericka the Great",
							"Fredoka One" => "Fredoka One",
							"Freehand" => "Freehand",
							"Fresca" => "Fresca",
							"Frijole" => "Frijole",
							"Fruktur" => "Fruktur",
							"Fugaz One" => "Fugaz One",
							"GFS Didot" => "GFS Didot",
							"GFS Neohellenic" => "GFS Neohellenic",
							"Gabriela" => "Gabriela",
							"Gafata" => "Gafata",
							"Galdeano" => "Galdeano",
							"Galindo" => "Galindo",
							"Gentium Basic" => "Gentium Basic",
							"Gentium Book Basic" => "Gentium Book Basic",
							"Geo" => "Geo",
							"Geostar" => "Geostar",
							"Geostar Fill" => "Geostar Fill",
							"Germania One" => "Germania One",
							"Gilda Display" => "Gilda Display",
							"Give You Glory" => "Give You Glory",
							"Glass Antiqua" => "Glass Antiqua",
							"Glegoo" => "Glegoo",
							"Gloria Hallelujah" => "Gloria Hallelujah",
							"Goblin One" => "Goblin One",
							"Gochi Hand" => "Gochi Hand",
							"Gorditas" => "Gorditas",
							"Goudy Bookletter 1911" => "Goudy Bookletter 1911",
							"Graduate" => "Graduate",
							"Grand Hotel" => "Grand Hotel",
							"Gravitas One" => "Gravitas One",
							"Great Vibes" => "Great Vibes",
							"Griffy" => "Griffy",
							"Gruppo" => "Gruppo",
							"Gudea" => "Gudea",
							"Habibi" => "Habibi",
							"Hammersmith One" => "Hammersmith One",
							"Hanalei" => "Hanalei",
							"Hanalei Fill" => "Hanalei Fill",
							"Handlee" => "Handlee",
							"Hanuman" => "Hanuman",
							"Happy Monkey" => "Happy Monkey",
							"Headland One" => "Headland One",
							"Henny Penny" => "Henny Penny",
							"Herr Von Muellerhoff" => "Herr Von Muellerhoff",
							"Holtwood One SC" => "Holtwood One SC",
							"Homemade Apple" => "Homemade Apple",
							"Homenaje" => "Homenaje",
							"IM Fell DW Pica" => "IM Fell DW Pica",
							"IM Fell DW Pica SC" => "IM Fell DW Pica SC",
							"IM Fell Double Pica" => "IM Fell Double Pica",
							"IM Fell Double Pica SC" => "IM Fell Double Pica SC",
							"IM Fell English" => "IM Fell English",
							"IM Fell English SC" => "IM Fell English SC",
							"IM Fell French Canon" => "IM Fell French Canon",
							"IM Fell French Canon SC" => "IM Fell French Canon SC",
							"IM Fell Great Primer" => "IM Fell Great Primer",
							"IM Fell Great Primer SC" => "IM Fell Great Primer SC",
							"Iceberg" => "Iceberg",
							"Iceland" => "Iceland",
							"Imprima" => "Imprima",
							"Inconsolata" => "Inconsolata",
							"Inder" => "Inder",
							"Indie Flower" => "Indie Flower",
							"Inika" => "Inika",
							"Irish Grover" => "Irish Grover",
							"Istok Web" => "Istok Web",
							"Italiana" => "Italiana",
							"Italianno" => "Italianno",
							"Jacques Francois" => "Jacques Francois",
							"Jacques Francois Shadow" => "Jacques Francois Shadow",
							"Jim Nightshade" => "Jim Nightshade",
							"Jockey One" => "Jockey One",
							"Jolly Lodger" => "Jolly Lodger",
							"Josefin Sans" => "Josefin Sans",
							"Josefin Slab" => "Josefin Slab",
							"Joti One" => "Joti One",
							"Judson" => "Judson",
							"Julee" => "Julee",
							"Julius Sans One" => "Julius Sans One",
							"Junge" => "Junge",
							"Jura" => "Jura",
							"Just Another Hand" => "Just Another Hand",
							"Just Me Again Down Here" => "Just Me Again Down Here",
							"Kameron" => "Kameron",
							"Karla" => "Karla",
							"Kaushan Script" => "Kaushan Script",
							"Kavoon" => "Kavoon",
							"Keania One" => "Keania One",
							"Kelly Slab" => "Kelly Slab",
							"Kenia" => "Kenia",
							"Khmer" => "Khmer",
							"Kite One" => "Kite One",
							"Knewave" => "Knewave",
							"Kotta One" => "Kotta One",
							"Koulen" => "Koulen",
							"Kranky" => "Kranky",
							"Kreon" => "Kreon",
							"Kristi" => "Kristi",
							"Krona One" => "Krona One",
							"La Belle Aurore" => "La Belle Aurore",
							"Lancelot" => "Lancelot",
							"Lato" => "Lato",
							"League Script" => "League Script",
							"Leckerli One" => "Leckerli One",
							"Ledger" => "Ledger",
							"Lekton" => "Lekton",
							"Lemon" => "Lemon",
							"Libre Baskerville" => "Libre Baskerville",
							"Life Savers" => "Life Savers",
							"Lilita One" => "Lilita One",
							"Limelight" => "Limelight",
							"Linden Hill" => "Linden Hill",
							"Lobster" => "Lobster",
							"Lobster Two" => "Lobster Two",
							"Londrina Outline" => "Londrina Outline",
							"Londrina Shadow" => "Londrina Shadow",
							"Londrina Sketch" => "Londrina Sketch",
							"Londrina Solid" => "Londrina Solid",
							"Lora" => "Lora",
							"Love Ya Like A Sister" => "Love Ya Like A Sister",
							"Loved by the King" => "Loved by the King",
							"Lovers Quarrel" => "Lovers Quarrel",
							"Luckiest Guy" => "Luckiest Guy",
							"Lusitana" => "Lusitana",
							"Lustria" => "Lustria",
							"Macondo" => "Macondo",
							"Macondo Swash Caps" => "Macondo Swash Caps",
							"Magra" => "Magra",
							"Maiden Orange" => "Maiden Orange",
							"Mako" => "Mako",
							"Marcellus" => "Marcellus",
							"Marcellus SC" => "Marcellus SC",
							"Marck Script" => "Marck Script",
							"Margarine" => "Margarine",
							"Marko One" => "Marko One",
							"Marmelad" => "Marmelad",
							"Marvel" => "Marvel",
							"Mate" => "Mate",
							"Mate SC" => "Mate SC",
							"Maven Pro" => "Maven Pro",
							"McLaren" => "McLaren",
							"Meddon" => "Meddon",
							"MedievalSharp" => "MedievalSharp",
							"Medula One" => "Medula One",
							"Megrim" => "Megrim",
							"Meie Script" => "Meie Script",
							"Merienda" => "Merienda",
							"Merienda One" => "Merienda One",
							"Merriweather" => "Merriweather",
							"Merriweather Sans" => "Merriweather Sans",
							"Metal" => "Metal",
							"Metal Mania" => "Metal Mania",
							"Metamorphous" => "Metamorphous",
							"Metrophobic" => "Metrophobic",
							"Michroma" => "Michroma",
							"Milonga" => "Milonga",
							"Miltonian" => "Miltonian",
							"Miltonian Tattoo" => "Miltonian Tattoo",
							"Miniver" => "Miniver",
							"Miss Fajardose" => "Miss Fajardose",
							"Modern Antiqua" => "Modern Antiqua",
							"Molengo" => "Molengo",
							"Molle" => "Molle",
							"Monda" => "Monda",
							"Monofett" => "Monofett",
							"Monoton" => "Monoton",
							"Monsieur La Doulaise" => "Monsieur La Doulaise",
							"Montaga" => "Montaga",
							"Montez" => "Montez",
							"Montserrat" => "Montserrat",
							"Montserrat Alternates" => "Montserrat Alternates",
							"Montserrat Subrayada" => "Montserrat Subrayada",
							"Moul" => "Moul",
							"Moulpali" => "Moulpali",
							"Mountains of Christmas" => "Mountains of Christmas",
							"Mouse Memoirs" => "Mouse Memoirs",
							"Mr Bedfort" => "Mr Bedfort",
							"Mr Dafoe" => "Mr Dafoe",
							"Mr De Haviland" => "Mr De Haviland",
							"Mrs Saint Delafield" => "Mrs Saint Delafield",
							"Mrs Sheppards" => "Mrs Sheppards",
							"Muli" => "Muli",
							"Mystery Quest" => "Mystery Quest",
							"Neucha" => "Neucha",
							"Neuton" => "Neuton",
							"New Rocker" => "New Rocker",
							"News Cycle" => "News Cycle",
							"Niconne" => "Niconne",
							"Nixie One" => "Nixie One",
							"Nobile" => "Nobile",
							"Nokora" => "Nokora",
							"Norican" => "Norican",
							"Nosifer" => "Nosifer",
							"Nothing You Could Do" => "Nothing You Could Do",
							"Noticia Text" => "Noticia Text",
							"Nova Cut" => "Nova Cut",
							"Nova Flat" => "Nova Flat",
							"Nova Mono" => "Nova Mono",
							"Nova Oval" => "Nova Oval",
							"Nova Round" => "Nova Round",
							"Nova Script" => "Nova Script",
							"Nova Slim" => "Nova Slim",
							"Nova Square" => "Nova Square",
							"Numans" => "Numans",
							"Nunito" => "Nunito",
							"Odor Mean Chey" => "Odor Mean Chey",
							"Offside" => "Offside",
							"Old Standard TT" => "Old Standard TT",
							"Oldenburg" => "Oldenburg",
							"Oleo Script" => "Oleo Script",
							"Oleo Script Swash Caps" => "Oleo Script Swash Caps",
							"Open Sans" => "Open Sans",
							"Open Sans Condensed" => "Open Sans Condensed",
							"Oranienbaum" => "Oranienbaum",
							"Orbitron" => "Orbitron",
							"Oregano" => "Oregano",
							"Orienta" => "Orienta",
							"Original Surfer" => "Original Surfer",
							"Oswald" => "Oswald",
							"Over the Rainbow" => "Over the Rainbow",
							"Overlock" => "Overlock",
							"Overlock SC" => "Overlock SC",
							"Ovo" => "Ovo",
							"Oxygen" => "Oxygen",
							"Oxygen Mono" => "Oxygen Mono",
							"PT Mono" => "PT Mono",
							"PT Sans" => "PT Sans",
							"PT Sans Caption" => "PT Sans Caption",
							"PT Sans Narrow" => "PT Sans Narrow",
							"PT Serif" => "PT Serif",
							"PT Serif Caption" => "PT Serif Caption",
							"Pacifico" => "Pacifico",
							"Paprika" => "Paprika",
							"Parisienne" => "Parisienne",
							"Passero One" => "Passero One",
							"Passion One" => "Passion One",
							"Patrick Hand" => "Patrick Hand",
							"Patrick Hand SC" => "Patrick Hand SC",
							"Patua One" => "Patua One",
							"Paytone One" => "Paytone One",
							"Peralta" => "Peralta",
							"Permanent Marker" => "Permanent Marker",
							"Petit Formal Script" => "Petit Formal Script",
							"Petrona" => "Petrona",
							"Philosopher" => "Philosopher",
							"Piedra" => "Piedra",
							"Pinyon Script" => "Pinyon Script",
							"Pirata One" => "Pirata One",
							"Plaster" => "Plaster",
							"Play" => "Play",
							"Playball" => "Playball",
							"Playfair Display" => "Playfair Display",
							"Playfair Display SC" => "Playfair Display SC",
							"Podkova" => "Podkova",
							"Poiret One" => "Poiret One",
							"Poller One" => "Poller One",
							"Poly" => "Poly",
							"Pompiere" => "Pompiere",
							"Pontano Sans" => "Pontano Sans",
							"Port Lligat Sans" => "Port Lligat Sans",
							"Port Lligat Slab" => "Port Lligat Slab",
							"Prata" => "Prata",
							"Preahvihear" => "Preahvihear",
							"Press Start 2P" => "Press Start 2P",
							"Princess Sofia" => "Princess Sofia",
							"Prociono" => "Prociono",
							"Prosto One" => "Prosto One",
							"Puritan" => "Puritan",
							"Purple Purse" => "Purple Purse",
							"Quando" => "Quando",
							"Quantico" => "Quantico",
							"Quattrocento" => "Quattrocento",
							"Quattrocento Sans" => "Quattrocento Sans",
							"Questrial" => "Questrial",
							"Quicksand" => "Quicksand",
							"Quintessential" => "Quintessential",
							"Qwigley" => "Qwigley",
							"Racing Sans One" => "Racing Sans One",
							"Radley" => "Radley",
							"Raleway" => "Raleway",
							"Raleway Dots" => "Raleway Dots",
							"Rambla" => "Rambla",
							"Rammetto One" => "Rammetto One",
							"Ranchers" => "Ranchers",
							"Rancho" => "Rancho",
							"Rationale" => "Rationale",
							"Redressed" => "Redressed",
							"Reenie Beanie" => "Reenie Beanie",
							"Revalia" => "Revalia",
							"Ribeye" => "Ribeye",
							"Ribeye Marrow" => "Ribeye Marrow",
							"Righteous" => "Righteous",
							"Risque" => "Risque",
							"Roboto" => "Roboto",
							"Roboto Slab" => "Roboto Slab",
							"Roboto Condensed" => "Roboto Condensed",
							"Rochester" => "Rochester",
							"Rock Salt" => "Rock Salt",
							"Rokkitt" => "Rokkitt",
							"Romanesco" => "Romanesco",
							"Ropa Sans" => "Ropa Sans",
							"Rosario" => "Rosario",
							"Rosarivo" => "Rosarivo",
							"Rouge Script" => "Rouge Script",
							"Ruda" => "Ruda",
							"Rufina" => "Rufina",
							"Ruge Boogie" => "Ruge Boogie",
							"Ruluko" => "Ruluko",
							"Rum Raisin" => "Rum Raisin",
							"Ruslan Display" => "Ruslan Display",
							"Russo One" => "Russo One",
							"Ruthie" => "Ruthie",
							"Rye" => "Rye",
							"Sacramento" => "Sacramento",
							"Sail" => "Sail",
							"Salsa" => "Salsa",
							"Sanchez" => "Sanchez",
							"Sancreek" => "Sancreek",
							"Sansita One" => "Sansita One",
							"Sarina" => "Sarina",
							"Satisfy" => "Satisfy",
							"Scada" => "Scada",
							"Schoolbell" => "Schoolbell",
							"Seaweed Script" => "Seaweed Script",
							"Sevillana" => "Sevillana",
							"Seymour One" => "Seymour One",
							"Shadows Into Light" => "Shadows Into Light",
							"Shadows Into Light Two" => "Shadows Into Light Two",
							"Shanti" => "Shanti",
							"Share" => "Share",
							"Share Tech" => "Share Tech",
							"Share Tech Mono" => "Share Tech Mono",
							"Shojumaru" => "Shojumaru",
							"Short Stack" => "Short Stack",
							"Siemreap" => "Siemreap",
							"Sigmar One" => "Sigmar One",
							"Signika" => "Signika",
							"Signika Negative" => "Signika Negative",
							"Simonetta" => "Simonetta",
							"Sintony" => "Sintony",
							"Sirin Stencil" => "Sirin Stencil",
							"Six Caps" => "Six Caps",
							"Skranji" => "Skranji",
							"Slackey" => "Slackey",
							"Smokum" => "Smokum",
							"Smythe" => "Smythe",
							"Sniglet" => "Sniglet",
							"Snippet" => "Snippet",
							"Snowburst One" => "Snowburst One",
							"Sofadi One" => "Sofadi One",
							"Sofia" => "Sofia",
							"Sonsie One" => "Sonsie One",
							"Sorts Mill Goudy" => "Sorts Mill Goudy",
							"Source Code Pro" => "Source Code Pro",
							"Source Sans Pro" => "Source Sans Pro",
							"Special Elite" => "Special Elite",
							"Spicy Rice" => "Spicy Rice",
							"Spinnaker" => "Spinnaker",
							"Spirax" => "Spirax",
							"Squada One" => "Squada One",
							"Stalemate" => "Stalemate",
							"Stalinist One" => "Stalinist One",
							"Stardos Stencil" => "Stardos Stencil",
							"Stint Ultra Condensed" => "Stint Ultra Condensed",
							"Stint Ultra Expanded" => "Stint Ultra Expanded",
							"Stoke" => "Stoke",
							"Strait" => "Strait",
							"Sue Ellen Francisco" => "Sue Ellen Francisco",
							"Sunshiney" => "Sunshiney",
							"Supermercado One" => "Supermercado One",
							"Suwannaphum" => "Suwannaphum",
							"Swanky and Moo Moo" => "Swanky and Moo Moo",
							"Syncopate" => "Syncopate",
							"Tangerine" => "Tangerine",
							"Taprom" => "Taprom",
							"Tauri" => "Tauri",
							"Telex" => "Telex",
							"Tenor Sans" => "Tenor Sans",
							"Text Me One" => "Text Me One",
							"The Girl Next Door" => "The Girl Next Door",
							"Tienne" => "Tienne",
							"Tinos" => "Tinos",
							"Titan One" => "Titan One",
							"Titillium Web" => "Titillium Web",
							"Trade Winds" => "Trade Winds",
							"Trocchi" => "Trocchi",
							"Trochut" => "Trochut",
							"Trykker" => "Trykker",
							"Tulpen One" => "Tulpen One",
							"Ubuntu" => "Ubuntu",
							"Ubuntu Condensed" => "Ubuntu Condensed",
							"Ubuntu Mono" => "Ubuntu Mono",
							"Ultra" => "Ultra",
							"Uncial Antiqua" => "Uncial Antiqua",
							"Underdog" => "Underdog",
							"Unica One" => "Unica One",
							"UnifrakturCook" => "UnifrakturCook",
							"UnifrakturMaguntia" => "UnifrakturMaguntia",
							"Unkempt" => "Unkempt",
							"Unlock" => "Unlock",
							"Unna" => "Unna",
							"VT323" => "VT323",
							"Vampiro One" => "Vampiro One",
							"Varela" => "Varela",
							"Varela Round" => "Varela Round",
							"Vast Shadow" => "Vast Shadow",
							"Vibur" => "Vibur",
							"Vidaloka" => "Vidaloka",
							"Viga" => "Viga",
							"Voces" => "Voces",
							"Volkhov" => "Volkhov",
							"Vollkorn" => "Vollkorn",
							"Voltaire" => "Voltaire",
							"Waiting for the Sunrise" => "Waiting for the Sunrise",
							"Wallpoet" => "Wallpoet",
							"Walter Turncoat" => "Walter Turncoat",
							"Warnes" => "Warnes",
							"Wellfleet" => "Wellfleet",
							"Wendy One" => "Wendy One",
							"Wire One" => "Wire One",
							"Yanone Kaffeesatz" => "Yanone Kaffeesatz",
							"Yellowtail" => "Yellowtail",
							"Yeseva One" => "Yeseva One",
							"Yesteryear" => "Yesteryear",
							"Zeyada" => "Zeyada",
							);
	return $font_family;
}
function business_a_font_style(){
	$font_style = array('normal'=>'Normal','italic'=>'Italic');
	return $font_style;
}

/**
 * Check if a string is in json format
 *
 * @param  string $string Input.
 *
 * @return bool
 */
function Business_a_is_json( $string ) {
	return is_string( $string ) && is_array( json_decode( $string, true ) ) ? true : false;
}

/**
 * Businesss a team contents
 */
function businessa_team_content( $businessa_team_content, $is_callback = false ) {

    if ( ! empty( $businessa_team_content ) ) :
        $businessa_team_content = json_decode( $businessa_team_content );

        if ( ! empty( $businessa_team_content ) ) {

            $i = 1;
            echo '<div class="row">';
            foreach ( $businessa_team_content as $team_item ) :
                $image = ! empty( $team_item->image_url ) ? apply_filters( 'businessa_translate_single_string', $team_item->image_url, 'Team section' ) : '';
                $title = ! empty( $team_item->title ) ? apply_filters( 'businessa_translate_single_string', $team_item->title, 'Team section' ) : '';
                $subtitle = ! empty( $team_item->subtitle ) ? apply_filters( 'businessa_translate_single_string', $team_item->subtitle, 'Team section' ) : '';
                $text = ! empty( $team_item->text ) ? apply_filters( 'businessa_translate_single_string', $team_item->text, 'Team section' ) : '';
                $link = ! empty( $team_item->link ) ? apply_filters( 'businessa_translate_single_string', $team_item->link, 'Team section' ) : '';
                ?>
                <div class="col-md-4 col-sm-6">
                    <div class="rdn-team-area">
                        <div class="team-thumbnail">
                            <?php if ( ! empty( $image ) ) : ?>
                                <?php
                                if ( ! empty( $link ) ) :
                                    $link_html = '<a href="' . esc_url( $link ) . '"';
                                    if ( function_exists( 'businessa_is_external_url' ) ) {
                                        $link_html .= businessa_is_external_url( $link );
                                    }
                                    $link_html .= '>';
                                    echo wp_kses_post( $link_html );
                                endif;
                                ?>
                                <img class="img"
                                     src="<?php echo esc_url( $image ); ?>"
                                    <?php
                                    if ( ! empty( $title ) ) :
                                        ?>
                                        alt="<?php echo esc_attr( $title ); ?>" title="<?php echo esc_attr( $title ); ?>" <?php endif; ?> />
                                <?php if ( ! empty( $link ) ) : ?>
                                    </a>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>

                        <div class="team-body">
                            <?php if ( ! empty( $title ) ) : ?>
                                <a class="team-title" href="<?php echo esc_url( $link ); ?>"><h3><?php echo esc_html( $title ); ?></h3></a>
                            <?php endif; ?>

                             <?php if ( ! empty( $subtitle ) ) : ?>
                            <h4 class="team-degignation"><?php echo esc_html( $subtitle ); ?></h4>
                             <?php endif; ?>

                            <div class="entry-content text-center">

                                 <?php if ( ! empty( $text ) ) : ?>
                                <p><?php echo wp_kses_post( html_entity_decode( $text ) ); ?></p>
                                 <?php endif; ?>

                                <?php if ( ! empty( $link ) ) : ?>
                                <p class="team-more">
                                    <a class="team-more-link" href="<?php echo esc_url( $link ); ?>"><?php _e('Read More','business-a') ?></a>
                                </p>
                                <?php endif; ?>

                            </div>

                        </div>
                    </div>
                </div>
                <?php
                if ( $i % 3 == 0 ) {
                    echo '</div><!-- /.row -->';
                    echo '<div class="row">';
                }
                $i++;
            endforeach;
            echo '</div>';

        }// End if().
    endif;
}

function businessa_get_team_default() {
    return apply_filters(
        'businessa_team_default_content', json_encode(
            array(
                array(
                    'image_url'       => get_template_directory_uri() . '/images/team.jpg',
                    'title'           => esc_html__( 'Madison', 'business-a' ),
                    'subtitle'        => esc_html__( 'Founder', 'business-a' ),
                    'text'            => esc_html__( 'Lorem Ipsum has been the industry`s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'business-a' ),
                    'id'              => 'customizer_repeater_56d7ea7f40c56',
                    'social_repeater' => json_encode(
                        array(
                            array(
                                'id'   => 'customizer-repeater-social-repeater-57fb908674e06',
                                'link' => 'facebook.com',
                                'icon' => 'fa-facebook',
                            ),
                            array(
                                'id'   => 'customizer-repeater-social-repeater-57fb9148530ft',
                                'link' => 'plus.google.com',
                                'icon' => 'fa-google-plus',
                            ),
                            array(
                                'id'   => 'customizer-repeater-social-repeater-57fb9148530fc',
                                'link' => 'twitter.com',
                                'icon' => 'fa-twitter',
                            ),
                            array(
                                'id'   => 'customizer-repeater-social-repeater-57fb9150e1e89',
                                'link' => 'linkedin.com',
                                'icon' => 'fa-linkedin',
                            ),
                        )
                    ),
                ),
                array(
                    'image_url'       => get_template_directory_uri() . '/images/team.jpg',
                    'title'           => esc_html__( 'Liam', 'business-a' ),
                    'subtitle'        => esc_html__( 'Founder', 'business-a' ),
                    'text'            => esc_html__( 'Lorem Ipsum has been the industry`s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'business-a' ),
                    'id'              => 'customizer_repeater_56d7ea7f40c66',
                    'social_repeater' => json_encode(
                        array(
                            array(
                                'id'   => 'customizer-repeater-social-repeater-57fb9155a1072',
                                'link' => 'facebook.com',
                                'icon' => 'fa-facebook',
                            ),
                            array(
                                'id'   => 'customizer-repeater-social-repeater-57fb9160ab683',
                                'link' => 'twitter.com',
                                'icon' => 'fa-twitter',
                            ),
                            array(
                                'id'   => 'customizer-repeater-social-repeater-57fb9160ab484',
                                'link' => 'pinterest.com',
                                'icon' => 'fa-pinterest',
                            ),
                            array(
                                'id'   => 'customizer-repeater-social-repeater-57fb916ddffc9',
                                'link' => 'linkedin.com',
                                'icon' => 'fa-linkedin',
                            ),
                        )
                    ),
                ),
                array(
                    'image_url'       => get_template_directory_uri() . '/images/team.jpg',
                    'title'           => esc_html__( 'Emma', 'business-a' ),
                    'subtitle'        => esc_html__( 'Founder', 'business-a' ),
                    'text'            => esc_html__( 'Lorem Ipsum has been the industry`s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'business-a' ),
                    'id'              => 'customizer_repeater_56d7ea7f40c76',
                    'social_repeater' => json_encode(
                        array(
                            array(
                                'id'   => 'customizer-repeater-social-repeater-57fb917e4c69e',
                                'link' => 'facebook.com',
                                'icon' => 'fa-facebook',
                            ),
                            array(
                                'id'   => 'customizer-repeater-social-repeater-57fb91830825c',
                                'link' => 'twitter.com',
                                'icon' => 'fa-twitter',
                            ),
                            array(
                                'id'   => 'customizer-repeater-social-repeater-57fb918d65f2e',
                                'link' => 'linkedin.com',
                                'icon' => 'fa-linkedin',
                            ),
                            array(
                                'id'   => 'customizer-repeater-social-repeater-57fb918d65f2x',
                                'link' => 'dribbble.com',
                                'icon' => 'fa-dribbble',
                            ),
                        )
                    ),
                ),

            )
        )
    );
}

/**
 * Businesss a testimonial contents
 */
function businessa_testimonial_content( $businessa_testimonial_content, $is_callback = false ) {

    if ( ! empty( $businessa_testimonial_content ) ) :
        $businessa_testimonial_content = json_decode( $businessa_testimonial_content );

        if ( ! empty( $businessa_testimonial_content ) ) {

            $i = 1;
            echo '<div class="row">';
            foreach ( $businessa_testimonial_content as $item ) :
                $image = ! empty( $item->image_url ) ? apply_filters( 'businessa_translate_single_string', $item->image_url, 'Testimonial section' ) : '';
                $title = ! empty( $item->title ) ? apply_filters( 'businessa_translate_single_string', $item->title, 'Testimonial section' ) : '';
                $subtitle = ! empty( $item->subtitle ) ? apply_filters( 'businessa_translate_single_string', $item->subtitle, 'Testimonial section' ) : '';
                $text = ! empty( $item->text ) ? apply_filters( 'businessa_translate_single_string', $item->text, 'Testimonial section' ) : '';
                $link = ! empty( $item->link ) ? apply_filters( 'businessa_translate_single_string', $item->link, 'Testimonial section' ) : '';
                ?>
                <div class="col-md-4 col-sm-6">
                    <div class="rdn-testimonial-area">

                        <div class="rdn-testimonial-image text-center">
                            <?php if ( ! empty( $image ) ) : ?>
                                <?php
                                if ( ! empty( $link ) ) :
                                    $link_html = '<a href="' . esc_url( $link ) . '"';
                                    if ( function_exists( 'businessa_is_external_url' ) ) {
                                        $link_html .= businessa_is_external_url( $link );
                                    }
                                    $link_html .= '>';
                                    echo wp_kses_post( $link_html );
                                endif;
                                ?>
                                <img
                                     src="<?php echo esc_url( $image ); ?>"
                                    <?php
                                    if ( ! empty( $title ) ) :
                                        ?>
                                        alt="<?php echo esc_attr( $title ); ?>" title="<?php echo esc_attr( $title ); ?>" <?php endif; ?> />
                                <?php if ( ! empty( $link ) ) : ?>
                                    </a>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>

                        <div class="testimonial-content">
                            <p>
                                <span class="testimonial-title"><?php echo $title; ?> ( <?php echo $subtitle; ?> ) — </span>
                                <?php echo $text; ?>

                                <?php if( !empty($link) ){ ?>
                                <a class="testimonial-more" target="_blank" href="<?php echo esc_url( $link ); ?>"><?php _e('Read More','business-a'); ?></a>
                                <?php } ?>
                            </p>
                        </div>


                    </div>
                </div>
                <?php
                if ( $i % 3 == 0 ) {
                    echo '</div><!-- /.row -->';
                    echo '<div class="row">';
                }
                $i++;
            endforeach;
            echo '</div>';

        }// End if().
    endif;
}
function businessa_get_testimonial_default() {
    return apply_filters(
        'businessa_testimonial_default_content', json_encode(
            array(
                array(
                    'image_url'       => get_template_directory_uri() . '/images/team.jpg',
                    'title'           => esc_html__( 'Jackson', 'business-a' ),
                    'subtitle'        => esc_html__( 'Designer', 'business-a' ),
                    'text'            => esc_html__( 'Lorem Ipsum has been the industry`s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'business-a' ),
                    'id'              => 'customizer_repeater_56d7ea7f40c56',
                    'social_repeater' => json_encode(
                        array(
                            array(
                                'id'   => 'customizer-repeater-social-repeater-57fb908674e06',
                                'link' => 'facebook.com',
                                'icon' => 'fa-facebook',
                            ),
                            array(
                                'id'   => 'customizer-repeater-social-repeater-57fb9148530ft',
                                'link' => 'plus.google.com',
                                'icon' => 'fa-google-plus',
                            ),
                            array(
                                'id'   => 'customizer-repeater-social-repeater-57fb9148530fc',
                                'link' => 'twitter.com',
                                'icon' => 'fa-twitter',
                            ),
                            array(
                                'id'   => 'customizer-repeater-social-repeater-57fb9150e1e89',
                                'link' => 'linkedin.com',
                                'icon' => 'fa-linkedin',
                            ),
                        )
                    ),
                ),
                array(
                    'image_url'       => get_template_directory_uri() . '/images/team.jpg',
                    'title'           => esc_html__( 'Addison', 'business-a' ),
                    'subtitle'        => esc_html__( 'Developer', 'business-a' ),
                    'text'            => esc_html__( 'Lorem Ipsum has been the industry`s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'business-a' ),
                    'id'              => 'customizer_repeater_56d7ea7f40c66',
                    'social_repeater' => json_encode(
                        array(
                            array(
                                'id'   => 'customizer-repeater-social-repeater-57fb9155a1072',
                                'link' => 'facebook.com',
                                'icon' => 'fa-facebook',
                            ),
                            array(
                                'id'   => 'customizer-repeater-social-repeater-57fb9160ab683',
                                'link' => 'twitter.com',
                                'icon' => 'fa-twitter',
                            ),
                            array(
                                'id'   => 'customizer-repeater-social-repeater-57fb9160ab484',
                                'link' => 'pinterest.com',
                                'icon' => 'fa-pinterest',
                            ),
                            array(
                                'id'   => 'customizer-repeater-social-repeater-57fb916ddffc9',
                                'link' => 'linkedin.com',
                                'icon' => 'fa-linkedin',
                            ),
                        )
                    ),
                ),
                array(
                    'image_url'       => get_template_directory_uri() . '/images/team.jpg',
                    'title'           => esc_html__( 'John', 'business-a' ),
                    'subtitle'        => esc_html__( 'CEO', 'business-a' ),
                    'text'            => esc_html__( 'Lorem Ipsum has been the industry`s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'business-a' ),
                    'id'              => 'customizer_repeater_56d7ea7f40c76',
                    'social_repeater' => json_encode(
                        array(
                            array(
                                'id'   => 'customizer-repeater-social-repeater-57fb917e4c69e',
                                'link' => 'facebook.com',
                                'icon' => 'fa-facebook',
                            ),
                            array(
                                'id'   => 'customizer-repeater-social-repeater-57fb91830825c',
                                'link' => 'twitter.com',
                                'icon' => 'fa-twitter',
                            ),
                            array(
                                'id'   => 'customizer-repeater-social-repeater-57fb918d65f2e',
                                'link' => 'linkedin.com',
                                'icon' => 'fa-linkedin',
                            ),
                            array(
                                'id'   => 'customizer-repeater-social-repeater-57fb918d65f2x',
                                'link' => 'dribbble.com',
                                'icon' => 'fa-dribbble',
                            ),
                        )
                    ),
                ),

            )
        )
    );
}


/**
 * Businesss a service contents
 */
function businessa_service_content( $businessa_service_content, $is_callback = false ) {

    if ( ! empty( $businessa_service_content ) ) :
        $businessa_service_content = json_decode( $businessa_service_content );

        if ( ! empty( $businessa_service_content ) ) {

            $i = 1;
            echo '<div class="row">';
            foreach ( $businessa_service_content as $features_item ) :
                $icon = ! empty( $features_item->icon_value ) ? apply_filters( 'businessa_translate_single_string', $features_item->icon_value, 'Service section' ) : '';
                $image = ! empty( $features_item->image_url ) ? apply_filters( 'businessa_translate_single_string', $features_item->image_url, 'Service section' ) : '';
                $title = ! empty( $features_item->title ) ? apply_filters( 'businessa_translate_single_string', $features_item->title, 'Service section' ) : '';
                $text = ! empty( $features_item->text ) ? apply_filters( 'businessa_translate_single_string', $features_item->text, 'Service section' ) : '';
                $link = ! empty( $features_item->link ) ? apply_filters( 'businessa_translate_single_string', $features_item->link, 'Service section' ) : '';
                $color = ! empty( $features_item->color ) ? $features_item->color : '';
                $choice = ! empty( $features_item->choice ) ? $features_item->choice : 'customizer_repeater_icon';
                ?>
                <div class="col-md-4 col-sm-6">
                    <div class="rdn-service-area">

                        <?php if( !empty( $icon ) ){ ?>
                        <div class="rdn-service-icon-area">
                            <a class="rdn-service-icon" href="<?php echo esc_url( $link ); ?>"><i class="fa <?php echo esc_html(  $icon ); ?>"></i></a>
                        </div>
                        <?php } ?>

                        <h3 class="rdn-service-title">
                            <a href="<?php echo esc_url( $link ); ?>">
                                <?php echo esc_html( $title ); ?>	</a>
                        </h3>

                         <?php if ( ! empty( $text ) ) { ?>
                        <p><?php echo wp_kses_post( html_entity_decode( $text ) ); ?></p>
                        <?php } ?>

                        <?php if( !empty( $link ) ){ ?>
                        <a class="rdn-service-btn" href="<?php echo esc_url( $link ); ?>"><?php _e('Read More','business-a') ?></a>
                        <?php } ?>
                </div>
                </div>
                <?php
                if ( $i % 3 == 0 ) {
                    echo '</div><!-- /.row -->';
                    echo '<div class="row">';
                }
                $i++;
            endforeach;
            echo '</div>';

        }// End if().
    endif;
}
function businessa_get_service_default() {
    return apply_filters(
        'businessa_service_default_content', json_encode(
            array(
                array(
                    'icon_value' => 'fa-desktop',
                    'title'      => esc_html__( 'Responsive', 'business-a' ),
                    'text'       => esc_html__( 'Lorem Ipsum has been the industry`s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'business-a' ),
                    'link'       => '#',
                    'color'      => '#e91e63',
                ),
                array(
                    'icon_value' => 'fa-cog',
                    'title'      => esc_html__( 'Woo-commerce', 'business-a' ),
                    'text'       => esc_html__( 'Lorem Ipsum has been the industry`s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'business-a' ),
                    'link'       => '#',
                    'color'      => '#00bcd4',
                ),
                array(
                    'icon_value' => 'fa-paper-plane-o',
                    'title'      => esc_html__( 'Easy Customizable', 'business-a' ),
                    'text'       => esc_html__( 'Lorem Ipsum has been the industry`s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'business-a' ),
                    'link'       => '#',
                    'color'      => '#4caf50',
                ),
            )
        )
    );
}