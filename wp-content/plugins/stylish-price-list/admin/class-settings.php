<?php
class Stylish_Price_List_Settings {
    // var $license_return ='';
 
    public function __construct() { 
        add_action( 'admin_init', array($this,'admin_init') );
        add_action( 'admin_menu', array($this,'admin_menu'), 90 );
        $this->license_return =get_option('spl_license_return');
    }
    
    function admin_init()
    {
    register_setting('stylishpl_options','stylishpl_license_key',array($this,'process_key'));
    // register_setting('stylishpl_options','stylishpl_license_key');
    }

    function process_key($key)
    {
        // ob_start();
        // print_r($_REQUEST);
        // $data=ob_get_clean();
        // file_put_contents(dirname(__FILE__) . '/_REQUEST.log',$data,FILE_APPEND);
        // ob_start();
        // print_r($key);
        // echo PHP_EOL;
        // $data=ob_get_clean();
        // file_put_contents(dirname(__FILE__) . '/key.log',$data,FILE_APPEND);
        // $key=$in['stylishpl_license_key'];
        if(isset($_REQUEST['activate'])){
            $license_return=$this->activate($key);
        }else if(isset($_REQUEST['deactivate'])){
            $license_return=$this->deactivate($key);
        }
        update_option('spl_license_return',$license_return);
        // set_option();
        // ob_start();
        // print_r($this->license_return);
        // $data=ob_get_clean();
        // file_put_contents(dirname(__FILE__) . '/license_return.log',$data,FILE_APPEND);
        return $key;
    }

    function checkbox($name, $options=array(),$current_value_arr=array())
    {
        ob_start();
?>
    <div class="checkbox">
    <?php foreach ($options as $value => $label): 
            $checked='';
            if(in_array($value,$current_value_arr) != false){//find the value
                $checked=' checked="checked"';
            }
         ?>
            <label>
                <input name="<?php echo $name . '[]'; ?>" type="checkbox" value="<?php echo $value; ?>" <?php echo $checked; ?>>
                <?php echo $label; ?>
            </label>
    <?php endforeach ?>
    </div>
<?php
        $html=ob_get_clean();
        return $html;
    }

    function select($name, $options=array(),$current_value='')
    {
        ob_start();
?>
<select name="<?php echo $name; ?>" id="<?php echo $name; ?>" class="form-control">
    <?php foreach ($options as $value => $label): 
            $selected='';
            if($current_value==$value){
                $selected=' selected="selected"';
            }
         ?>
        <option value="<?php echo $value; ?>"<?php echo $selected; ?>><?php echo $label; ?></option>
    <?php endforeach ?>
</select>
<?php
        $html=ob_get_clean();
        return $html;
    }
    
    function option_page()
    {
		ob_start();
    include_once SPL_DIR . '/admin/tabs/views/tabs-form/logo-header.php';

    $stylishpl_license_key=get_option('stylishpl_license_key');
    $icon_class='dashicons-no';
    $icon_style='color:red;';
    $opt=get_option('spllk_opt');
    if(!empty($opt)){
        $icon_class='dashicons-yes';
        $icon_style='color:green;';
    }
    // ob_start();
    // print_r($_REQUEST);
    // $data=ob_get_clean();
    // file_put_contents(dirname(__FILE__) . '/_POST.log',$data,FILE_APPEND);
    // if(isset($_REQUEST['activate'])){
    //     $license_return=$this->activate($stylishpl_license_key);
    // }else if(isset($_REQUEST['deactivate'])){
    //     $license_return=$this->deactivate($stylishpl_license_key);
    // }
    
	if( isset($_GET['settings-updated']) && !empty($opt)) { ?>
    <div id="message" class="updated">
    <p><strong><?php _e('Settings saved.') ?></strong></p>
    </div>
    <?php } ?>
    <div class="wrap"><?php screen_icon(); ?>
    <h2>Stylish Price List Settings</h2>
    <form action="options.php" method="post" id=stylishpl-admin-options-form"> 
    <?php settings_fields('stylishpl_options'); ?>
    <style type="text/css">
        .dashicons-no::before,
        .dashicons-yes::before {
            font-size: 25px;
        }
    </style>
    <label for="stylishpl_license_key">License Key: </label><br/>
    <input type="password" id="stylishpl_license_key" name="stylishpl_license_key" value="<?php echo $stylishpl_license_key; ?>" /><span class="<?php echo $icon_class; ?> dashicons-before" style="<?php echo $icon_style; ?>"></span><br/>
    <p>
    <input type="submit" name="activate" value="Activate" class="button button-primary" /><input type="submit" name="deactivate" value="Deactivate" class="button button-default" style="margin-left:30px;"/></p>
    <?php 
        if($this->license_return != "1"){
            echo $this->license_return;
        }
    ?>
    </form>
    </div>
<?php	 
   $html_1=ob_get_clean();
   echo $html_1;

    }

