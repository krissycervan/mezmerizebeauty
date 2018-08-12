<?php 
    include_once SPL_DIR . '/admin/tabs/views/tabs-form/logo-header.php';
?>
<style>
p.free_version {
    font-weight: bold;
    font-size: 17px;
}
p.free_version span.highlighted {
    color: #b41d8d;
}
span.highlighted a {
    color: #b41d8d;
}
</style>
<div class="wrap">
    <h2><?php _e( 'Lists', 'spl' ); ?> <a href="<?php echo admin_url( 'admin.php?page=spl-tabs-new' ); ?>" class="add-new-h2"><?php _e( 'Add New', 'spl' ); ?></a></h2>
    <?php if (array_key_exists('error', $_GET)): ?>
        <div class="notice notice-error"><p><?php echo $_GET['error']; ?></p></div>
    <?php endif; ?>
    <?php if (array_key_exists('success', $_GET)): ?>
        <div class="notice notice-success"><p><?php echo $_GET['success']; ?></p></div>
    <?php endif; ?>
    <?php  
	$opt=get_option('spllk_opt'); 
		 if(empty($opt)){
			 echo '<p class="free_version">You are using the <span class="highlighted">Demo</span> version of the plugin. Click <span class="highlighted"><a href="http://designful.ca/apps/stylish-price-list-wordpress/">here</a></span> to buy the pro version.</p>';
		 }
	?>
    <form method="post">
        <input type="hidden" name="page" value="ttest_list_table">

        <?php
        $list_table = new Stylish_Price_List_Tabs_List();
        $list_table->prepare_items();
        $list_table->search_box( 'search', 's' );
        $list_table->display();
        ?>
    </form>
</div>
<?php 
    include_once SPL_DIR . '/admin/tabs/views/tabs-form/logo-footer.php';
?>