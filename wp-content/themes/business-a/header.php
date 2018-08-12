<?php 
/**
 * The template for displaying the header
 *
 * @package business-a
 * @subpackage business-a
 * @since Business-A 1.1
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php echo esc_attr( bloginfo( 'charset' ) ); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
	<link rel="pingback" href="<?php esc_url( bloginfo( 'pingback_url' ) ); ?>">
	<?php endif; ?>
<?php wp_head(); ?>	
<head>
<body id="home" <?php body_class(); ?>>
<?php 
$business_obj = new business_a_settings_array();
$option = wp_parse_args(  get_option( 'business_option', array() ), $business_obj->default_data() ); ?>
<div id="rdn-wrapper">
	
	<?php if( $option['top-header-hide'] != true ) : ?>
	<section id="rdn-top-header">
		<div class="container">
			<div class="row">
				<div class="col-md-6 col-sm-6">
					<ul class="rdn-header-contact">
						<?php if( $option['header-left-text1'] !='' ){ ?>
						<li><a href="<?php echo esc_url( $option['header-left-text1'] ); ?>"><i class="fa fa-phone-square "></i><?php echo esc_attr( $option['header-left-text1'] ); ?></a></li>
						<?php } ?>
						<?php if( $option['header-left-text2'] !='' ){ ?>
						<li><a href="<?php echo esc_url( $option['header-left-text2'] ); ?>"><i class="fa fa-envelope"></i><?php echo esc_attr( $option['header-left-text2'] ); ?></a></li>
						<?php } ?>
					</ul>
				</div>
				<div class="col-md-6 col-sm-6">
					<ul class="rdn-header-social">
						
						<?php if( $option['header-facebook-url'] != '' ): ?>
						<li><a href="<?php echo esc_url( $option['header-facebook-url'] ); ?>" <?php if( $option['header-social-target']==true ){ echo 'target="_blank"'; } ?> data-toggle="tooltip" title="Facebook" data-placement="bottom"><i class="fa fa-facebook"></i></a></li>
						<?php endif; ?>
						
						<?php if( $option['header-twitter-url'] != '' ): ?>
						<li><a href="<?php echo esc_url( $option['header-twitter-url'] ); ?>" <?php if( $option['header-social-target']==true ){ echo 'target="_blank"'; } ?> data-toggle="tooltip" title="Twitter" data-placement="bottom"><i class="fa fa-twitter"></i></a></li>
						<?php endif; ?>						
						
						<?php if( $option['header-linkedin-url'] != '' ): ?>
						<li><a href="<?php echo esc_url( $option['header-linkedin-url'] ); ?>" <?php if( $option['header-social-target']==true ){ echo 'target="_blank"'; } ?> data-toggle="tooltip" title="Linked In" data-placement="bottom"><i class="fa fa-linkedin"></i></a></li>
						<?php endif; ?>
						
						<?php if( $option['header-googleplus-url'] != '' ): ?>
						<li><a href="<?php echo esc_url( $option['header-googleplus-url'] ); ?>" <?php if( $option['header-social-target']==true ){ echo 'target="_blank"'; } ?> data-toggle="tooltip" title="Google Plus" data-placement="bottom"><i class="fa fa-google-plus"></i></a></li>
						<?php endif; ?>					
					</ul>
				</div>
			</div>
		</div>
	</section><!-- #header -->
	<?php endif; ?>
	
	<section id="rdn-menu">
		<nav class="navbar navbar-default">
			<div class="container">
				<div class="row">
					<div class="col-md-4 col-sm-4 site-branding">
						
						<?php 
						if ( has_custom_logo() ) {
							business_a_the_custom_logo();
						}else{ ?>
						
						<?php if ( is_front_page() && is_home() ) : ?>
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><h3 class="site-title"><?php echo esc_attr( bloginfo( 'name' ) ); ?></h3></a>
						<?php else : ?>
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><h3 class="site-title"><?php echo esc_attr( bloginfo( 'name' ) ); ?></h3></a>
						<?php endif; ?>
						<?php } ?>
					
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse-1">
							<span class="sr-only"><?php _e('Toggle navigation','business-a' ); ?></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						
					</div>
					<div class="col-md-8 col-sm-8 navbar_area">

							<div class="collapse navbar-collapse" id="navbar-collapse-1">
								<?php 
									wp_nav_menu( array(
									'theme_location' => 'primary',
									'menu_class' => 'nav navbar-nav pull-right',
									'fallback_cb' => 'Business_A_bootstrap_navwalker::fallback',
									'walker' => new Business_A_bootstrap_navwalker() ) 
									); 
								?>
							</div><!-- #navbar-collapse-1 -->

					</div>
				</div>
			</div>
		</nav>
	</section><!-- #rdn-menu -->