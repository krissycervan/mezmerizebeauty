<?php
    wp_enqueue_style( 'wp-color-picker' ); 
    wp_enqueue_script('spl-bootstrap-min');
    wp_enqueue_script('spl-pricelist-admin-core');

    wp_enqueue_script('spl-pricelist-admin');
    wp_enqueue_style('spl-bootstrap-min');


$id='';
if(isset($_GET['id'])){
    $id=$_GET['id'];
}
?>
<?php 
$list_count=spl_get_tabs_count();
$opt=spl_get_options();

$google_fonts_preview_out=$opt['google_fonts_preview_out'];
$html_out=$opt['html_out'];
$get_fonts_options=$opt['get_fonts_options'];
$max_cat_count=$opt['max_cat_count'];
$max_service_count=$opt['max_service_count'];
$max_list_count=$opt['max_list_count'];
if($list_count>=$max_list_count && empty($id)){echo want_more_lists(); return;};
// $want_more_lists=$opt['want_more_lists'];
?>

<?php 
$cats_data=array();
$_init_service=array(
        'service_name' =>'',
        'service_price' => '',
        'service_desc' => '',
		'service_url'  => ''
    );
$init_cat=array(
        'name'=>'',
        0=>$_init_service
    );
$cats_data['category'][1]=array(
        'name'=>'',
        1=>$_init_service
    );

$list_name='';
$hover_color='';
$title_color='';
$title_color_top='';
$price_color='';
$service_color='';

$list_name_font='';
$title_font='';
$price_font='';
$desc_font='';
if(!empty($id)){
    // $option_name=spl_get_option_name($id);
    // $cats_data=get_option($option_name);
    $cats_data=spl_get_option($id);
    /*echo "<pre>";
    print_r($cats_data);
    echo "</pre>";*/
    // ob_start();
    // print_r($cats_data);
    // echo PHP_EOL;
    // $data=ob_get_clean();
    // file_put_contents(dirname(__FILE__) . '/fields_data_after_retrieve.log',$data,FILE_APPEND);

    $list_name=$cats_data['list_name'];
	$all_tab=$cats_data['all_tab'];
	$style_cat_tab_btn=$cats_data['style_cat_tab_btn'];
	$style=$cats_data['tab_style'];
    $hover_color=$cats_data['hover_color'];
  $service_color=$cats_data['service_color'];
    $title_color=$cats_data['title_color'];
    $price_color=$cats_data['price_color'];
  $title_size=$cats_data['title_font_size'];
  $title_color_top=$cats_data['title_color_top'];
  $select_price=$cats_data['service_price_font_size'];

    $list_name_font=$cats_data['list_name_font'];
    $title_font=$cats_data['title_font'];
    $price_font=$cats_data['price_font'];
    $desc_font=$cats_data['desc_font'];
	$toggle=$cats_data['toggle'];
	$toggle_all_tab=$cats_data['toggle_all_tab'];
	$price_list_desc=$cats_data['price_list_desc'];
	
	$brack_title_desktop=$cats_data['brack_title_desktop'];
	$brack_title_tablets=$cats_data['brack_title_tablets'];
}
function want_more_lists(){
    ob_start();
    include_once dirname(__FILE__) . '/logo-header.php';
    ?>
    <div class="body-inner container-fluid" style="max-width:900px;margin-left:0px;">
        <div class="row cats-row">
            You're using the free version of this plugin, you can only use a maximum of 2 lists, 3 categories and 4 services. You can purchase a license to add unlimited lists and services. and categories. <a href="http://designful.ca/apps/stylish-price-list-wordpress/"> Purchase Here</a>
        </div>
    </div>
    <?php
    $html=ob_get_clean();
    return $html;
}//end want_more_lists() 

if(!function_exists('color_out')){
    function color_out($id,$value="",$title=""){
        ob_start();
        ?>
<div class="row cats-row">
    <div class="col-xs-5 col-sm-3 col-md-6 col-lg-6 text-right lbl">
        <label for="<?php echo $id; ?>"><?php echo $title; ?></label>
    </div>
    <div class="col-xs-7 col-sm-7 col-md-6  col-lg-6 padl-align">
        <input type="text" name="<?php echo $id; ?>" id="<?php echo $id; ?>" class="form-control <?php echo $id; ?> color-picker" value="<?php echo $value; ?>" title="<?php echo $title; ?>">
    </div>
</div> <!-- <?php echo $title; ?> -->
        <?php
        $html=ob_get_clean();
        return $html;
    }//end color_out() 
}//end if !function_exists('color_out')
if(!function_exists('how_to_get_google_fonts')){
    function how_to_get_google_fonts(){
        ob_start();
        ?>
        <div class="row cats-row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                Enter your <b>license key</b> to get Google fonts, 
                how Google fonts look like? check <a href="https://fonts.google.com/">Google fonts preview</a>
            </div>
        </div>
        <?php
        $html=ob_get_clean();
        return $html;
    }//end how_to_get_google_fonts() 
}//end if !function_exists('how_to_get_google_fonts')
if(!function_exists('google_fonts_preview')){
    function google_fonts_preview(){
        ob_start();
        ?>
        <div class="row cats-row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <b>How Google font looks like? check </b> <a href="https://fonts.google.com/">google fonts preview</a>
            </div>
        </div>
        <?php
        $html=ob_get_clean();
        return $html;
    }//end google_fonts_preview() 
}//end if !function_exists('google_fonts_preview')

if(!function_exists('html_out')){
    function html_out($name, $options=array(),$current_value='',$title=""){
        $html_out='hidden_html';//
        ob_start();
        ?>
        <div class="row cats-row">
            <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 lbl">
                <label for="<?php echo $name; ?>"><?php echo $title; ?></label>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                <?php echo $html_out($name,$options,$current_value); ?>
            </div>
        </div> <!-- List Name Font -->
        <?php
        $html=ob_get_clean();
        return $html;
    }//end html_out() 
}//end if !function_exists('html_out')


if(!function_exists('hidden_html')){
    function hidden_html($name, $options=array(),$current_value='',$title="")
    {
        ob_start();
?>
<input type="hidden" name="<?php echo $name; ?>" id="<?php echo $name; ?>" class="form-control" value="<?php echo $current_value; ?>">
<?php
        $html=ob_get_clean();
        return $html;
    }
}//end if !function_exists('hidden_html')
?>