    function include_license_settings(){
        $license_settings=SPL_DIR . '/license-settings.php';
        if(file_exists($license_settings)){
            require_once $license_settings;
            return true;
        }else{
            return 'cannot find the license-settings.php file in folder ' . SPL_DIR;
        }   
    }

    function update_opt($opt){
        update_option('spllk_opt',$opt);
    }

    function activate($key){
		 ob_start();
        if(!empty($key)){
            $license_data=$this->get_license_data($key,'slm_activate');
            if(isset($license_data->result)){
                if($license_data->result == 'success'){//Success was returned for the license activation
                    // update_option('sample_license_key', '');
                    $opt=get_object_vars($license_data);
                    // ob_start();
                    // print_r($opt);
                    // $data=ob_get_clean();
                    // file_put_contents(dirname(__FILE__) . '/opt.log',$data,FILE_APPEND);
                    $this->update_opt($opt);
                    return true;
                }
                if($license_data->result == 'error'){
					$message="Your license has reached the maximum amount of domains. Please note, this error message might appear by accident if you pressed the enter button twice, in this case you can just ignore this error message. If there's a green check-mark beside your serial that means your pro version has been activated. If you're moving domains, then just de-activate your license on your first domain before activating SPL on another domain.";
                    //Uncomment the followng line to see the message that returned from the license server
                    // return $license_data->message;
                    //return '<p style="color:red;"> Error: '.$license_data->message . '</p>';
					return '<p style="color:red;"> Error: '.$message . '</p>';
                }

            }else{
                return $license_data;
            }
        }else{
            $this->update_opt('');
            return 'The license key is empty';
        }
    }
    function deactivate($key){
        if(!empty($key)){
            $license_data=$this->get_license_data($key,'slm_deactivate');
            if(isset($license_data->result)){
                if($license_data->result == 'success'){//Success was returned for the license activation
                    // update_option('sample_license_key', '');
                    $this->update_opt('');
                    return true;
                }
                else{
                    //Uncomment the followng line to see the message that returned from the license server
                    // return $license_data->message;
                    return '<p style="color:red;"> Error: '.$license_data->message . '</p>';
                }

            }else{
                return $license_data;
            }
        }else{
            $this->update_opt('');
            return 'The license key is empty';
        }
    }

//     function activate_b0($key)
//     {
//         if(!empty($key)){
//             $include_license=$this->include_license_settings();
//             if($include_license !== true){
//                 return $include_license;
//             }
// //             $license_settings=SPL_DIR . '/license-settings.php';
// // // define('SPL_SPECIAL_SECRET_KEY', '5421048138b321.90068894');
// // // define('SPL_LICENSE_SERVER_URL', 'http://localhost/mass_products/site');
// // // define('SPL_ITEM_REFERENCE', 'stylish-price-list');
// //             if(file_exists($license_settings)){
// //                 require_once $license_settings;
// //             }else{
// //                 return 'cannot find the license-settings.php file in folder ' . SPL_DIR;
// //             }
//             // API query parameters
//             $api_params = array(
//                 'slm_action' => 'slm_activate',
//                 'secret_key' => SPL_SPECIAL_SECRET_KEY,
//                 'license_key' => $key,
//                 'registered_domain' => $_SERVER['SERVER_NAME'],
//                 'item_reference' => urlencode(SPL_ITEM_REFERENCE),
//             );

//             // Send query to the license manager server
//             $query = esc_url_raw(add_query_arg($api_params, SPL_LICENSE_SERVER_URL));
//             $response = wp_remote_get($query, array('timeout' => 20, 'sslverify' => false));

//             // Check for error in the response
//             if (is_wp_error($response)){
//                 return "Unexpected Error! The query returned with an error.";
//             }

//             //var_dump($response);//uncomment it if you want to look at the full response
            
//             // License data.
//             $license_data = json_decode(wp_remote_retrieve_body($response));
//             // ob_start();
//             // print_r($license_data);
//             // $data=ob_get_clean();
//             // file_put_contents(dirname(__FILE__) . '/license_data.log',$data,FILE_APPEND);
//             // TODO - Do something with it.
//             //var_dump($license_data);//uncomment it to look at the data
            
//             if($license_data->result == 'success'){//Success was returned for the license activation
//                 $opt=get_object_vars($license_data);
//                 // unset();
//                 // //Uncomment the followng line to see the message that returned from the license server
//                 // echo '<br />The following message was returned from the server: '.$license_data->message;
                
//                 // //Save the license key in the options table
//                 // update_option('sample_license_key', $license_key); 
//                 // $opt['google_fonts_preview_out']='google_fonts_preview';
//                 // $opt['html_out']='select_html';
//                 // $opt['get_fonts_options']='get_fonts_options';
//                 // $opt['max_cat_count']=999;
//                 // $opt['max_service_count']=999;
//                 // $opt['max_list_count']=999;
//                 update_option('spllk_opt',$opt);
//                 return true;
//             }
//             else{
//                 //Show error to the user. Probably entered incorrect license key.
                
//                 //Uncomment the followng line to see the message that returned from the license server
//                 return '<p style="color:red;"> Error: '.$license_data->message . '</p>';
//             }
//             // return true;
//         }else{
//             delete_option('spllk_opt');
//             return 'The license key is empty';
//         }
//     }


