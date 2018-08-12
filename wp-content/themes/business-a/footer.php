<?php 
/**
 * The template for displaying the footer
 *
 * @package WordPress
 * @subpackage business-a
 * @since Business-A 1.1
 */
?>
<?php 
$business_obj = new business_a_settings_array();
$option = wp_parse_args(  get_option( 'business_option', array() ), $business_obj->default_data() ); ?>

	<section id="rdn-footer">
		
		<?php if( is_active_sidebar('footer-1') || is_active_sidebar('footer-2') || is_active_sidebar('footer-3')): ?>
		<div class="rdn-footer-top">
			<div class="container">
				<div class="row">
					<div class="col-md-3 col-sm-6">
						<?php 
						if(is_active_sidebar('footer-1')):
							dynamic_sidebar('footer-1');
						endif;
						?>
					</div>
					<div class="col-md-3 col-sm-6">
						<?php 
						if(is_active_sidebar('footer-2')):
							dynamic_sidebar('footer-2');
						endif;
						?>
					</div>
					<div class="col-md-3 col-sm-6">
						<?php 
						if(is_active_sidebar('footer-3')):
							dynamic_sidebar('footer-3');
						endif;
						?>
					</div>
					<div class="col-md-3 col-sm-6">
						<?php 
						if(is_active_sidebar('footer-4')):
							dynamic_sidebar('footer-4');
						endif;
						?>
					</div>
				</div>
				
				<?php if( $option['footer_socialicon_enable'] == true ): ?>
				<div class="rdn-footer-social">
					
					<?php if( $option['footer_socialicon_title'] != '' ): ?>
					<h3 class="footer-social-title wow animated fadeInUp"><?php echo esc_attr( $option['footer_socialicon_title'] ); ?></h3>
					<?php endif; ?>
					
					<ul class="footer-social-icons">
						<li><a href="<?php echo esc_url( $option['header-facebook-url'] ); ?>" <?php if( $option['header-social-target']==true ){ echo 'target="_blank"'; } ?> data-toggle="tooltip" title="Facebook" data-placement="bottom"><i class="fa fa-facebook"></i></a></li>

						
						<li><a href="<?php echo esc_url( $option['header-twitter-url'] ); ?>" <?php if( $option['header-social-target']==true ){ echo 'target="_blank"'; } ?> data-toggle="tooltip" title="Twitter" data-placement="bottom"><i class="fa fa-twitter"></i></a></li>

						
						<li><a href="<?php echo esc_url( $option['header-linkedin-url'] ); ?>" <?php if( $option['header-social-target']==true ){ echo 'target="_blank"'; } ?> data-toggle="tooltip" title="Linked In" data-placement="bottom"><i class="fa fa-linkedin"></i></a></li>

						
						<li><a href="<?php echo esc_url( $option['header-googleplus-url'] ); ?>" <?php if( $option['header-social-target']==true ){ echo 'target="_blank"'; } ?> data-toggle="tooltip" title="Google Plus" data-placement="bottom"><i class="fa fa-google-plus"></i></a></li>
					</ul>
				</div>
				<?php endif; ?>
				
			</div><!-- .container -->
				
		</div><!-- .rdn-footer-top -->
		<?php endif; ?>
		
		<?php if( $option['footer_copyright'] != '' || $option['footer_menu']==true): ?>
		<div class="rdn-footer-bottom">
			<div class="container">
				<div class="row">
					<div class="col-md-6 col-sm-6">
						<div class="rdn-copyright">
							<?php if($option['footer_copyright'] != ''): ?>
							<p><?php echo esc_attr( $option['footer_copyright'] ); ?></p>
							<?php endif; ?>
						</div>
					</div>
					<div class="col-md-6 col-sm-6">
						<?php if($option['footer_menu']==true): ?>
						<ul class="rdn-footer-menu">
							<?php  
							wp_nav_menu( 
								array(  
									'theme_location' => 'footer',
									'menu_id'        =>'FooterMenu',
								    'fallback_cb'     => 'Business_A_bootstrap_navwalker::fallback',
									'walker'         => new Business_A_bootstrap_navwalker()
								)
							);
							?>
						</ul>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
		<?php endif; ?>
	</section><!-- #rdn-footer -->
	
</div>
 
<a href="#" class="rdn_page_scroll"><i class="fa fa-chevron-up"></i></a>
<?php wp_footer(); ?>
</body>
</html>