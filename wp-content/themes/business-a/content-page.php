<?php 
/*
 * Display page contents
 */
$business_obj = new business_a_settings_array();
$option = wp_parse_args(  get_option( 'business_option', array() ), $business_obj->default_data() );
?>
<article id="<?php the_ID(); ?>" <?php post_class('post'); ?>>
		
		<?php if($option['page_feature_image_enable']==true): ?>
		<?php if( has_post_thumbnail() ){ ?>
		<div class="rdn-featured-image">
			<?php the_post_thumbnail(); ?>
		</div>
		<?php } ?>
		<?php endif; ?>
		
		<header class="entry-header">
		<?php 	
			the_title('<h2 class="entry-title">', '</h2>' );
		?>
		</header>
		
		<?php if($option['page_meta_enable']==true): ?>
		<div class="entry-meta">
			<span class="author"><a href="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' ) ));?>"><?php _e('Posted by: ','business-a' ); echo get_the_author_link();?></a></span>
			<span class="entry-date">
				<a href="<?php echo esc_url(get_month_link(get_post_time('Y'),get_post_time('m'))); ?>">
					<?php _e('Posted on: ','business-a' ); echo esc_attr( get_the_date( get_option('date_format') ) ); ?>
				</a>
			</span>
			<?php the_tags( '<span class="tag-links">', ' , ', '</span>' ); ?>
		</div>
		<?php endif; ?>
		
		<div class="entry-content">
			<?php 
			the_content(); 
			
			wp_link_pages( array(
				'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'business-a' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
				'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'business-a' ) . ' </span>%',
				'separator'   => '<span class="screen-reader-text">, </span>',
			) );
			
			?>
		</div>
		
</article>