<?php
if(!function_exists('select_html')){
    function select_html($name, $options=array(),$current_value='',$title="")
    {
        ob_start();
?>
<div class="row cats-row">
    <div class="col-xs-5 col-sm-3 col-md-6 col-lg-6 text-right lbl">
        <label for="<?php echo $name; ?>"><?php echo $title; ?></label>
    </div>
    <div class="col-xs-7 col-sm-7 col-md-6  col-lg-6 padl-align">
        <select name="<?php echo $name; ?>" id="<?php echo $name; ?>" class="form-control" style="box-shadow: 2px 2px 0px #888;">
            <?php foreach ($options as $value => $label): ?>
                <?php 
                    $selected='';
                    if($current_value==$value){
                        $selected=' selected="selected"';
                    }
          if($current_value==''){
          if($label=='Open Sans'){
            $selected=' selected="selected"';
            }
          } 
                 ?>
                <option value="<?php echo $value; ?>"<?php echo $selected; ?>><?php echo $label; ?></option>
            <?php endforeach ?>
        </select>
    </div>
</div> <!-- <?php echo $title; ?> -->
<?php
        $html=ob_get_clean();
        return $html;
    }
}//end if !function_exists('select_html')
?>
<?php 
if(!function_exists('service_items_html')){
    function service_items_html($cat_id=0,$service_id=0,$service=null){
        ob_start();
        $items=array(
                array(
                    'title'=>'Service Name',
                    'id'=>'service_name',
                    ),
                array(
                    'title'=>'Service Price',
                    'id'=>'service_price',
                    ),
                array(
                    'title'=>'Service Description/Length',
                    'id'=>'service_desc',
                    ),
					array(
                    'title'=>'Service URL',
                    'id'=>'service_url',
                    ),
            );
        // $cat_id=0;
        // $service_id=0;
        foreach ($items as $key => $item) {
			
            $item['cat_id']=$cat_id;
            $item['service_id']=$service_id;
            $item['value']=$service[$item['id']];
            echo service_item($item);
        }
		$html=ob_get_clean();
        return $html;
    }//end service_items_html()
}//end if !function_exists('service_items_html')
if(!function_exists('add_remove_service')){
    function add_remove_service($max_service_count){
        ob_start();
        ?>
        <div class="row add-remove-service">
            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 remove-service">
                <a href="javascript:void(0);" onclick="remove_service(this)" class="remove-service add-remove-service">Remove Service [-] </a>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 add-service">
                <a href="javascript:void(0);" onclick="add_service(this,<?php echo $max_service_count; ?>)" class="add-service add-remove-service">Add Service [+] </a>
            </div>
        </div>
        <?php
        $html=ob_get_clean();
        return $html;
    }//end add_remove_service() 
}//end if !function_exists('add_remove_service')

if(!function_exists('service_item')){
    function service_item($item){
        /*
        $item=array(
            'cat_id'=>0,
            'service_id'=>0,
            'title'=>'Service Name',
            'id'=>'service_name',
        );
        */
        ob_start();
        extract($item);
        $title="$title($service_id)";
        $name="category[{$cat_id}][{$service_id}][{$id}]";
        $html_id="category_{$cat_id}_{$service_id}_{$id}";
        $title=remove_slash_quotes($title);
        $value=remove_slash_quotes($value);
        ?>
        <div class="row service-price-length">
            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 lbl">
                <label for="<?php echo $html_id; ?>"><?php echo $title; ?></label>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                <input type="text" name="<?php echo $name; ?>" id="<?php echo $html_id; ?>" class="form-control <?php echo $id; ?>" value="<?php echo $value; ?>" title="">
            </div>
        </div>  <?php echo '<!-- ' . $title . ' -->'; ?> 
        <?php
        $html=ob_get_clean();
        return $html;
    }//end service_item() 
}//end if !function_exists('service_item')

if(!function_exists('category_name_row')){
    function category_name_row($cat_id,$cat_name="",$cat_description){
        $cat_name=remove_slash_quotes($cat_name);
        ob_start();
        ?>
        <div class="row category-name-row">
            <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 lbl">
                <label for="category_<?php echo $cat_id; ?>_name">Category Name(<?php echo $cat_id; ?>)</label>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                <input type="text" name="category[<?php echo $cat_id; ?>][name]" id="category_<?php echo $cat_id; ?>_name" class="form-control category_name" value="<?php echo $cat_name; ?>" title="">
            </div>
        </div> <!-- Category Name -->
		<!--Category Description-->
		<div class="row category-description-row">
            <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 lbl">
                <label for="category_<?php echo $cat_id; ?>_description">Category Description(<?php echo $cat_id; ?>)</label>
            </div> 
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
				<textarea name="category[<?php echo $cat_id; ?>][description]" id="category_<?php echo $cat_id; ?>_description" class="form-control category_description" rows="2" cols="50"><?php echo remove_slash_quotes($cat_description); ?></textarea>
            </div>
        </div>
		<!--End Category Description-->
        <?php
        $html=ob_get_clean();
        return $html;
    }//end category_name_row() 
}//end if !function_exists('category_name_row')

