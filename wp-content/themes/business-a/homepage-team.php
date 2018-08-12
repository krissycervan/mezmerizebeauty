<?php
$business_obj = new business_a_settings_array();
$option = wp_parse_args(  get_option( 'business_option', array() ), $business_obj->default_data() );

$default_content = false;
$default_content = businessa_get_team_default();
$businessa_team_content  = get_theme_mod( 'team_section_contents', $default_content );
?>
<?php if($option['team_section_enable']==true): ?>
	<section id="team" style="background:url('<?php echo $option['team_section_image']; ?>') fixed center <?php echo $option['team_section_image_repeat']; ?> <?php echo $option['team_section_backgorund_color']; ?>;">
		<div class="overlay <?php if( $option['team_section_image'] != '' ){ echo 'dark'; } ?>">
			<div class="container">
				<div class="row">
					<?php if($option['team_section_title']!=''): ?>
					<h2 class="section-title wow animated fadeInUp"><?php echo $option['team_section_title']; ?></h2>
					<?php endif; ?>
					<?php if($option['team_section_description']!=''): ?>
					<p class="section-desc wow animated fadeInUp"><?php echo $option['team_section_description']; ?></p>
					<?php endif; ?>
				</div>

                <?php businessa_team_content( $businessa_team_content );  ?>

			</div>
		</div>
	</section><!-- #rdn-team -->
<?php endif; ?>