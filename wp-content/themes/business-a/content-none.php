<article class="no-results not-found post">
	
	<header class="entry-header">
		<h2 class="entry-title"><?php _e( 'Nothing Found', 'business-a' ); ?></h2>
	</header>
	
	<div class="entry-content">
		<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

			<p><?php printf( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'business-a' ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>

		<?php elseif ( is_search() ) : ?>

			<p><?php _e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'business-a' ); ?></p>
			<?php get_search_form(); ?>

		<?php else : ?>

			<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'business-a' ); ?></p>
			<?php get_search_form(); ?>

		<?php endif; ?>
	</div>
	
</article>