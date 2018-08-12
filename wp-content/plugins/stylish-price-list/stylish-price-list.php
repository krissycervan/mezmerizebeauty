<?php
/*
Plugin Name: Stylish Price List 
Plugin URI:  http://designful.ca/apps/stylish-price-list-wordpress/ 
Description: A stylish price list for Spas and Salons & Small Businesses
Version:     4.1.1
Author:      Designful
Author URI:  http://designful.ca 
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Domain Path: /languages
Text Domain: spl
*/

define('STYLISH_PRICE_LIST_VERSION', '1.0');
define('SPL_URL', plugin_dir_url( __FILE__ ));
define('SPL_DIR', dirname( __FILE__ ));

function spl_load_plugin_textdomain() {
    load_plugin_textdomain( 'spl', FALSE, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
}
add_action( 'plugins_loaded', 'spl_load_plugin_textdomain' );

function remove_slash_quotes($string){
    $string=stripslashes($string);
    $string=str_replace('\\\\','',$string);
    $string=str_replace("\\'","'",$string);
    $string=str_replace('\\"','"',$string);
    $string=htmlentities($string);
    return $string;
}//end want_more_lists() 

//Check SiteOrigin Plugin active or not
function my_custom_admin_notice(){
	if ( is_plugin_active( 'siteorigin-panels/siteorigin-panels.php' ) ) { //plugin is activated
    ?>
	  <div class="error notice">
        <p>We noticed you have Siteorigin Pagebuilder active, this can cause conflicts with the colors of the Price List. Make sure you are using the CUSTOM HTML WIDGET and not SITE ORIGIN EDITOR</p>
      </div>
   <?php } 
}
add_action( 'admin_notices', 'my_custom_admin_notice' );
//End

require_once SPL_DIR . '/wp-google-fonts/google-fonts.php';
require_once SPL_DIR . '/admin/tabs/tabs-db-functions.php';
// require_once SPL_DIR . '/php-errors-log.php'; //uncomments to turn on php errors log
require_once SPL_DIR . '/admin/tabs/serversettings142.php';
require_once SPL_DIR . '/shortcode/pricelist.php';
require_once SPL_DIR . '/admin/tabs/views/tabs-form/backup-restore.php';
// require_once SPL_DIR . '/tests/tests.php';
//https://developer.wordpress.org/plugins/the-basics/best-practices/
if ( is_admin() ) {
     // We are in admin mode
    $spl_installed = get_option('stylish_price_list_version');
    if( $spl_installed != STYLISH_PRICE_LIST_VERSION ) { 
        include_once( dirname( __FILE__ ) . '/spl-install.php' );
    }
     require_once( dirname(__FILE__).'/admin/admin.php' );
}

class Stylish_Price_List {
    public function __construct() { 
        add_action( 'init', array($this,'init') );
        register_activation_hook( __FILE__, array($this,'activation'));
        register_deactivation_hook( __FILE__, array($this,'deactivation'));
    }

    function init()
    {
    }

    function activation()
    {
    }

    function deactivation()
    {
    }
}
$stylish_price_list = new Stylish_Price_List();
