<?php
function spl_tabs_init(){
    require_once dirname( __FILE__ ) . '/class-tabs-list-table.php';
    require_once dirname( __FILE__ ) . '/tabs-functions.php';
    require_once dirname( __FILE__ ) . '/tabs-db-functions.php';
    require_once dirname( __FILE__ ) . '/class-stylish-price-list-tabs-form-handler.php';
    require_once dirname( __FILE__ ) . '/class-stylish-price-list-tabs.php'; 
}//end spl_init

add_action('init','spl_tabs_init',10);
