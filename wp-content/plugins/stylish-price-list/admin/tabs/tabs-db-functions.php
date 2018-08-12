<?php
function spl_get_all_tabs(){
#https://wordpress.stackexchange.com/questions/236514/uninstalling-a-plugin-delete-all-options-with-specific-prefix
global $wpdb;

$prefix=spl_get_option_prefix();
$option_names = $wpdb->get_results( "SELECT option_name FROM $wpdb->options WHERE option_name LIKE '$prefix%'" );

$cats_data=array();
foreach( $option_names as $opt ) {
    $id=spl_get_id_from_option_name($opt->option_name);
    $option=get_option($opt->option_name);

    $cat=new stdClass();
    $cat->id=$id;
    $cat->shortcode='[pricelist id="' . $id .'"]';
    $cat->list_name=$option['list_name'];

    $cats_data[$id]=$cat;

    // delete_option($opt->option_name);
}
return $cats_data;
}

function spl_get_tabs_count(){
    return count(spl_get_all_tabs());
}

function spl_insert_tabs($cats_data){
    $insert_id=time();
    if(!empty($cats_data['id'])){
        $insert_id=$cats_data['id'];
    }
	
    $option_name=spl_get_option_name($insert_id);
    update_option($option_name,$cats_data);
    return $insert_id;
}

function spl_get_option_name($id){
    return spl_get_option_prefix() . $id;
}

function spl_get_id_from_option_name($option_name){
    $id=str_replace(spl_get_option_prefix(),'',$option_name);
    return $id;
}

function spl_get_option_prefix(){
    return 'spl_cats_';
}

function spl_delete_tabs_by_id($id){
    $option_name=spl_get_option_name($id);
    delete_option($option_name);
}

function spl_get_option($id){
    $option_name=spl_get_option_name($id);
    $cats_data=get_option($option_name);
    return $cats_data;
}