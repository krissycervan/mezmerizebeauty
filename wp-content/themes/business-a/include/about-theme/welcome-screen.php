<?php
/*
 * Business welcome screen page
 */
function business_a_welcome_screen_admin_menu(){
	add_theme_page( __( 'About Business Theme', 'business-a' ), __( 'About Business Theme', 'business-a' ), 'activate_plugins', 'theme-welcome-page', 'business_a_welcome_screen_page' );
}
add_action( 'admin_menu', 'business_a_welcome_screen_admin_menu' );

function business_a_welcome_screen_page() {
	global $version;
	$abouttheme = wp_get_theme( get_template() );
	$businessversion = substr( $version, 0, 3 );
	?>
	
	<div class="wrap">
		<div class="business-theme-header text-center">
			<h1>
				<?php _e('Welcome To Our', 'business-a' ); ?>
				<?php echo $abouttheme->display( 'Name' ); ?>
				<?php _e('Theme', 'business-a' ); ?>
				<?php echo $businessversion; ?>
			</h1>
		</div>
	</div>
	
	<div class="wrap business-wrap">
		<div class="business-left-info">
			<div class="business-feaure-image">
				<img src="<?php echo esc_url( get_template_directory_uri() ) . '/screenshot.png'; ?>" />
			</div>
			<div class="business-content">
				<?php echo $abouttheme->display( 'Description' ); ?>	
			</div>
		</div>
		<div class="clear"></div>
	</div>
	
	<div class="wrap business-wrap">
		<hr style="margin:20px 0;">
		<h2><?php _e('Have a problem with our theme?','business-a' ) ?></h2>
		<p class="business-content"><?php _e('If you any problem regarding our About Theme. please contact us to click on Support button.','business-a' ) ?></p>
		<a target="_blank"  class="button button-primary" href="<?php echo esc_url('https://wordpress.org/support/theme/business-a'); ?>">
			<?php _e('Support','business-a' ); ?>
		</a>
		
		<hr style="margin:20px 0;">
		<h2><?php _e('If you Love it.','business-a' ) ?></h2>
		<p class="business-content"><?php _e('If you like our About Theme and support kindly share us your feedback to click on Feedback button.','business-a' ) ?></p>
		<a target="_blank"  class="button button-primary" href="<?php echo esc_url('https://wordpress.org/support/theme/business-a/reviews/'); ?>">
			<?php _e('Feedback','business-a' ); ?>
		</a>
	</div>
	
	<div class="wrap business-wrap text-center">
		<hr style="margin:20px 0;">
		<h2><?php _e('Compaire Our Free and Premium Theme Version','business-a' ) ?></h2>
		
		<table class="business-table">
			<tbody>
				<tr>
					<th> <?php _e('Features','business-a' ) ?> </th>
					<th> <?php _e('Free Theme','business-a' ) ?> </th>
					<th> <?php _e('Premium Theme','business-a' ) ?> </th>
				</tr>
				<tr>
					<td> <?php _e('Color Scheme','business-a' ) ?> </td>
					<td class="text-center"> <i class="cross_red"></i> </td>
					<td class="text-center"> <i class="yes_green"></i> </td>
				</tr>
				<tr>
					<td> <?php _e('Front Page','business-a' ) ?> </td>
					<td class="text-center"> <i class="cross_red"></i> </td>
					<td class="text-center"> <i class="yes_green"></i> </td>
				</tr>
				<tr>
					<td> <?php _e('About Template','business-a' ) ?> </td>
					<td class="text-center"> <i class="cross_red"></i> </td>
					<td class="text-center"> <i class="yes_green"></i> </td>
				</tr>
				<tr>
					<td> <?php _e('Contact Template','business-a' ) ?> </td>
					<td class="text-center"> <i class="cross_red"></i> </td>
					<td class="text-center"> <i class="yes_green"></i> </td>
				</tr>
				<tr>
					<td> <?php _e('Social Icons','business-a' ) ?> </td>
					<td class="text-center"> <i class="yes_green"></i> </td>
					<td class="text-center"> <i class="yes_green"></i> </td>
				</tr>
				<tr>
					<td> <?php _e('Blog Templates','business-a' ) ?> </td>
					<td class="text-center"> <?php _e('Defalut','business-a' ) ?> </td>
					<td class="text-center"> <?php _e('5 Templates','business-a' ) ?> </td>
				</tr>
				<tr>
					<td> <?php _e('Google Fonts','business-a' ) ?> </td>
					<td class="text-center"> <i class="yes_green"></i> </td>
					<td class="text-center"> <?php _e('500+ Fonts','business-a' ) ?> </td>
				</tr>
				<tr>
					<td> <?php _e('Responsive Design','business-a' ) ?> </td>
					<td class="text-center"> <i class="yes_green"></i> </td>
					<td class="text-center"> <i class="yes_green"></i> </td>
				</tr>
				<tr>
					<td> <?php _e('Gallery Template','business-a' ) ?> </td>
					<td class="text-center"> <i class="cross_red"></i> </td>
					<td class="text-center"> <i class="yes_green"></i> </td>
				</tr>
				<tr>
					<td> <?php _e('WooCommerce','business-a' ) ?> </td>
					<td class="text-center"> <i class="yes_green"></i> </td>
					<td class="text-center"> <i class="yes_green"></i> </td>
				</tr>
				<tr>
					<td> <?php _e('Parallax Template','business-a' ) ?> </td>
					<td class="text-center"> <i class="cross_red"></i> </td>
					<td class="text-center"> <i class="yes_green"></i> </td>
				</tr>
				<tr>
					<td> <?php _e('Google map','business-a' ) ?> </td>
					<td class="text-center"> <i class="cross_red"></i> </td>
					<td class="text-center"> <i class="yes_green"></i> </td>
				</tr>
				<tr>
					<td> <?php _e('Custom Widgets','business-a' ) ?> </td>
					<td class="text-center"> <?php _e('2','business-a' ) ?> </td>
					<td class="text-center"> <?php _e('3','business-a' ) ?> </td>
				</tr>
				<tr>
					<td> <?php _e('Custom Post Type','business-a' ) ?> </td>
					<td class="text-center"> <i class="cross_red"></i> </td>
					<td class="text-center"> <i class="yes_green"></i> </td>
				</tr>
				<tr>
					<td> <?php _e('Pricing Table','business-a' ) ?> </td>
					<td class="text-center"> <i class="cross_red"></i> </td>
					<td class="text-center"> <i class="yes_green"></i> </td>
				</tr>
		</tbody>
	</table>
		
	</div>
	
	<div class="wrap business-wrap text-center">
		<hr style="margin:20px 0;">
		<h2><?php _e('Get More Features of About Theme','business-a' ) ?></h2>
		
		<a class="business-button red" target="_blank" href="<?php echo esc_url('https://webdzier.com/themes/business-a/'); ?>"><span><?php _e('Upgrade To Pro','business-a' ) ?></span></a>
	</div>
	<?php
}