if(!function_exists('category_row')){
    function category_row($cat_id,$cat=null,$max_service_count=3){
		//echo $cat_id;
        ob_start();
        $cat_name="";
        if(!is_null($cat)){
            $cat_name=$cat['name'];
            unset($cat['name']);//remove the name items, so, we can use foreach to process 
        }
		$cat_description="";
		if(!is_null($cat)){
            //$cat_description=$cat['description'];
			$cat_description=isset($cat['description']) ? $cat['description'] : '';
            unset($cat['description']);//remove the name items, so, we can use foreach to process 
        }
        ?>
            <div class="row category-row">
                <?php 
		
                    // $cat_id=0;
                    // $service_id=0;
                    echo category_name_row($cat_id,$cat_name,$cat_description);
                 ?>
                 <?php 
                 foreach ($cat as $service_id => $service):
                ?>
                            <!-- echo category_row($cat_id,$service_id,$cat_name); -->
                    <div class="service-price-length-rows-wrapper">
                    <?php 
                        echo service_items_html($cat_id,$service_id,$service);
                        echo add_remove_service($max_service_count);
                    ?>
                    </div> <!-- service-price-length-rows-wrapper -->
					
                <?php   
                 endforeach;
				if($service_id > 1){
                ?>
				<a href="javascript:void(0);" id="remove-category-row" class="remove-category" onclick="">Remove Category [-] </a>
				<?php } ?>
            </div> <!-- category-row -->
        <?php
        $html=ob_get_clean();
        return $html;
    }//end category_row() 
}//end if !function_exists('category_row')
?>
<style type="text/css">
    .category-name-row label,
    .add-category-row,.add-category-row:hover,.add-category-row:focus{
        color:#b70bb7;
        font-weight: bold;
    }

    .add-remove-service,.add-remove-service:hover,.add-remove-service:focus{
        color:#000;
        font-weight: bold;
    }

    .service-price-length label{
        color:#666;
        margin:0px;
    }

    .add-category-row-lbl,
    .category-name-row .lbl,
    .service-price-length .lbl{
        text-align: right;
    }
    .service-price-length .lbl{
        line-height: 30px;
    }
    .remove-service{
        text-align: right;
    }

    .cats-row,.category-row,
    .service-price-length{
        margin: 15px 0;
    }

    .add-remove-service{
        margin: 20px 0;
    }

    .category-name-row{
        padding-left: 15px;
        padding-right: 15px;
    }

    #wpcontent{
        background-color: #fff;
    }

    .spl-header.logo{
        position: relative;
        top: 0px !important;
    }
  .iris-picker.iris-border {
    z-index: 999;
  }
  .wp-picker-open {
    vertical-align: top;
  }
  #wpfooter{
      position: relative;
  }
  .wp-core-ui .button-primary {
    background: #b41d8d;
    border-color: #b5218f #b41d8d #be3b9c;
    -webkit-box-shadow: 0 1px 0 #006799;
    box-shadow: 0 1px 0 #b41d8d;
    color: #fff;
    text-decoration: none;
    text-shadow: 0 -1px 1px #df9ece, 1px 0 1px #b41d8d, 0 1px 1px #b41d8d, -1px 0 1px #b41d8d;
    }
    .wp-core-ui .button-primary:hover {
    background: #b41d8d;
    border-color: #b41d8d;
    color: #fff;
    }
  <!--AK Style -->
  .containr .wp-picker-container {
    min-height: 36px !important;
  }
  input#submit_tabs:active, input#submit_tabs:focus {
    background: #b41d8d;
    border-color: #b5218f #b41d8d #be3b9c;
    -webkit-box-shadow: 0 1px 0 #b5218f, 0 0 2px 1px #b5218f;
    box-shadow: 0 1px 0 #b5218f, 0 0 2px 1px #770e0e;
  }
  .notice-done {
    background: #fff;
    border-left: 4px solid #27c500;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    margin: 0px;
    padding: 1px 12px;
  }
  .notice-eror {
    background: #fff;
    border-left: 4px solid #ff0018;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    margin: 0px;
    padding: 1px 12px;
  }
  .containr label {
        font-weight: normal !important;
    }
  .price_wrapper input[type="radio"]:focus {
        outline: none !important;
    }
  @media screen and (min-width: 992px){
    .padl-align {
      padding-left: 22px !important;
    }
    .containr .wp-color-result {
      /*margin-left: 18px;*/
      vertical-align: top;
    }
  }
  #preview {
    text-decoration: none;
    color: white;
    background-color: #b41d8d;
    padding: 6px 10px;
    border-radius: 3px;
    margin-top: 11px;
     }
    .anqur {
    margin-left: 57px;
    margin-top: -46px;
    float: left;
    width: 100%;
    }
  div#flip i {
    margin-left: 10px;
}

#panel, #flip {
    padding: 16px;
    text-align: left;
    background-color: #f5f5f5;
    border-color: #ddd;
    border-radius: 4px;
    font-size: 20px;
}
.flip_accordian, .flip_accordian_content{
    padding: 16px;
    text-align: left;
    background-color: #f5f5f5;
    border-color: #ddd;
    border-radius: 4px;
    font-size: 20px;
}
.flip_accordian_content{
     padding: 50px;
    display: none;
}
    #panel {
    padding: 50px;
    display: none;
    }
  .price_wrapper .name-price-desc .desc {
    margin-top: 15px;
     }
  
 .remove-category {
    margin-left: 85px;
    color: #b70bb7;
    font-weight: 700;
}
.remove-category:hover {
    color: #b70bb7;
}
#all_tab {
    width: 50%;
}
span.all_tab_span {
    font-size: 10px;
}
.more_setting{
	display:none;
}
.more-stng-btn{
    background-color: #ffffff;
    padding: 10px 19px;
    color: #000;
    border: 1px solid #cccccc;
    border-radius: 5px;
	position:relative;
}
.more-stng-btn i{
	padding-left:10px;
}
.more-stng-btn-rotate i{
	padding-right: 10px;
    padding-left: 0px;
	transform: rotate(180deg);
}
.category-description-row .lbl {
    text-align: right;
}
.category-description-row label {
    color: #b70bb7;
    font-weight: bold;
}
/*.price_wrapper form:last-child {
    position: absolute;
    bottom: 16px;
    left: 74px;
    right: 0px;
}*/
.price_wrapper {
    position: relative;
}
.price_wrapper input#fileupload {
    width: 198px;
    float: left;
}
.price_wrapper input#fileupload {
    float: left;
}
form.custom-backup-restore {
   /* position: absolute;
    bottom: 123px;
    left: 85px;*/
}
div#flip {
    margin-top: 17px;
}
div.flip_accordian{
    margin-top: 17px;
}
form.custom-backup-restore {
    /*position: absolute;
    left: 85px;
    bottom: 20px;*/
}
.form-save-and-restore {
    position: relative;
}
.row.cats-row.more_setting {
    padding-top: 10px;
}
h4.title-font {
    font-size: 16px;
}
.notice.notice-erroe {
    border-left: 4px solid red;
}

