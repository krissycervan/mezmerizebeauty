<?php
/*
 * include all fonts used by business theme
 */
function business_a_fonts_url() {
	
	$business_obj = new business_a_settings_array();
	$option = wp_parse_args(  get_option( 'business_option', array() ), $business_obj->default_data() );
	
    $fonts_url = '';
		
    $font_families = array();
	
	$font_families[] = 'Roboto:100,300,400,500,600,700,900';
	$font_families[] = 'Raleway:100,300,400,500,600,700,900';
	$font_families[] = 'Roboto Slab:100,300,400,500,600,700,900';
	
	if(!in_array( $option['h1_fontfamily'] , $font_families ))
    {
		$font_families[] = $option['h1_fontfamily'].':100,300,400,500,600,700,900';
    }
	
	if(!in_array( $option['h2_fontfamily'] , $font_families ))
    {
		$font_families[] = $option['h2_fontfamily'].':100,300,400,500,600,700,900';
    }
	
	if(!in_array( $option['h3_fontfamily'] , $font_families ))
    {
		$font_families[] = $option['h3_fontfamily'].':100,300,400,500,600,700,900';
    }
	
	if(!in_array( $option['h4_fontfamily'] , $font_families ))
    {
		$font_families[] = $option['h4_fontfamily'].':100,300,400,500,600,700,900';
    }
	
	if(!in_array( $option['h5_fontfamily'] , $font_families ))
    {
		$font_families[] = $option['h5_fontfamily'].':100,300,400,500,600,700,900';
    }
	
	if(!in_array( $option['h6_fontfamily'] , $font_families ))
    {
		$font_families[] = $option['h6_fontfamily'].':100,300,400,500,600,700,900';
    }
	
	if(!in_array( $option['general_fontfamily'] , $font_families ))
    {
		$font_families[] = $option['general_fontfamily'].':100,300,400,500,600,700,900';
    }
	
        $query_args = array(
            'family' => urlencode( implode( '|', $font_families ) ),
            'subset' => urlencode( 'latin,latin-ext' ),
        );
 
        $fonts_url = add_query_arg( $query_args, '//fonts.googleapis.com/css' );

    return $fonts_url;
}

function business_a_fonts() {
	
    wp_enqueue_style( 'business-fonts', business_a_fonts_url(), array(), null );
	
}
add_action( 'wp_enqueue_scripts', 'business_a_fonts' );