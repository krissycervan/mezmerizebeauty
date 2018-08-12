<?php 
/**
 * This is main template file
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
				<?php 
				if( have_posts() ):
					while( have_posts() ): the_post();
						get_template_part('content','');
					endwhile;
				else:
					get_template_part('content','none');
				endif;
									
				// Previous/next page navigation.
				the_posts_pagination( array(
				'prev_text'          => __('<<','business-a' ),
				'next_text'          => __('>>','business-a' ),
				'type'               => 'list'
				) );
				?>
				</div>
				
				<?php get_sidebar(); ?>
				
			</div>
		</div>
	</section><!-- .rdn-main-content -->
<?php get_footer(); ?>