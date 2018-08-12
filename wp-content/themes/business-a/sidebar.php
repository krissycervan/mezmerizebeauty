<?php 
/**
 * This template for displaying sidebar
 *
 * @package WordPress
 * @subpackage business-a
 * @since Business-A 1.1
 */
?>

<?php if( is_active_sidebar('sidebar-primary') ): ?>
<div class="col-md-4">
	<?php dynamic_sidebar('sidebar-primary'); ?>
</div>
<?php endif; ?>