@media(min-width:320px) and (max-width:768px){
.col-xs-3.col-sm-3.col-md-3.col-lg-3 {
    width: 100%;
}
label.radio-inline {
    line-height: 34px;
}
label.radio-inline input {
    float: left;
    margin-right: 11px !important;
    right: 9px;
}
.checkbox label {
    padding-left: 33px !important;
}
.checkbox label input {
    float: left;
    margin-right: 10px !important;
    left: 18px;
}
.checkbox label {
    line-height: 31px;
}
}
	 <!--AK Style -->
  
</style>
<?php 
  include_once dirname(__FILE__) . '/logo-header.php';
?>
<?php if (array_key_exists('error', $_GET)): ?>
    <div class="notice notice-error"><p><?php echo $_GET['error']; ?></p></div>
<?php endif; ?>
<?php if (array_key_exists('success', $_GET)): ?>
    <div class="notice notice-success"><p><?php echo $_GET['success']; ?></p></div>
<?php endif; ?>
<?php 
$id=isset($_GET['id']) ? $_GET['id'] : '';
$cats_data1=spl_get_option($id);
?>
<?php 
            global $spl_googlefonts_var;
            $google_fonts=$spl_googlefonts_var->$get_fonts_options();
            // $google_fonts=array(
            //         ''=>'Select a Google Font',
            //     );

            // $gf_fonts=$spl_googlefonts_var->get_fonts();
            // foreach($gf_fonts as $font){
            //     $class = array();           
            //     $has_variants = false;
            //     $has_subsets = false;
            //     $normalized_name = $spl_googlefonts_var->gf_normalize_font_name($font->family);
                
            //     $class[] = $normalized_name;
                
            //     if(count($font->variants)>1){
            //         $class[] = "has-variant";
            //     }
            //     if(count($font->subsets)>1){
            //         $class[] = "has-subsets";
            //     }
            //     $google_fonts[$normalized_name]=$font->family;
            // }
        ?>
    <h1 style="height:1px; margin:0px; padding:0px;"></h1>
<div class="body-inner price_wrapper container-fluid" style="margin-left:0px;">