    function get_license_data($key,$action)
    {
        $include_license=$this->include_license_settings();
        if($include_license !== true){
            return $include_license;
        }
        // API query parameters
        $api_params = array(
            'slm_action' => $action,
            'secret_key' => SPL_SPECIAL_SECRET_KEY,
            'license_key' => $key,
            'registered_domain' => $_SERVER['SERVER_NAME'],
            'item_reference' => urlencode(SPL_ITEM_REFERENCE),
            // 'secret_key' => YOUR_SPECIAL_SECRET_KEY,
            // 'license_key' => $license_key,
            // 'registered_domain' => $_SERVER['SERVER_NAME'],
            // 'item_reference' => urlencode(YOUR_ITEM_REFERENCE),
        );

        // Send query to the license manager server
        $query = esc_url_raw(add_query_arg($api_params, SPL_LICENSE_SERVER_URL));
        $response = wp_remote_get($query, array('timeout' => 20, 'sslverify' => false));

        // Check for error in the response
        if (is_wp_error($response)){
            return "Unexpected Error! The query returned with an error.";
        }

        //var_dump($response);//uncomment it if you want to look at the full response
        
        // License data.
        $license_data = json_decode(wp_remote_retrieve_body($response));
        return $license_data;
    }

    // function deactivate_b0($key)
    // {
    //     if(!empty($key)){
    //         // $include_license=$this->include_license_settings();
    //         // if($include_license !== true){
    //         //     return $include_license;
    //         // }
    //         // // API query parameters
    //         // $api_params = array(
    //         //     'slm_action' => 'slm_deactivate',
    //         //     'secret_key' => YOUR_SPECIAL_SECRET_KEY,
    //         //     'license_key' => $license_key,
    //         //     'registered_domain' => $_SERVER['SERVER_NAME'],
    //         //     'item_reference' => urlencode(YOUR_ITEM_REFERENCE),
    //         // );

    //         // // Send query to the license manager server
    //         // $query = esc_url_raw(add_query_arg($api_params, YOUR_LICENSE_SERVER_URL));
    //         // $response = wp_remote_get($query, array('timeout' => 20, 'sslverify' => false));

    //         // // Check for error in the response
    //         // if (is_wp_error($response)){
    //         //     echo "Unexpected Error! The query returned with an error.";
    //         // }

    //         // //var_dump($response);//uncomment it if you want to look at the full response
            
    //         // // License data.
    //         // $license_data = json_decode(wp_remote_retrieve_body($response));
            
