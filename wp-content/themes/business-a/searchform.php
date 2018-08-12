<?php
/**
 * Template for displaying search forms
 *
 * @subpackage business-a
 * @since Business-A 1.1
 * @since 1.1
 */
?>
<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label>
		<span class="screen-reader-text"><?php echo _x( 'Search for:', 'label', 'business-a' ); ?></span>
		<input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Search &hellip;', 'placeholder', 'business-a' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
		<button type="submit" class="search-submit"><?php echo _e( 'Search', 'business-a' ); ?></button>
	</label>
</form>
