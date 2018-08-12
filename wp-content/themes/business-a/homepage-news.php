<?php
$business_obj = new business_a_settings_array();
$option = wp_parse_args(  get_option( 'business_option', array() ), $business_obj->default_data() ); 

$class = '';
if($option['news_section_image']!=''){
	$class = 'sectionoverlay';
}
?>

<?php if( $option['news_section_enable'] == true ) : ?>
	<section id="news" class="<?php echo esc_attr( $class ); ?>" style="background:url('<?php echo esc_url( $option['news_section_image'] ); ?>') fixed center <?php echo esc_attr( $option['news_section_image_repeat'] ); ?> <?php echo esc_attr( $option['news_section_backgorund_color'] ); ?>;">
		<div class="rdn-section-body">
			<div class="container">
			
				<div class="row">
					<?php if($option['news_section_title']!=''): ?>
					<h1 class="section-title wow animated fadeInUp"><?php echo esc_html( $option['news_section_title'] ); ?></h1>
					<?php endif; ?>
					<?php if($option['news_section_description']!=''): ?>
					<p class="section-desc wow animated fadeInUp"><?php echo esc_html( $option['news_section_description'] ); ?></p>
					<?php endif; ?>
				</div>
				
				<div class="row">
					<?php 
					$cat_id = $option['news_category_show'];
					$news_no_of_show = $option['news_no_of_show'];
					
					$args = array( 'post_type' => 'post','ignore_sticky_posts' => 1 , 'category__in' => absint( $cat_id ), 'posts_per_page' => absint( $news_no_of_show ) );
					$news_query = new WP_Query($args);
					$i=1;
					while($news_query->have_posts() ) : $news_query->the_post();
					?>
					<div class="col-md-4 col-sm-6">
						<div class="media rdn-home-news-area">
							
							<?php if( has_post_thumbnail() ): ?>
							<div class="media-left home-news-image">
								<a href="<?php the_permalink(); ?>">
									<?php the_post_thumbnail('full'); ?>
								</a>
							</div>
							<?php endif; ?>
							
							<div class="media-body home-news-body">
								<h3 class="news-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
								<span class="home-news-date"><?php echo esc_attr(  get_the_date( get_option('date_format') ) ); ?></span>
								<div class="home-news-content">
								<?php 
								$more = '... <p><a class="more-link" href="'. esc_url( get_the_permalink() ).'">Read More</a></p>';
								echo apply_filters( 'the_content', wp_trim_words( get_the_content(), 14, $more ) ); ?>
								</div>
							</div>
						</div>
					</div>
					<?php 
					if($i==3) { echo '<div class="clearfix"></div>'; $i=0; } $i++;
					endwhile;
					
					wp_reset_postdata();
					?>
				
			</div>
		</div>
	</section><!-- #rdn-home-news -->
<?php endif; ?>