    //         // TODO - Do something with it.
    //         //var_dump($license_data);//uncomment it to look at the data
    //         $license_data=$this->get_license_data($key,'slm_deactivate');
    //         if(isset($license_data->result)){
    //             if($license_data->result == 'success'){//Success was returned for the license activation
                    
    //                 //Uncomment the followng line to see the message that returned from the license server
    //                 echo '<br />The following message was returned from the server: '.$license_data->message;
                    
    //                 //Remove the licensse key from the options table. It will need to be activated again.
    //                 update_option('sample_license_key', '');
    //             }
    //             else{
    //                 //Show error to the user. Probably entered incorrect license key.
                    
    //                 //Uncomment the followng line to see the message that returned from the license server
    //                 echo '<br />The following message was returned from the server: '.$license_data->message;
    //             }

    //         }else{
    //             return $license_data;
    //         }
    //     }else{
    //         delete_option('spllk_opt');
    //         return 'The license key is empty';
    //     }
    // }

	//Add Help Content //
	function help_page()
    {
        wp_enqueue_script('spl-bootstrap-min');
    include_once SPL_DIR . '/admin/tabs/views/tabs-form/logo-header.php';
?>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <div class="wrap"><?php screen_icon(); ?>
	<h1 style="height:1px; margin:0px; padding:0px;"></h1>
    <h2>Stylish Price List: Help</h2>
	   <div class="panel-group" id="accordion1">
    <div class="panel panel-default">
        <div class="panel-heading accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion1,#accordion2,#accordion3,#accordion4,#accordion5,#accordion6,#accordion7" data-target="#collapseOne1">
             <h4 class="panel-title">Question #1: What's the difference between Pro and demo?</h4>

        </div>
        <div id="collapseOne1" class="panel-collapse collapse">
		  <h4>Answer #1</h4>
            <div class="panel-body">The demo version only allows you to have 4 different categories and and up 4 different services per category.
				 The pro version allows unlimited lists, categories and services. It also comes with ability to switch the font and choose from the Google web fonts list.
			  </div>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion1,#accordion2,#accordion3,#accordion4,#accordion5,#accordion6,#accordion7" data-target="#collapseTwo1">
             <h4 class="panel-title">Question #2: My color or fonts not working properly.</h4>

        </div>
        <div id="collapseTwo1" class="panel-collapse collapse">
		<h4>Answer #2</h4>
            <div class="panel-body">
First (1) Try temporarily changing your theme in the theme settings under the Appearance tab. Change your theme to the basic stock theme that WordPress comes standard with and see if this fixes the issue. Don’t worry, changing your theme won’t lose any customizations or changes you’ve made.

Second (2) Try investigating if your theme's core color settings are interfering or overriding the plugin by seeing it the font and color that is appearing is set somewhere in your theme settings.

Third (3) Are you using Visual Composer, Beaver or any other Page Builders? Make sure the short-code [pricelist id="1494263699"] is placed in  the “Raw HTML” or “Site Origin Text Editor” or any other widget that doesn’t alter the CSS of your input.

Still having issues? 
				 You can email our support at info@designful.ca . Please include the direct link to the page that contains your price list, as well as a temporary admin login for us to login to your WordPress site and check it out in detail.
			  </div>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion1,#accordion2,#accordion3,#accordion4,#accordion5,#accordion6,#accordion7" data-target="#collapseThree1">
             <h4 class="panel-title">Question #3: What exactly is the title and categories in reference to?</h4>

        </div>
        <div id="collapseThree1" class="panel-collapse collapse">
		<h4>Answer #3</h4>
            <div class="panel-body"><img src="<?php echo site_url();?>/wp-content/plugins/stylish-price-list/assets/images/question3.png" alt="ques3" width="80%" height="70%" /></div>
        </div>
    </div>
	<div class="panel panel-default">
        <div class="panel-heading accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion1,#accordion2,#accordion3,#accordion4,#accordion5,#accordion6,#accordion7" data-target="#collapseFour1">
             <h4 class="panel-title">Question #4: I purchase the pro version, what now? I haven't received any download links or serial yet?</h4>

        </div>
        <div id="collapseFour1" class="panel-collapse collapse">
		<h4>Answer #4</h4>
            <div class="panel-body">You should receive it between 5 to 60 minutes from purchase. PLEASE CHECK YOUR SPAM FOLDER. If you still haven’t got it then please email info@designful.ca. You do not need to install/download anything further. Simply enter your serial code into the settings tab.</div>
        </div>
    </div>
	<div class="panel panel-default">
        <div class="panel-heading accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion1,#accordion2,#accordion3,#accordion4,#accordion5,#accordion6,#accordion7" data-target="#collapseFive1">
             <h4 class="panel-title">Question #5: Are you having issues with this plugin while inputting a different language?</h4>

        </div>
        <div id="collapseFive1" class="panel-collapse collapse">
		<h4>Answer #5</h4>
            <div class="panel-body">This plugin was formatted for English, French, Spanish and other languages that share the same alphabet. If you're using Greek, Russian, Cantonese or any other language, then their might be issues. Please contact our support on our Facebook page (link: <a href="https://www.facebook.com/designfulmultimedia">https://www.facebook.com/designfulmultimedia/</a>) or email info@designful.ca.</div>
        </div>
    </div>
	
	<div class="panel panel-default">
        <div class="panel-heading accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion1,#accordion2,#accordion3,#accordion4,#accordion5,#accordion6,#accordion7" data-target="#collapseSix1">
             <h4 class="panel-title">Question #6: I get an error message saying “You have activated too many domains!”</h4>

        </div>
        <div id="collapseSix1" class="panel-collapse collapse">
		<h4>Answer #6</h4>
            <div class="panel-body">Please refresh the activation license on our server by pressing the deactivate button then press then activate button again.</div>
        </div>
    </div>
    
    <div class="panel panel-default">
        <div class="panel-heading accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion1,#accordion2,#accordion3,#accordion4,#accordion5,#accordion6,#accordion7" data-target="#collapseSeven1">
             <h4 class="panel-title">Question # 7: How do I add extra style (bold or uppercase lettering) to my titles or descriptions?</h4>

        </div>
        <div id="collapseSeven1" class="panel-collapse collapse">
		<h4>Answer #7</h4>
            <div class="panel-body">To change the category titles, add this code to the Custom CSS option in your theme or by clicking the "Customize" feature in WordPress.

                <h5>/Title/</h5>
                <p>.price_wrapper .name-price-desc .name.a-tag {
                text-transform:uppercase;
                font-weight:normal;
                }</p>
                
                <h5>/Service Description/</h5>
                <p>.price_wrapper .name-price-desc .desc.a-tag {
                color:lightskybluegrey;
                padding-bottom:5px;
                padding-top:5px;
                }</p>
                
                <h5>/Price tag/</h5>
                <p>.price_wrapper .name-price-desc .spl-price.a-tag {
                font-weight:normal;
                }</p>
            </div>
        </div>
    </div>
</div>
		</div>
    
<?php
    }
// End Help Content
// Start Video Content
function video_page(){
	include_once SPL_DIR . '/admin/tabs/views/tabs-form/logo-header.php';
?>	
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<h1 style="height:1px; margin:0px; padding:0px;"></h1>
    <h2>Stylish Price List: Video Tutorials </h2>
	<div class="youtube_video">
	<iframe width="920" height="520" src="https://www.youtube.com/embed/zB6kz2nKxoI/?rel=0" frameborder="0" allowfullscreen></iframe>
	</div>
 <?php
}
 function admin_menu()
    {
    // add_management_page('Stylish Price List','Stylish Price List', 'manage_options', 'stylish_price_list_settings', array($this,'option_page'));
	    add_submenu_page( 'spl-tabs', __( 'Help', 'stylishpl' ), __( 'Help', 'stylishpl' ), 'manage_options', 'stylish_price_list_help', array( $this, 'help_page' ) );
		add_submenu_page( 'spl-tabs', __( 'Video Tutorials', 'stylishpl' ), __( 'Video Tutorials', 'stylishpl' ), 'manage_options', 'stylish_price_list_video', array( $this, 'video_page' ) );
        add_submenu_page( 'spl-tabs', __( 'Settings', 'stylishpl' ), __( 'Settings', 'stylishpl' ), 'manage_options', 'stylish_price_list_settings', array( $this, 'option_page' ) );
    }
}
$stylish_price_list_settings = new Stylish_Price_List_Settings();
?>