<!---// INNER FORM IN ONE ROW --->
<div class="form-save-and-restore">
    <form action="" method="POST" role="form">

    <div style="max-width:900px;margin-left:0px;">

  <div class="row cats-row">
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <?php submit_button( __( 'Save', 'spl' ), 'primary', 'submit_tabs' ); ?>
        </div>
  </div>
  
  <?php  
  $opt=get_option('spllk_opt'); 
     if(empty($opt)){
       echo '<p class="free_version">You are using the <span class="highlighted">Demo</span> version of the plugin. Click <span class="highlighted"><a href="http://designful.ca/apps/stylish-price-list-wordpress/">here</a></span> to buy the pro version.</p>';
     }
  ?>
  
  <div class="row cats-row">
    <div class="col-xs-7 col-sm-7 col-md-4 col-lg-4">
                <span>Shortcode <b>[pricelist id="<?php echo $id; ?>"]</b></span>
              </div>
  </div>
  
  <div class="row cats-row">
            <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 lbl">
                <label for="list_name">Price List Name</label>
            </div>
            <div class="col-xs-7 col-sm-7 col-md-6 col-lg-6">
                <?php $list_name=remove_slash_quotes($list_name) ?>
                <input type="text" name="list_name" id="list_name" class="form-control list_name" required="" value="<?php echo $list_name; ?>" title="">
            </div>
    </div>
	
	<!--Section for Change Style-->
	<div class="row cats-row">
            <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 lbl">
                <label for="default_tab">Select Style</label>
            </div>
            <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                <select class="form-control" id="sel1" name="tab_style">
                  <option class="form-control default_tab" value="with_tab">Style #1</option>
				  <option class="form-control default_tab" value="without_tab" <?php echo ($style=='without_tab') ? "selected": ""; ?>>Style #2</option>
				  <option class="form-control default_tab" value="style_3" <?php echo ($style=='style_3') ? "selected": ""; ?>>Style #3</option>
				  <option class="form-control default_tab" value="style_4" <?php echo ($style=='style_4') ? "selected": ""; ?>>Style #4</option>
                </select>
            </div>
        </div>
	<!--End Section for Change Style-->
	
	<!--Add more setting button-->
	
	<div class="row cats-row advance_setting">
            <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 lbl">
                <span class="more-stng-btn">More Settings <i class="fa fa-chevron-down"></i></span>
            </div>
    </div>
	<!--End more setting button-->
	
		<!-- START of Change DEFAULT Tab name-->
  <div class="row cats-row more_setting">
            <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 lbl">
                <label for="default_tab">Default Tab</label>
            </div>
            <div class="col-xs-7 col-sm-7 col-md-4 col-lg-4">
                <select class="form-control" id="sel1" name="default_tab">
				<?php if($all_tab!=''){
						$all=$all_tab;
						}else{
							$all="All";
						}
				?>
                  <option class="form-control default_tab" value=""><?php echo $all?></option>
                   <?php 
				
           foreach($cats_data1[category] as $key => $cats_datas[category]){
            
             if(strtolower($key)== strtolower($cats_data['default_tab']))
             {$sel="Selected"; } else{$sel="";} ?>
                  <option class="form-control default_tab <?php if($cats_datas[category][name]==""){echo " hidden";}?>" value="<?php echo $key;?>" <?php echo $sel;?>><?php echo $cate_name=$cats_datas[category][name];?></option>
  <?php }
           ?>
                </select>
            </div>
        </div>
		<!-- END of Change DEFAULT Tab name-->
		<!--Change All Tab name-->
    <div class="row cats-row more_setting">
            <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 lbl">
                <label for="all_tab">Change "All" word for Categories <span class="all_tab_span">(different languages)</span></label>
            </div>
			<?php if($all_tab!=''){$all_tab=$all_tab;}else{$all_tab="All";}?>
            <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                <input type="text" name="all_tab" id="all_tab" class="form-control all_tab" value="<?php echo $all_tab; ?>" title="">
            </div>
    </div>
	<!--End Change All Tab name-->
		
			<!--Hide All Tab-->
	<div class="row cats-row more_setting">
    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 lbl">
                <label for="default_tab">Display the "All" word? <span class="all_tab_span"></span></label>
            </div>
      <div class="col-xs-7 col-sm-7 col-md-6 col-lg-6">
      <?php 
        $checked="checked";
        $unchecked="";
        ?>
		<label class="radio-inline"><input type="radio" name="toggle_all_tab" id="toggle_all_tab" class="toggle_all_tab" required="" value="0" <?php if($toggle_all_tab==0 ){ echo $checked;} else{echo $unchecked; }?>>Off</label>
        <label class="radio-inline"><input type="radio" name="toggle_all_tab" id="toggle_all_tab" class="toggle_all_tab" required="" value="1" <?php if($toggle_all_tab==1 || $toggle_all_tab==''){ echo $checked;} else{echo $unchecked; }?>>On</label>
        
            </div>
    </div> 
	<!--End Hide All Tab-->
		
    <!--Toggle setting-->
    <div class="row cats-row more_setting">
    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 lbl">
                <label for="default_tab">Category Separator Symbol</label>
            </div>
      <div class="col-xs-7 col-sm-7 col-md-6 col-lg-6">
      <?php 
        $checked="checked";
        $unchecked="";
        ?>
         <label class="radio-inline"><input type="radio" name="toggle" id="toggle" class="toggle" required="" value="0" <?php if($toggle==0 || $toggle=''){ echo $checked;} else{echo $unchecked; }?>>Off</label>
          
          <label class="radio-inline"><input type="radio" name="toggle" id="toggle" class="toggle" required="" value="1" <?php if($toggle==1){ echo $checked;} else{echo $unchecked; }?>>On</label>
         </div>
    </div>  
    <!--end toggle setting-->

	
	<!--Style Category Tab Button-->
	<div class="row cats-row more_setting">
    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 lbl">
                <label for="category_tab_button">Stylish Category Tabs Buttons</label>
            </div>
      <div class="col-xs-7 col-sm-7 col-md-6 col-lg-6">
      <?php 
        $checked="checked";
        $unchecked="";
        ?>
		<label class="radio-inline"><input type="radio" name="style_cat_tab_btn" id="style_cat_tab_btn" class="style_cat_tab_btn" required="" value="0" <?php if($style_cat_tab_btn==0 ){ echo $checked;} else{echo $unchecked; }?>>Off</label>
        <label class="radio-inline"><input type="radio" name="style_cat_tab_btn" id="style_cat_tab_btn" class="style_cat_tab_btn" required="" value="1" <?php if($style_cat_tab_btn==1 || $toggle_all_tab==''){ echo $checked;} else{echo $unchecked; }?>>On</label>
        
            </div>
    </div> 
	<!--End Style Category Tab Button-->
	<!--Brack title of Service-->
	<div class="row cats-row more_setting">
    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 lbl">
                <label for="category_tab_button">Break title of Service</label>
            </div>
      <div class="col-xs-7 col-sm-7 col-md-6 col-lg-6">
            <?php 
               if($brack_title_desktop!='' && $brack_title_desktop==1){
                   $desktop_check='checked="checked"';
               }else{
                   $desktop_check="";
               }
               if($brack_title_tablets!='' && $brack_title_tablets==1){
                   $tab_check='checked="checked"';
               }else{
                   $tab_check="";
               }
            ?>
          <div class="checkbox">
              <label><input name="brack_title_desktop" type="checkbox" value="1" <?php echo $desktop_check; ?> >Break line of categories on Desktop </label>
            </div>
            <div class="checkbox">
              <label><input name="brack_title_tablets" type="checkbox" value="1" <?php echo $tab_check; ?> >Break line of categories on Tablets </label>
          </div>
        </div>
    </div> 
	<!--End Brack title of Service-->
	
	
	<!--Add Textarea for price list description-->
	<div class="row cats-row more_setting">
            <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 lbl">
                <label for="all_tab">Price List Description</label>
            </div>
            <div class="col-xs-7 col-sm-7 col-md-6 col-lg-6">
                <textarea name="price_list_desc" id="price_list_desc" class="form-control price_list_desc" rows="2" cols="50"><?php echo $price_list_desc; ?></textarea>
            </div>
    </div>
	<!--End Textarea for price list description-->
     <!--<div class="row cats-row">
            <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 lbl">
                <label for="list_name">Price List Name</label>
            </div>
            <div class="col-xs-7 col-sm-7 col-md-6 col-lg-6">
                <?php //$list_name=remove_slash_quotes($list_name) ?>
                <input type="text" name="list_name" id="list_name" class="form-control list_name" required="" value="<?php //echo $list_name; ?>" title="">
            </div>
                  </div>
    </div>-->  
        
   <div class="containr" style="max-width:900px;margin-left:0px;">
     <div class="row">     
      <div class="col-md-5">
      <div class="col-md-offset-2 col-md-10">
        <h4 class="title-font"><b>Title</b></h4>
      </div>
      
        <div class="row cats-row">
            <div class="col-xs-5 col-sm-3 col-md-6 col-lg-6 text-right lbl">
                <label for="title_font_size">Font Size</label>
            </div>
            <div class="col-xs-7 col-sm-7 col-md-6  col-lg-6 padl-align">
                <select class="form-control" id="sel1" name="title_font_size" style="box-shadow: 2px 2px 0px #888;">
                  <option class="form-control title_size" value="">Size</option>
                <?php 
        foreach($cats_data1[category] as $cats_datas[category]){
          $cats_data['title_font_size'];
          }
        for($i=1; $i<=100; $i++){ 
        if($i.'px'== $cats_data['title_font_size']){
          $select = "selected";
          }
          else{
            $select = "";
            }
        ?>
           <option class="form-control title_font_size" value="<?php echo $i ;?>px" <?php echo $select; ?>><?php echo $i ;?>px</option>
          <?php }
          ?>
                </select>
            </div>
        </div>
    
    <?php if($title_color_top == ''){ echo color_out('title_color_top','#000','Font Color'); }?>
    <?php if($title_color_top != ''){ echo color_out('title_color_top',$title_color_top,'Font Color'); }?>
    <?php echo $html_out('list_name_font',$google_fonts,$list_name_font,'Font Style'); ?>
       </div>  
        <div class="col-md-5"> 
      <div class="col-md-offset-2 col-md-10">
        <h4 class="title-font"><b>Category (Tabs)</b></h4>
      </div>
    <div class="row cats-row">
            <div class="col-xs-5 col-sm-3 col-md-6 col-lg-6 text-right lbl">
                <label for="tab_font_size">Font Size</label>
            </div>
            <div class="col-xs-7 col-sm-7 col-md-6  col-lg-6 padl-align">
                <select class="form-control" id="sel1" name="tab_font_size" style="box-shadow: 1px 1px 0px #888;">
                  <option class="form-control tab_size" value="">Size</option>
                <?php 
        foreach($cats_data1[category] as $cats_datas[category]){
          $cats_data['tab_font_size'];
          }
        for($j=1; $j<=100; $j++){ 
        if($j.'px'== $cats_data['tab_font_size']){
          $select_tab = "selected";
          }
          else{
            $select_tab = "";
            }
        ?>
           <option class="form-control tab_font_size" value="<?php echo $j ;?>px" <?php echo $select_tab; ?>><?php echo $j ;?>px</option>
          <?php }
          ?>
                </select>
            </div>
        </div>
    <?php if($title_color == ''){ echo color_out('title_color','#000','Font Color'); }?>
        <?php if($title_color != ''){ echo color_out('title_color',$title_color,'Font Color'); }?>
    <?php echo $html_out('title_font',$google_fonts,$title_font,'Font Style'); ?>
        <?php if(false): ?>
          
      <div class="row cats-row">
            <div class="col-xs-5 col-sm-3 col-md-5 col-lg-5 lbl text-right">
                <label for="title_color_top">Title (Font Color)</label>
            </div>
            <div class="col-xs-7 col-sm-7 col-md-6 col-lg-6">
                <input type="text" name="title_color_top" id="title_color_top" class="form-control title_color_top color-picker" value="<?php echo $title_color_top; ?>" title="">
            </div>
        </div> 
        <div class="row cats-row">
            <div class="col-xs-5 col-sm-3 col-md-5 col-lg-5 lbl text-right">
                <label for="title_color">Service Categories (Font Color)</label>
            </div>
            <div class="col-xs-7 col-sm-7 col-md-6 col-lg-6">
                <input type="text" name="title_color" id="title_color" class="form-control title_color color-picker" value="<?php echo $title_color; ?>" title="">
            </div>
        </div> <!-- Title Color -->
        

        <div class="row cats-row">
            <div class="col-xs-5 col-sm-3 col-md-5 col-lg-5 lbl text-right">
                <label for="price_color">Price (Font Color)</label>
            </div>
            <div class="col-xs-7 col-sm-7 col-md-6 col-lg-6">
                <input type="text" name="price_color" id="price_color" class="form-control price_color color-picker" value="<?php echo $price_color; ?>" title="">
            </div>
        </div> <!-- Price Color -->

        <div class="row cats-row">
            <div class="col-xs-5 col-sm-3 col-md-5 col-lg-5 lbl text-right">
                <label for="hover_color">Hover (Font Color)</label>
            </div>
            <div class="col-xs-7 col-sm-7 col-md-6 col-lg-6">
                <input type="text" name="hover_color" id="hover_color" class="form-control hover_color color-picker" value="<?php echo $hover_color; ?>" title="">
            </div>
        </div>
    
         <!-- Hover Color -->
         <div class="row cats-row">
            <div class="col-xs-5 col-sm-3 col-md-5 col-lg-5 lbl text-right">
                <label for="service_color">Service Description (Font Color)</label>
            </div>
            <div class="col-xs-7 col-sm-7 col-md-6 col-lg-6">
                <input type="text" name="service_color" id="service_color" class="form-control service_color color-picker" value="<?php echo $service_color; ?>" title="">
            </div>
        </div>
         
        <?php endif;//end false ?>
        <script type="text/javascript">
              jQuery(function($){
                   $('.color-picker').wpColorPicker();
              });
        </script>
         </div>
         
          </div>
       <div class="row">     
      <div class="col-md-5">   
      <div class="col-md-offset-2 col-md-10">
        <h4 class="title-font"><b>Service Name</B></h4>
      </div>
        <div class="row cats-row">
            <div class="col-xs-5 col-sm-3 col-md-6 col-lg-6 text-right lbl">
                <label for="tab_font_size">Font Size</label>
            </div>
            <div class="col-xs-7 col-sm-7 col-md-6  col-lg-6 padl-align">
                <select class="form-control" id="sel1" name="service_font_size" style="box-shadow: 2px 2px 0px #888;">
                  <option class="form-control service_size" value="">Size</option>
                <?php 
        foreach($cats_data1[category] as $cats_datas[category]){
          $cats_data['service_font_size'];
          }
        for($k=1; $k<=100; $k++){ 
        if($k.'px'== $cats_data['service_font_size']){
          $select_ser = "selected";
          }
          else{
            $select_ser = "";
            }
        ?>
           <option class="form-control service_font_size" value="<?php echo $k ;?>px" <?php echo $select_ser; ?>><?php echo $k ;?>px</option>
          <?php }
          ?>
                </select>
            </div>
        </div>
    <?php if($service_color == ''){ echo color_out('service_color','#000','Font Color'); }?>
        <?php if($service_color != ''){echo color_out('service_color',$service_color,'Font Color'); }?>
    <?php echo $html_out('desc_font',$google_fonts,$desc_font,'Font Style'); ?>
    <?php if($hover_color == ''){ echo color_out('hover_color','#000','Hover (Font Color)'); } ?>
        <?php if($hover_color != ''){ echo color_out('hover_color',$hover_color,'Hover Color'); }?>
       </div> 
       
        <div class="col-md-5"> 
      <div class="col-md-offset-2 col-md-10">
        <h4 class="title-font"><b>Service Price</b></h4>
      </div>  
    <div class="row cats-row">
            <div class="col-xs-5 col-sm-3 col-md-6 col-lg-6 text-right lbl">
                <label for="tab_font_size">Font Size</label>
            </div>
            <div class="col-xs-7 col-sm-7 col-md-6  col-lg-6 padl-align">
                <select class="form-control" id="sel1" name="service_price_font_size" style="box-shadow: 2px 2px 0px #888;">
                  <option class="form-control service_price_font_size" value="">Size</option>
                <?php 
        foreach($cats_data1[category] as $cats_datas[category]){
          $cats_data['service_price_font_size'];
          }
        for($n=1; $n<=100; $n++){ 
        if($n.'px'== $cats_data['service_price_font_size']){
          $select_ser = "selected";
          }
          else{
            $select_ser = "";
            }
        ?>
           <option class="form-control service_price_font_size" value="<?php echo $n ;?>px" <?php echo $select_ser; ?>><?php echo $n ;?>px</option>
          <?php }
          ?>
                </select>
            </div>
        </div>
    <?php if($price_color == ''){ echo color_out('price_color','#000','Price (Font Color)'); }?>
        <?php if($price_color != ''){ echo color_out('price_color',$price_color,'Font Color'); }?>
    <?php echo $html_out('price_font',$google_fonts,$price_font,'Font Style'); ?>
        <?php if(false): ?>
          
        <div class="row cats-row">
            <div class="col-xs-5 col-sm-3 col-md-5 col-lg-5 lbl text-right">
                <label for="title_color">Service Categories (Font Color)</label>
            </div>
            <div class="col-xs-7 col-sm-7 col-md-6 col-lg-6">
                <input type="text" name="title_color" id="title_color" class="form-control title_color color-picker" value="<?php echo $title_color; ?>" title="">
            </div>
        </div> <!-- Title Color -->

        <div class="row cats-row">
            <div class="col-xs-5 col-sm-3 col-md-5 col-lg-5 lbl text-right">
                <label for="price_color">Price (Font Color)</label>
            </div>
            <div class="col-xs-7 col-sm-7 col-md-6 col-lg-6">
                <input type="text" name="price_color" id="price_color" class="form-control price_color color-picker" value="<?php echo $price_color; ?>" title="">
            </div>
        </div> <!-- Price Color -->

        <div class="row cats-row">
            <div class="col-xs-5 col-sm-3 col-md-5 col-lg-5 lbl text-right">
                <label for="hover_color">Hover (Font Color)</label>
            </div>
            <div class="col-xs-7 col-sm-7 col-md-6 col-lg-6">
                <input type="text" name="hover_color" id="hover_color" class="form-control hover_color color-picker" value="<?php echo $hover_color; ?>" title="">
            </div>
        </div>
         <!-- Hover Color -->
         <div class="row cats-row">
            <div class="col-xs-5 col-sm-3 col-md-5 col-lg-5 lbl text-right">
                <label for="service_color">Service Description (Font Color)</label>
            </div>
            <div class="col-xs-7 col-sm-7 col-md-6 col-lg-6">
                <input type="text" name="service_color" id="service_color" class="form-control service_color color-picker" value="<?php echo $service_color; ?>" title="">
            </div>
        </div>
         
        <?php endif;//end false ?>
        <script type="text/javascript">
              jQuery(function($){
                   $('.color-picker').wpColorPicker();
              });
        </script>
         </div>
         
          </div>
      </div>
      <div style="max-width:900px;margin-left:0px;">
        <?php 
            global $spl_googlefonts_var;
            $google_fonts=$spl_googlefonts_var->$get_fonts_options();
            // $google_fonts=array(
            //         ''=>'Select a Google Font',
            //     );

            // $gf_fonts=$spl_googlefonts_var->get_fonts();
            // foreach($gf_fonts as $font){
            //     $class = array();           
            //     $has_variants = false;
            //     $has_subsets = false;
            //     $normalized_name = $spl_googlefonts_var->gf_normalize_font_name($font->family);
                
            //     $class[] = $normalized_name;
                
            //     if(count($font->variants)>1){
            //         $class[] = "has-variant";
            //     }
            //     if(count($font->subsets)>1){
            //         $class[] = "has-subsets";
            //     }
            //     $google_fonts[$normalized_name]=$font->family;
            // }
        ?>
        <?php echo $google_fonts_preview_out(); ?>
        <?php if(false): ?>
        
        <div class="row cats-row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <b>How Google font looks like? check </b> <a href="https://fonts.google.com/">google fonts preview</a>
            </div>
        </div>
        <?php endif;//end false ?>
        <?php //echo $html_out('list_name_font',$google_fonts,$list_name_font,'Title (Font Style)'); ?>
        <?php //echo $html_out('title_font',$google_fonts,$title_font,'Service Categories (Font Style)'); ?>
        <?php //echo $html_out('price_font',$google_fonts,$price_font,'Price (Font Style)'); ?>
        <?php //echo $html_out('desc_font',$google_fonts,$desc_font,'Description (Font Style)'); ?>
          </div>
        <?php if(false): ?>
          
        <div class="row cats-row">
            <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 lbl">
                <label for="list_name_font">Title (Font Style)</label>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                <?php echo $html_out('list_name_font',$google_fonts,$list_name_font); ?>
            </div>
        </div> <!-- List Name Font -->

        <div class="row cats-row">
            <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 lbl">
                <label for="title_font">Service Categories (Font Style)</label>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                <?php echo $html_out('title_font',$google_fonts,$title_font); ?>
            </div>
        </div> <!-- Title Font -->
        <div class="row cats-row">
            <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 lbl">
                <label for="price_font">Price (Font Style)</label>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                <?php echo $html_out('price_font',$google_fonts,$price_font); ?>
            </div>
        </div> <!-- Price Font -->
        <div class="row cats-row">
            <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 lbl">
                <label for="desc_font">Description (Font Style)</label>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                <?php echo $html_out('desc_font',$google_fonts,$desc_font); ?>
            </div>
         <!-- Description Font -->
        
   
 
 
  
        <?php endif;//end false ?>
        <div id="category-row-template" style="display:none;float: left;width: 100%;max-width: 900px;">
            <?php 
            echo category_row(0,$init_cat,$max_service_count); 
            ?>
        </div> <!-- category-row-template -->

        <div id="category-rows-wrapper" style="float: left;width: 100%;max-width: 900px;">
            <?php 
                $cats=$cats_data['category'];
                foreach ($cats as $cat_id => $cat) {
                    // $cat_name=$cat['name'];
                    echo category_row($cat_id,$cat,$max_service_count);
                    // unset($cat['name']);//remove the name items, so, we can use foreach to process 
                    // foreach ($cat as $service_id => $service) {
                    //     echo category_row($cat_id,$service_id,$cat_name);
                    // }
                }
            ?>
        </div> <!-- category-rows-wrapper -->
        <div class="row " style="clear:both">
            <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 add-category-row-lbl" style="width:23%">
                <a href="javascript:void(0);" id="add-category-row" class="add-category-row" onclick="add_category(this,<?php echo $max_cat_count; ?>)">Add Category [+] </a>
			</div>
        </div>
        <input type="hidden" name="field_id" class="form-control" value="<?php echo $id; ?>">
        <?php wp_nonce_field( 'spl_nonce' ); ?>
        <?php submit_button( __( 'Save', 'spl' ), 'primary', 'submit_tabs' ); ?>
    
    </div>
    </form>
	<?php 
	if($id=='' || $id!=''){ 
	if($opt['result']=='success'){

	?>
	<div class="flip_accordian"><span class="accordian-menu">Restore<i class="fa fa-arrow-down ar_backup" aria-hidden="true"></i><i class="fa fa-arrow-up ar_backup" aria-hidden="true" style="display:none"></i></span>
	
	<div class="flip_accordian_content">
	<form class="custom-backup-restore <?php echo $AddClass; ?> panel_accordian" method="post" action="<?php echo site_url()?>/wp-admin/admin.php?page=backup-restore.php" enctype="multipart/form-data">
	<input type="hidden" name="list_id" value="<?php echo $id; ?>">
	<input type="file" name="importtocsv" id="fileupload">
	<button type="submit" name="restore" value="restore" class="button button-primary">Restore</button>
	</form>
	</div>
	
	</div>
	<?php 
	//endif;
	}
	}
	?>
	</div>
	<!---// INNER FORM IN ONE ROW --->
	<?php if($id!=''){ 
	if($opt['result']=='success'){
	$AddClass='';
	?>
	<div class="flip_accordian"><span class="accordian-menu">Backup<i class="fa fa-arrow-down ar_backup" aria-hidden="true"></i><i class="fa fa-arrow-up ar_backup" aria-hidden="true" style="display:none"></i></span>
	
	<div class="flip_accordian_content">
	<form class="panel_accordian" method="post" action="<?php echo site_url()?>/wp-admin/admin.php?page=backup-restore.php">
	<input type="hidden" name="list_id" value="<?php echo $id; ?>">
	<button type="submit" name="backup" value="backup" class="button button-primary">Backup</button>
	</form>
	</div>
	</div>
	<?php } ?>
    <div id="flip">Preview List<i class="fa fa-arrow-down ar" aria-hidden="true"></i><i class="fa fa-arrow-up ar" aria-hidden="true" style="display:none"></i></div>
        <div id="panel"><?php echo do_shortcode('[pricelist id="'.$_REQUEST["id"].'"]');?></div>
    <?php } 
	?>
