<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Dara
 */

?>

	</div>

	<?php get_sidebar( 'footer' ); ?>

	<?php if( function_exists('slbd_display_widgets') ) { echo slbd_display_widgets(); } ?>



<?php wp_footer(); ?>

</body>
</html>
