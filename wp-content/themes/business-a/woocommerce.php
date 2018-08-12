<?php 
/**
 * This template for woocommerce page detail page
 *
 * @package WordPress
 * @subpackage business-a
 * @since Business-A 1.1
 */
get_header();
business_a_breadcrumbs();
?>
	<section class="rdn-main-content">
		<div class="container">
			<div class="row">
				
				<div class="col-md-8">
				
				<?php woocommerce_content(); ?>
				
				</div>
				
				<?php get_sidebar('woocommerce'); ?>
				
			</div>
		</div>
	</section><!-- .rdn-main-content -->
<?php get_footer(); ?>