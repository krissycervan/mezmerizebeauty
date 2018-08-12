<?php
$business_obj = new business_a_settings_array();
$option = wp_parse_args(  get_option( 'business_option', array() ), $business_obj->default_data() );
?>

<?php if($option['contact_section_enable']==true): ?>
	<section id="contact">
		<div class="container">
			
			<div class="row">
				<?php if($option['contact_section_title']!=''): ?>
				<h1 class="section-title wow animated fadeInUp"><?php echo esc_html( $option['contact_section_title'] ); ?></h1>
				<?php endif; ?>
				<?php if($option['contact_section_description']!=''): ?>
				<p class="section-desc wow animated fadeInUp"><?php echo esc_html( $option['contact_section_description'] ); ?></p>
				<?php endif; ?>
			</div>
			
			<div class="row">
				<div class="col-md-6 col-sm-6 col-md-offset-3 col-sm-offset-3" >
				
					<?php 
					if( ! defined( 'WPCF7_PLUGIN' ) ) {
						?>
						<p><?php _e('If you want to access contact form in this section. Please install','business-a'); ?> <a href="<?php echo esc_url('https://wordpress.org/plugins/contact-form-7/'); ?>" target="_blank"><?php _e('Contact Form 7','business-a'); ?></a> <?php _e('and navigate to Appearance >> Customizer >> FrontPage Sections >> Contact then paste contact form shortcode in Contact Form 7 Shortcode settings.','business-a'); ?></p>
						<?php
					}else{
						if( $option['contact_contactform_shortcode'] != '' ){
							// contact form 7 shortcode add form 
							echo do_shortcode( $option['contact_contactform_shortcode'] );
						}else{
							?>
							<p><?php _e('Add contact form shortcode in Contact Form 7 Shortcode settings. Appearance >> Customizer >> FrontPage Sections >> Contact','business-a'); ?></p>
							<?php
						}
					}
					?>
				</div>
			</div>

		</div>
	</section><!-- #rdn-contact -->
<?php endif; ?>