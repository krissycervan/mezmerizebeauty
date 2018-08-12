<?php 
$business_obj = new business_a_settings_array();
$option = wp_parse_args(  get_option( 'business_option', array() ), $business_obj->default_data() );

$args = array( 'post_type' => 'post' , 'cat'=> absint( $option['slider_cat'] ) );
$loop = new WP_Query($args);
?>
<?php if($option['slider_enable']==true): ?>
	<section id="rdn-slider">
		<div id="main_Carousel" class="carousel slide <?php if( $option['slider_animation_type']=='fade' ){ echo 'carousel-' . esc_attr( $option['slider_animation_type'] ); } ?>" data-ride="carousel" data-interval="<?php echo esc_attr( $option['slider_speed']); ?>">
		  
		  <?php if( $loop->have_posts() ): ?>
		  <?php if( $loop->post_count > 1 ): ?>
		  <ol class="carousel-indicators">
			  <?php 
			  $s = 0;
			  while( $loop->have_posts() ) : $loop->the_post();
			  
				if( has_post_thumbnail() ):
				
			  ?>
				<li data-target="#main_Carousel" data-slide-to="<?php echo $s; ?>" class="<?php if($s==0){ echo 'active'; } $s++; ?>"></li>
			  <?php 
				endif;
				
			  endwhile; ?>
		  </ol>
		  <?php endif; ?>
		  <?php endif; ?>
		
		  <div class="carousel-inner" role="listbox">
		  <?php 
		  $i = 0;
		  while( $loop->have_posts() ) : $loop->the_post();
		  
			if( has_post_thumbnail() ):
		  ?>
			<div class="item <?php if($i==0){ echo 'active'; } $i++; ?>">
					
					<?php the_post_thumbnail(); ?>
					
					<div class="carousel-caption">
					
						<?php 
						
						the_title('<h1 class="rdn-slider-title">','</h1>'); 
						
						the_content(__('See More','business-a'));
						
						?>
					</div>
			</div>
		  <?php 
			endif;
			
		  endwhile; ?>
		  </div>
		
		  <?php if( $loop->post_count > 1 ): ?>
		  <a class="left carousel-control" href="#main_Carousel" role="button" data-slide="prev">
			<span class="fa fa-angle-left" aria-hidden="true"></span>
			<span class="sr-only"><?php _e('Previous','business-a' ) ?></span>
		  </a>
		  <a class="right carousel-control" href="#main_Carousel" role="button" data-slide="next">
			<span class="fa fa-angle-right" aria-hidden="true"></span>
			<span class="sr-only"><?php _e('Next','business-a' ) ?></span>
		  </a>
		  <?php endif; ?>
		
		</div>
	</section><!-- #rdn-slider -->
<?php endif; ?>