</div>
<?php 
  include_once dirname(__FILE__) . '/logo-footer.php';
?>
<script> 
jQuery(document).ready(function(){
    jQuery("#flip").click(function(){
        jQuery("#panel").slideToggle("slow");
    jQuery('.ar').toggle();
    //jQuery('.ar').toggle();
    });
    
    //// Accordin 
    jQuery('.accordian-menu').click(function(){
          
            jQuery(this).parent().children('.flip_accordian_content').slideToggle("slow");
            jQuery(this).children('.ar_backup').toggle();
    });
});
</script>
<script>
jQuery(document).ready(function(){ 
    var error_show='<p class="error custom_error" style="color:red">Please Select min 8px font size!</p>';
	jQuery('.remove-category').click(function(){
		jQuery(this).closest('.category-row').remove();
	});
	
	
	var data=jQuery('input[name=toggle_all_tab]:checked').val();
	if(data==0){
			jQuery("#sel1 option[value='']").remove();
		}
	$(".toggle_all_tab").change(function(){
		var data=jQuery(this).val();
		if(data==0){
			jQuery("#sel1 option[value='']").remove();
		}
	});
	jQuery('.advance_setting').click(function(){
		jQuery('.more-stng-btn').toggleClass('more-stng-btn-rotate');
		jQuery('.more_setting').toggle();
	});
	jQuery("select[name='title_font_size']").change(function(){
	    var title= jQuery(this).val();
	        title = title.replace("px", "");
	        title=parseInt(title);
	        if(title<8){
	            jQuery('.custom_error').remove();
	            jQuery(error_show).insertAfter("select[name='title_font_size']");
	            //jQuery(':input[name="submit_tabs"]').prop('disabled', true);
	        }else{
	            jQuery('.custom_error').remove();
	            //jQuery(':input[name="submit_tabs"]').prop('disabled', false);
	        }
	});
	jQuery("select[name='tab_font_size']").change(function(){
	    var category= jQuery(this).val();
	        category = category.replace("px", "");
	        category=parseInt(category);
	        if(category<8){
	            jQuery('.custom_error').remove();
	            jQuery(error_show).insertAfter("select[name='tab_font_size']");
	            //jQuery(':input[name="submit_tabs"]').prop('disabled', true);
	        }else{
	            jQuery('.custom_error').remove();
	            //jQuery(':input[name="submit_tabs"]').prop('disabled', false);
	        }
	});
	jQuery("select[name='service_font_size']").change(function(){
	    var service= jQuery(this).val();
	        service = service.replace("px", "");
	        service=parseInt(service);
	        if(service<8){
	            jQuery('.custom_error').remove();
	            jQuery(error_show).insertAfter("select[name='service_font_size']");
	            //jQuery(':input[name="submit_tabs"]').prop('disabled', true);
	        }else{
	            jQuery('.custom_error').remove();
	            //jQuery(':input[name="submit_tabs"]').prop('disabled', false);
	        }
	});
	jQuery("select[name='service_price_font_size']").change(function(){
	    var price= jQuery(this).val();
	        price = price.replace("px", "");
	        price=parseInt(price);
	        if(price<8){
	            jQuery('.custom_error').remove();
	            jQuery(error_show).insertAfter("select[name='service_price_font_size']");
	            //jQuery(':input[name="submit_tabs"]').prop('disabled', true);
	        }else{
	            jQuery('.custom_error').remove();
	            //jQuery(':input[name="submit_tabs"]').prop('disabled', false);
	        }
	});
});
</script>