<?php
function spl_get_options(){
    $opt=get_option('spllk_opt');

    if(empty($opt)){
        $opt['google_fonts_preview_out']='how_to_get_google_fonts';
        $opt['html_out']='hidden_html';
        $opt['get_fonts_options']='get_fonts_family_options';
        $opt['max_list_count']=2;
        $opt['max_cat_count']=4;
        $opt['max_service_count']=4;
    }
    return $opt;
}