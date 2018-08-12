( function( $ , api ) {
	
	// site title 
    wp.customize( 'business_option[site_title]', function( value ) {
        value.bind( function( to ) {
            $( '.site-title' ).css( {
                'color': to
            } );
        } );
    } );
    // footer background
    wp.customize( 'business_option[footer_background]', function( value ) {
        value.bind( function( to ) {
            $( '.rdn-footer-top' ).css( {
                'background': to
            } );
        } );
    } );
    // footer info background
    wp.customize( 'business_option[footer_info_background]', function( value ) {
        value.bind( function( to ) {
            $( '.rdn-footer-bottom' ).css( {
                'background': to
            } );
        } );	
    } );
	
	
    /**
     * @param {api.selectiveRefresh.Placement}
     */
    api.selectiveRefresh.bind( 'partial-content-rendered', function( placement ) {
        $( window ).resize();
    } );

} )( jQuery , wp.customize );

