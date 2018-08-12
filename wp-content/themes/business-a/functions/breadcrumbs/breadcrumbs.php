<?php
if( !function_exists('business_a_breadcrumbs') ):
	function business_a_breadcrumbs() { 
			
		global $post;
		$homeLink = esc_url( home_url() );
	?>
	<section class="rdn-sub-header" style="background: url(<?php header_image(); ?>) fixed center no-repeat #f6f6f6;">
	<div class="rdn-sub-header-inner">
		<ul>
			<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php _e('Home','business-a' ); ?></a></li>
			<?php 
			
			if (is_home() || is_front_page()) :
			
				echo '<li>'. esc_attr( get_bloginfo( 'name' ) ).'</li>';
				
			else:
				
				// Blog Category
				if ( is_category() ) { 
					the_archive_title( '<li>', '</li>' ); 
				// Blog Day
				} else if ( is_day() ) {
					echo '<li>'. esc_attr( get_the_time('Y') ) .'';
					echo '<li>'. esc_attr( get_the_time('F') ) .'';
					echo '<li>'. esc_attr( get_the_time('d') ) .'</li>';

				// Blog Month
				} else if ( is_month() ) {
					echo '<li>' . esc_attr( get_the_time('Y') ) . '';
					echo '<li>'. esc_attr( get_the_time('F') ) .'</li>';

				// Blog Year
				} else if ( is_year() ) {
					echo '<li>'. esc_attr( get_the_time('Y') ) .'</li>';

				// Single Post
				} 
				else if( is_archive() ){
					the_archive_title( '<li>', '</li>' );
				}
				else if ( is_single() && !is_attachment() ) {
										
					if( get_post_type() == 'post' ){
						$cat = get_the_category();
						$cat = $cat[0];
						if($cat){
							echo '<li>';
							echo get_category_parents( $cat , TRUE, '');
							echo '</li>';
							the_title('<li>','</li>');
						}
					}
				}  
				else if ( is_page() && $post->post_parent ) {
					$parent_id  = $post->post_parent;
					$breadcrumbs = array();
					while ($parent_id) {
						$page = get_page($parent_id);
						$breadcrumbs[] = '<li>' . esc_attr( get_the_title($page->ID) ) . '';
						$parent_id  = $page->post_parent;
					}
					$breadcrumbs = array_reverse($breadcrumbs);
					foreach ($breadcrumbs as $crumb) echo $crumb;
					
					the_title('<li>','</li>');
				}
				elseif( is_search() ){
					echo '<li>'. esc_attr( get_search_query() ) .'</li>';
				}
				elseif( is_404() ){
					echo '<li>' . __('404 Error','business-a' ) . '</li>';
				}
				else { 
					the_title('<li>','</li>'); 
				}
			endif; 
			?>
		</ul>
	</div>
	</section><!-- .rdn-sub-header -->
	<?php }
endif
?>