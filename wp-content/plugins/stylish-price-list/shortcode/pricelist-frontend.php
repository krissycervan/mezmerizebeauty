<?php 

$cats=array();
$fonts=array();

$list_name_font='';
$title_font='';
$price_font='';
$desc_font='';
$default_tab_size=''; 
if(!empty($id)){
	$shortcode_id=isset($id) ? $id : '';
    $cats_data=spl_get_option($id);
    //echo "<pre>";
    //print_r($cats_data);
    //echo "</pre>";
	$style_cat_tab_btn=isset($cats_data['style_cat_tab_btn']) ? $cats_data['style_cat_tab_btn'] : '';
	$all_tab = isset($cats_data['all_tab']) ? $cats_data['all_tab'] : '';
	$style = isset($cats_data['tab_style']) ? $cats_data['tab_style'] : '';
    $default = isset($cats_data['default_tab']) ? $cats_data['default_tab'] : '';
    $list_name=remove_slash_quotes($cats_data['list_name']);
    $hover_color=isset($cats_data['hover_color']) ? $cats_data['hover_color'] : '';
    $title_color=isset($cats_data['title_color']) ? $cats_data['title_color'] : '';
    $title_color_top=isset($cats_data['title_color_top']) ? $cats_data['title_color_top'] : '';
    $price_color=isset($cats_data['price_color']) ? $cats_data['price_color'] : '';
    $title_size=isset($cats_data['title_font_size']) ? $cats_data['title_font_size'] : '';
    $tab_size=isset($cats_data['tab_font_size']) ? $cats_data['tab_font_size'] : '';
    $service_size=isset($cats_data['service_font_size']) ? $cats_data['service_font_size'] : '';
    $default_tab_size=isset($cats_data['default_tab_font_size']) ? $cats_data['default_tab_font_size'] : '';
    $service_color=isset($cats_data['service_color']) ? $cats_data['service_color'] : '';
    $select_price=isset($cats_data['service_price_font_size']) ? $cats_data['service_price_font_size'] : '';

    $list_name_font=isset($cats_data['list_name_font']) ? $cats_data['list_name_font'] : '';
    $title_font=isset($cats_data['title_font']) ? $cats_data['title_font'] : '';
    $price_font=isset($cats_data['price_font']) ? $cats_data['price_font'] : '';
    $desc_font=isset($cats_data['desc_font']) ? $cats_data['desc_font'] : '';
    $toggle=isset($cats_data['toggle']) ? $cats_data['toggle'] : '';
	$toggle_all_tab=isset($cats_data['toggle_all_tab']) ? $cats_data['toggle_all_tab'] : '';
	$price_list_desc=isset($cats_data['price_list_desc']) ? $cats_data['price_list_desc'] : '';
	
	$brack_title_desktop=isset($cats_data['brack_title_desktop']) ? $cats_data['brack_title_desktop'] : '';
	$brack_title_tablets=isset($cats_data['brack_title_tablets']) ? $cats_data['brack_title_tablets'] : '';

    $fonts['list_name_font']['family']=$list_name_font;
    $fonts['title_font']['family']=$title_font;
    $fonts['price_font']['family']=$price_font;
    $fonts['desc_font']['family']=$desc_font;

    //convert family like 'Dancing-Script' to DancingScript
    $list_name_font=str_replace("-", " ", $list_name_font);
    $title_font=str_replace("-", " ", $title_font);
    $price_font=str_replace("-", " ", $price_font);
    $desc_font=str_replace("-", " ", $desc_font);

    $opt_cats=$cats_data['category'];
    foreach ($opt_cats as $cat_id => $cat) {
		
        $cat_name=remove_slash_quotes($cat['name']);
        unset($cat['name']);//remove the name items, so, we can use foreach to process 
		$cat_description=remove_slash_quotes($cat['description']);
        unset($cat['description']);//remove the name items, so, we can use foreach to process 
        $services=array();
        foreach ($cat as $service_id => $service) {
            $services[$service_id]['name']=remove_slash_quotes($service['service_name']);
            $services[$service_id]['price']=remove_slash_quotes($service['service_price']);
            $services[$service_id]['desc']=remove_slash_quotes($service['service_desc']);
			$services[$service_id]['service_url']=remove_slash_quotes($service['service_url']);
        }
        $cats[$cat_id]['name']=remove_slash_quotes($cat_name);
		$cats[$cat_id]['description']=remove_slash_quotes($cat_description);
        $cats[$cat_id]['services']=$services;
    }
}
global $spl_googlefonts_var;
$spl_googlefonts_var->enqueue_fonts_style($fonts);//load google fonts css

if(!function_exists('output_service')){
    function output_service($service){
        extract($service);
        if(empty($name)){
          return;
        }
        ob_start();
        ?>
       <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 name-price-desc">
           <div class="row name-price">
               <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                   <?php if(!empty($service['service_url'])){ ?>
                   <a href="<?php echo $service['service_url']; ?>"><?php echo output_a_tag($name,'','name a-tag'); ?></a>
				   <?php } else{ ?>
					   <?php echo output_a_tag($name,'','name a-tag'); ?>
				  <?php }?>
               </div>
               <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                   <?php echo output_a_tag($price,'','spl-price a-tag'); ?>
               </div>
           </div>
           <div class="row desc">
               <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                   <?php echo output_a_tag($desc,'','desc a-tag'); ?>
               </div>
           </div>

           <div class="row liner">
           </div>
       </div>
        <?php
        $html=ob_get_clean();
        return $html;
    }//end output_service() 
}//end if !function_exists('output_service')
//break sercive
if(!function_exists('output_service_break')){
    function output_service_break($service){
        extract($service);
        if(empty($name)){
          return;
        }
        ob_start();
        ?>
       <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 name-price-desc">
           <div class="row name-price">
               <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10 custom_line">
                   <?php if(!empty($service['service_url'])){ ?>
                   <a href="<?php echo $service['service_url']; ?>"><?php echo output_a_tag($name,'','name a-tag'); ?></a>
				   <?php } else{ ?>
					   <?php echo output_a_tag($name,'','name a-tag'); ?>
				  <?php }?>
				  <span class="style-4-border style-4-width break_service"></span>
               </div>
               
               <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 style4_break_price">
                   <?php echo output_a_tag($price,'','spl-price a-tag'); ?>
               </div>
           </div>
           <div class="row desc">
               <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                   <?php echo output_a_tag($desc,'','desc a-tag'); ?>
               </div>
           </div>

           <div class="row liner">
           </div>
       </div>
        <?php
        $html=ob_get_clean();
        return $html;
    }//end output_service() 
}//end if !function_exists('output_service')

//End break Service
//Start output service for style 3
if(!function_exists('output_service_style3')){
    function output_service_style3($service){
        extract($service);
        if(empty($name)){
          return;
        }
        ob_start();
        ?>
		<div class="internal-box">
           <div class="row name-price">
               <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
			       <?php if(!empty($service['service_url'])){ ?>
                   <a href="<?php echo $service['service_url']; ?>"><?php echo output_a_tag($name,'','name a-tag'); ?></a>
				   <?php } else{ ?>
					   <?php echo output_a_tag($name,'','name a-tag'); ?>
				  <?php }?>
               </div>
               <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                   <?php echo output_a_tag($price,'','spl-price a-tag'); ?>
               </div>
           </div>
           <div class="row desc">
               <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                   <?php echo output_a_tag($desc,'','desc a-tag'); ?>
               </div>
           </div>

           <div class="row liner">
           </div>
      </div>
<?php
$html=ob_get_clean();
        return $html;
    }//end output_service_style3() 
}
//Function for style4 //

if(!function_exists('output_service_style4')){
    function output_service_style4($service){
        extract($service);
        if(empty($name)){
          return;
        }
        ob_start();
        ?>
		<div class="internal-box"><div class="content-section name-price"><span class="style-4-productName style-4-width"><?php if(!empty($service['service_url'])){ ?><a href="<?php echo $service['service_url']; ?>"><?php echo output_a_tag($name,'','name a-tag'); ?></a><?php } else{ ?><?php echo output_a_tag($name,'','name a-tag'); ?><?php }?></span> <span class="style-4-border"></span><span class="style-4-productPrice style-4-width"> <?php echo output_a_tag($price,'','spl-price a-tag'); ?></span></div><span class="row desc"><?php echo output_a_tag($desc,'','desc a-tag'); ?></span></div>
<?php
$html=ob_get_clean();
        return $html;
    }//end output_service_style4() 
}	 
//End function for style4//

if(!function_exists('output_a_tag')){
    function output_a_tag($text,$id='',$class=''){
    ob_start();
    ?>
    <div class="<?php echo $class; ?>"><?php echo $text; ?></div>
    <?php
    $html=ob_get_clean();
        return $html;
    }//end output_a_tag() 
}//end if !function_exists('output_a_tag')
if(!function_exists('output_tab_contents')){
    function output_tab_contents($cats, $default, $shortcode_id){
        ob_start();
        ?>
        <?php 
            $all_services=array();
            foreach ($cats as $key => $cat){
                $services=$cat['services'];
                foreach ($services as $key => $service){
                    $name=$service['name'];
                    /*
                    I don't agree with you. There is many times that the service name has to be the same. With massage therapy, you can have Deep Tissue Masasge, and many different duration (time) of this one service. Example: 1 hour, 2 hour, 3 hour.
                    */
                    // $id=get_id_name($name);
                    // $all_services[$id]=$service;
                    $all_services[]=$service;
                } 
            }
         
        ?>
       <div class="tab <?php echo ($default) ? '' : 'active';?>" id="all_<?php echo $shortcode_id; ?>" style="<?php echo ($default) ? 'display:none' : 'display:block';?>">
       
        <?php foreach ($all_services as $key => $service){
            echo output_service($service);
        } 
        ?>
        
       </div>

        <?php foreach ($cats as $key => $cat): ?>
        <?php 
           $name=html_entity_decode($cat['name']);
            $id=get_id_name(html_entity_decode($name));
            $services=$cat['services'];
            // if(!empty($services)){
//echo get_id_name($default);
            // }
            if($default == $key)
            {
                $act_tab = "active" ;
                $style_act = "display:block";
            }
            else
            {
                $act_tab = "";  
                $style_act = "display:none";
            }
        ?>
           <div class="tab <?php echo $act_tab;?>" id="<?php echo $key.'_'.$shortcode_id; ?>" style="<?php echo $style_act;?>">
		   <?php if($cat['description']!=''){ 
		   ?>
		   <div class="row">
		     <div class="col-sm-8 col-sm-offset-2 custom-description-section">
		        <?php echo html_entity_decode($cat['description']); ?>
			 </div>
		   </div>
		   <?php } ?>
		   <div class="row">
            <?php foreach ($services as $key => $service){
                echo output_service($service);
            } 
            ?>
            </div>
           </div>
        <?php endforeach ?>
        <?php
        $html=ob_get_clean();
        return $html;
    }//end output_tab_contents() 
}//end if !function_exists('output_tab_contents')
if(!function_exists('output_tabs')){
    function output_tabs($cats, $default, $shortcode_id){
        ob_start();
        ?>
        <?php foreach ($cats as $key => $cat): ?>
        <?php 
            $name=$cat['name'];
			$description=$cat['description'];
            $id=get_id_name(html_entity_decode($name));
            
            
             $name1=html_entity_decode($cat['name']);
            $id1=get_id_name(html_entity_decode($name1));
            if($default == $key)
            {
                $act_tab = "active default" ;
            }
            else
            {
                $act_tab = "";  
            }
            
            
            
            // $services=$cat->services;
            // if(!empty($services)){

            // }echo "++";
//echo "++";            echo $default;echo "++";
            if(strtolower($default)==strtolower($name)){$act="active";} else{$act="";}
        ?>
           <li class="<?php echo $act_tab; if($name == ''){echo " hidden"; }?>">
              <a href="#<?php echo $key.'_'.$shortcode_id; ?>" ><?php echo html_entity_decode($name); ?></a>
           </li>
        <?php endforeach ?>
        <?php
        $html=ob_get_clean();
        return $html;
    }//end output_tabs() 
}//end if !function_exists('output_tabs')

if(!function_exists('get_id_name')){
    function get_id_name($in){
        $in=strtolower(trim($in));
        $out=preg_replace('/[^\w]+/','-',$in);

        return $out;
    }//end get_id_name() 
}//end if !function_exists('get_id_name')

/**********Function for second style************/
if(!function_exists('output_tab_contents_second_style')){
    function output_tab_contents_second_style($cats, $default, $shortcode_id){
    foreach ($cats as $key => $cat){
		$services=$cat['services'];
	?>	
	<h3 class="head-title tab-links_spl"><?php echo html_entity_decode($cat['name']); ?></h3>
	<?php if($cat['description']){ ?>
	<div class="cat_descreption row"><div class="col-sm-6"><?php echo html_entity_decode($cat['description']); ?></div></div>
	<?php } ?>
	<div class="row">
	<?php 
		foreach ($services as $key => $service){
					echo output_service($service);
		} ?>
    </div>    		
	<?php
    } ?>
    <?php }//end get_id_name() 
}
/**********End Function for second style************/
/**********Start Function for Third style*****************/
if(!function_exists('output_tab_contents_third_style')){
    function output_tab_contents_third_style($cats, $default, $shortcode_id){
		?>
		<!---row masonry -->
		<div class="masonary-section" id="main_<?php echo $shortcode_id; ?>" role="main">
		    <ul id="tiles_<?php echo $shortcode_id; ?>">
		<?php
    foreach ($cats as $key => $cat){
		$services=$cat['services'];
	?>
	 
        <!-- These are our grid blocks -->
        <li>
<div class="name-price-desc for-style-3">	
	<h3 class="head-title tab-links_spl head_title_style_3"><?php echo html_entity_decode($cat['name']); ?></h3>
	 <?php if($cat['description']){ ?>
	<div class="cat_descreption row"><div class="style3_cat_desc"><?php echo html_entity_decode($cat['description']); ?></div></div>
	<?php } ?>
	<?php 
		foreach ($services as $key => $service){
					echo output_service_style3($service);
		} ?>
    </div>  
    </li>
	<?php
    } ?>
    </ul>
	</div>
	
    <?php }//end get_id_name() 
}
/**********End Function for Third style*****************/
/**********Start Function For 4 style*******************/
if(!function_exists('output_tab_contents_fourth_style')){
    function output_tab_contents_fourth_style($cats, $default, $shortcode_id){
		?>
		<!---row masonry -->
		<ul id="tiles">
		<?php
    foreach ($cats as $key => $cat){
		$services=$cat['services'];
	?>
	 
        <!-- These are our grid blocks -->
   <li>
<div class="name-price-desc for-style-4 style-4-half"><h3 class="head-title tab-links_spl head_title_style_3"><?php echo html_entity_decode($cat['name']); ?></h3><?php if($cat['description']){ ?><div class="cat_descreption row"><div class="style4_cat_desc"><?php echo html_entity_decode($cat['description']); ?></div></div>
<?php } ?><?php foreach ($services as $key => $service){echo output_service_style4($service); } ?></div></li><?php } ?></ul>
	
    <?php }//end get_id_name() 
}
/**********End Function For 4 style*********************/
/**********Function for 4 style break service************/
if(!function_exists('output_tab_contents_4_style_break')){
    function output_tab_contents_4_style_break($cats, $default, $shortcode_id){
    foreach ($cats as $key => $cat){
		$services=$cat['services'];
	?>	
	<h3 class="head-title tab-links_spl"><?php echo html_entity_decode($cat['name']); ?></h3>
	<?php if($cat['description']){ ?>
	<div class="cat_descreption row"><div class="col-sm-6"><?php echo remove_slash_quotes($cat['description']); ?></div></div>
	<?php } ?>
	<div class="row">
	<?php 
		foreach ($services as $key => $service){
					echo output_service_break($service);
		} ?>
    </div>    		
	<?php
    } ?>
    <?php }//end get_id_name() 
}
/**********End Function for 4 style break service************/
?>
<?php
 if($style=='with_tab' || $style==''){ ?>
<div class="body-inner container-fluid price_wrapper" id="spl_<?php echo $id; ?>" style="max-width:1200px;margin-left:auto;margin-right:auto; ">
    <div class="head-title">
      <span><?php echo $list_name; ?></span>
    </div>
	<?php if($price_list_desc!=''){?>
	<div class="col-sm-8 col-sm-offset-2 desc_price_list"><?php echo $price_list_desc; ?></div>
	<?php } ?>
    <div class="tabs_spl">
       <!-- Nav tabs -->
       
         <ul class="tab-links_spl" >
         <?php if($all_tab!='' && $toggle_all_tab==1){
						
			 ?>
             <li class="<?php echo ($default) ? '' : 'active';?>">
			
                 <a href="#all_<?php echo $id; ?>"><?php echo $all_tab; ?></a>
             </li>
			 
		 <?php }
               if($all_tab=='' && $toggle_all_tab==''){
						
			 ?>
             <li class="<?php echo ($default) ? '' : 'active';?>">
		 
                 <a href="#all_<?php echo $id; ?>">All</a>
             </li>
		 <?php } 		 
		 echo output_tabs($cats,$default,$id); ?>
         </ul>
     
   
       <!-- Tab panes -->
       <div class="tab-content1">
        <?php echo output_tab_contents($cats, $default, $id); ?>
       </div>
   </div>   
</div>
<?php }
 if($style=='without_tab'){ 
 ?>
<div class="body-inner container-fluid price_wrapper without_tab" id="spl_<?php echo $id; ?>" style="max-width:1200px;margin-left:auto;margin-right:auto;">
 <?php echo output_tab_contents_second_style($cats, $default, $shortcode_id); ?>
 </div>
<?php } 
// Start style 3 design////
if($style=='style_3'){ ?>
<div class="body-inner container-fluid price_wrapper" id="spl_<?php echo $id; ?>" style="max-width:1200px;margin-left:auto;margin-right:auto;">
<div class="head-title">
      <span><?php echo $list_name; ?></span>
</div>
<?php if($price_list_desc!=''){?>
	<div class="col-sm-8 col-sm-offset-2 desc_price_list"><?php echo $price_list_desc; ?></div>
	<?php } ?>
<?php echo output_tab_contents_third_style($cats, $default, $shortcode_id); ?>
</div>
<?php }
// End style 3 design////


//Start style 4 design////
if($style=='style_4'){ ?>
<div class="body-inner container-fluid price_wrapper custom-style-4" id="spl_<?php echo $id; ?>" style="max-width:1200px;margin-left:auto;margin-right:auto;">
<div class="head-title">
      <span><?php echo $list_name; ?></span>
</div>

      <?php 
           if($brack_title_desktop=='' && $brack_title_tablets==''){
            echo output_tab_contents_fourth_style($cats, $default, $shortcode_id);
           }
           if($brack_title_desktop==1 && $brack_title_tablets==1){
               echo output_tab_contents_4_style_break($cats, $default, $shortcode_id);
           }
 
           if($brack_title_desktop==1 && $brack_title_tablets==''){ ?>
           <div class="brack_title_desktop"><?php echo output_tab_contents_4_style_break($cats, $default, $shortcode_id); ?></div>
           <div class="brack_title_tablets"><?php echo output_tab_contents_fourth_style($cats, $default, $shortcode_id); ?></div>
               
          <?php  } 
           if($brack_title_desktop=='' && $brack_title_tablets==1){ ?>
           <div class="brack_title_desktop_tab"><?php echo output_tab_contents_fourth_style($cats, $default, $shortcode_id); ?></div>
           <div class="brack_title_tablets_tab"><?php echo output_tab_contents_4_style_break($cats, $default, $shortcode_id); ?></div>
               
          <?php  }
          ?>
 </div>
<!----/// MAIN CONTAINER SECTION END --->
<?php }

?>
<!--AK Style -->
<style type="text/css">
<?php if(!empty($service_size)): ?>
   #spl_<?php echo $id; ?>.price_wrapper .name.a-tag {
     font-size: <?php echo $service_size; ?> !important; 
   }
<?php endif;//end !empty($tab_size) ?>
<?php if(!empty($tab_size)): ?>
   #spl_<?php echo $id; ?>.price_wrapper ul.tab-links_spl, #spl_<?php echo $id; ?>.price_wrapper h3.tab-links_spl {
     font-size: <?php echo $tab_size; ?> !important; 
   }
<?php endif;//end !empty($tab_size) ?>
<?php if(!empty($tab_size)): ?>
   #spl_<?php echo $id; ?>.price_wrapper ul.tab-links_spl li a, #spl_<?php echo $id; ?>.price_wrapper h3.tab-links_spl {
     font-size: <?php echo $tab_size; ?> !important;
     padding-right:5px!important;
     padding-left:5px!important;
     text-transform: none !important;	 
   }
   #spl_<?php echo $id; ?>.price_wrapper .tabs_spl ul.tab-links_spl li:before{
       font-size: <?php echo $tab_size; ?> !important;
   }
<?php endif;//end !empty($tab_size) ?>
<?php if(!empty($title_size)): ?>
  #spl_<?php echo $id; ?>.price_wrapper .head-title span {
    font-size: <?php echo $title_size; ?> !important;  
  }
 <?php endif;//end !empty($title_size) ?>
<?php if(!empty($title_font)): ?>
  #spl_<?php echo $id; ?>.price_wrapper .head-title span{
    font-family: "<?php echo $list_name_font; ?>" !important;
  }
<?php endif;//end !empty($list_name_font) ?>

<?php if(!empty($title_font)): ?>
  #spl_<?php echo $id; ?>.price_wrapper .tabs_spl .tab-links_spl li {
      line-height: "<?php echo $title_font; ?>" !important;
  }
  #spl_<?php echo $id; ?>.price_wrapper .tabs_spl .tab-links_spl li a, 
  #spl_<?php echo $id; ?>.price_wrapper .name-price-desc .spl-price.a-tag, #spl_<?php echo $id; ?>.price_wrapper .name-price-desc .name.a-tag{
    font-family: "<?php echo $title_font; ?>" !important;
  }
  
<?php endif;//end !empty($title_font) ?>

<?php if(!empty($price_font)): ?>
  #spl_<?php echo $id; ?>.price_wrapper .name-price-desc .spl-price.a-tag {
    font-family: "<?php echo $price_font; ?>" !important;
  }
<?php endif;//end !empty($price_font) ?>

<?php if(!empty($desc_font)): ?>
  #spl_<?php echo $id; ?>.price_wrapper .name-price-desc .desc.a-tag{
    font-family: "<?php echo $desc_font; ?>" !important;
font-size: 95%;
  }
<?php endif;//end !empty($title_font) ?>

<?php if(!empty($title_color)): ?>
  #spl_<?php echo $id; ?>.price_wrapper .tabs_spl .tab-links_spl li a, #spl_<?php echo $id; ?>.price_wrapper h3.tab-links_spl, #spl_<?php echo $id; ?>.price_wrapper .name-price-desc .spl-price.a-tag{
	  <?php if($style=='without_tab' || $style=='style_4'){ ?>
    color: <?php echo $title_color; ?> !important;
    font-family: "<?php echo $title_font; ?>" !important;
	  <?php } 
	  if(($style=='with_tab' || $style=='') && $style_cat_tab_btn==1){
	  ?>
	  color: #fff !important;
	  <?php } 
	  if(($style=='with_tab' || $style=='') && $style_cat_tab_btn==0){
	  ?>
          /* If Stylish Buttton is off */
	  color: <?php echo $title_color; ?>!important;
	  <?php }
		if($style=='style_3'){ ?>
		color: #fff !important;
		<?php }
	  ?>
  }
<?php endif;//end !empty($title_color) ?>

<?php if(!empty($service_color)): ?>
  #spl_<?php echo $id; ?>.price_wrapper .name-price-desc .name.a-tag{
    color: <?php echo $service_color; ?> !important;
  }
<?php endif;//end !empty($service_color) ?>

<?php if(!empty($price_color)): ?>
  #spl_<?php echo $id; ?>.price_wrapper .name-price-desc .spl-price.a-tag {
    color: <?php echo $price_color; ?> !important;; 
  }
<?php endif;//end !empty($price_color) ?>

<?php if(!empty($hover_color)): ?>
  #spl_<?php echo $id; ?>.price_wrapper .tabs_spl .tab-links_spl li a:hover{
    color: <?php echo $hover_color; ?> !important;
    border-bottom: 1px solid <?php echo $hover_color; ?> !important;
    text-decoration: none !important;
  }
  #spl_<?php echo $id; ?>.price_wrapper h3.tab-links_spl:hover {
	  color: <?php echo $hover_color; ?> !important;
  }
  #spl_<?php echo $id; ?>.price_wrapper .tabs_spl ul.tab-links_spl li:before { color: <?php echo $hover_color; ?> !important; }

  #spl_<?php echo $id; ?>.price_wrapper .name-price-desc .spl-price.a-tag:hover, #spl_<?php echo $id; ?>.price_wrapper .name-price-desc .spl-price.a-tag:focus, 
  #spl_<?php echo $id; ?>.price_wrapper .name-price-desc .name.a-tag:hover, #spl_<?php echo $id; ?>.price_wrapper .name-price-desc .name.a-tag:focus {
    color: <?php echo $hover_color; ?> !important; 
  }
  #spl_<?php echo $id; ?>.price_wrapper ul.tab-links_spl li.active a {
    border-bottom: 1px solid <?php echo $hover_color; ?> !important;
    color: <?php echo $hover_color; ?> !important;
  }
<?php endif;//end !empty($hover_color) ?>
<?php if(!empty($default_tab_size)):?>
    #spl_<?php echo $id; ?>.price_wrapper .tabs_spl .tab-links_spl li.active.default {
        line-height: <?php echo $default_tab_size; ?> !important;
    }
    #spl_<?php echo $id; ?>.price_wrapper .tabs_spl .tab-links_spl li.default a {
        line-height:  <?php echo $default_tab_size; ?> !important;
        font-size: <?php echo $default_tab_size; ?> !important;
    }
<?php endif;//end !empty($default)?>
<?php if(!empty($service_color)):?>
    /*.price_wrapper .desc.a-tag {
        color: <?php echo $service_color; ?> !important;
     }*/
<?php endif;// end !empty($service_color)?>
<?php if(!empty($title_color_top)):?>
    #spl_<?php echo $id; ?>.price_wrapper .head-title span  {
        color: <?php echo $title_color_top; ?> !important;
     }
<?php endif;// end !empty($title_color_top)?>
<?php if(!empty($select_price)):?>
#spl_<?php echo $id; ?>.price_wrapper .spl-price.a-tag {
    font-size: <?php echo $select_price; ?> !important;

}
<?php endif;//!empty($title_color_top)?>
<?php if($toggle==1):?>
#spl_<?php echo $id; ?>.price_wrapper .tabs_spl ul.tab-links_spl li:before {
    font-family: FontAwesome !important;
    font-weight: normal !important;
    font-style: normal !important;
    display: inline-block !important;
    text-decoration: inherit !important;
    content: "\F105" !important;
    position: absolute !important;
    left: -5px !important;
}
<?php endif;//($toggle==1)?>
<?php if($toggle==0 || $toggle=''):?>
#spl_<?php echo $id; ?>.price_wrapper .tabs_spl ul.tab-links_spl li:before {
    font-family: FontAwesome !important;
    font-weight: normal !important;
    font-style: normal !important;
    display: inline-block !important;
    text-decoration: inherit !important;
    /*content: "\F105" !important;*/
    position: absolute !important;
    left: 0 !important;
}
<?php endif;//($toggle==1)?>
#spl_<?php echo $id; ?>.price_wrapper .tabs_spl .tab-links_spl li.active a {
    <?php if(($style=='with_tab') && $style_cat_tab_btn==1 ){ ?>
    font-weight: bold !important;
    color: #fff !important;
    <?php } ?>
}
.custom-description-section {
    text-align: center;
padding-bottom:30px;
color: #999;
}
.without_tab {
    clear: both;
    padding-top: 20px;
}
h3.head-title {
    margin: 15px 0px;
}

#spl_<?php echo $id; ?>.price_wrapper ul.tab-links_spl li{
	    padding: 2px 5px !important;
}

/******************* IF STYLE=1 and Stylish Button = On ********/
#spl_<?php echo $id; ?>.price_wrapper ul.tab-links_spl li a{
	<?php if(($style=='with_tab') && $style_cat_tab_btn==1 ){ ?>  
	background-color: <?php echo $title_color; ?> !important ;
    padding: 5px 70px;
    font-size: 16px;
    border-radius: 5px !important;
	<?php } ?>
}
#spl_<?php echo $id; ?>.price_wrapper .for-style-3 h3.head_title_style_3 {
	<?php if($style=='style_3'){ ?>
    background-color: <?php echo $title_color_top; ?> !important ;
    border-radius: 8px 11px 0px 0px !important;
        padding: 12px !important;
margin-top: 0px !important;
    text-align: center;
	<?php } ?>
}
<?php if($style=='style_4'){ ?>
ul#tiles_<?php echo $id; ?> {
    height: inherit !important;
}
<?php } ?>
/*
Style 
*/

#tiles_<?php echo $id; ?> {
list-style-type: none;
position: relative;
margin: 0;
}

#tiles_<?php echo $id; ?> li {
width: 350px;
-moz-border-radius: 2px;
-webkit-border-radius: 2px;
border-radius: 2px;
display: none; 
  cursor: pointer;
padding: 4px;
}
#tiles_<?php echo $id; ?> ali:nth-child(3n) {
height: 175px;
}

#tiles_<?php echo $id; ?> ali:nth-child(4n-3) {
padding-bottom: 30px;
}

#tiles_<?php echo $id; ?> ali:nth-child(5n) {
height: 250px;
}
#main_<?php echo $id; ?> {
padding: 30px 0 30px 0;
}

#main_<?php echo $id; ?> {
    padding: 30px 0 30px 0;
   
}
.masonary-section ul {
    padding-left: 0px !important;
}
.masonary-section ul {
    margin: 0px !important;
}
#tiles_<?php echo $id; ?> li {
    margin: 0 auto !important;
    left: list;
    list-style-type: none;
}


</style>

  <!-- Include the plug-in -->
  
  <?php $url = plugins_url();  ?>
  <script src= "<?php echo $url; ?>/stylish-price-list/assets/js/jquery.wookmark.js?ver=1.2"></script>
  
  <script type="text/javascript">
jQuery(document).ready(new function() {
      var width= jQuery( window ).width(); 
      if(width > 1024){ 
          jQuery('.brack_title_tablets').remove();
      }else{
          jQuery('.brack_title_desktop').remove();
      }
      
      if(width > 1024){ 
          jQuery('.brack_title_tablets_tab').remove();
      }else{
          jQuery('.brack_title_desktop_tab').remove();
      }
    /// Resize 

    
     var shortcodeid= "_<?php echo $id; ?>";
     jQuery('#tiles'+shortcodeid+' li').wookmark({
        autoResize: true, 
        container: jQuery('#tiles'+shortcodeid),
        offset: 2, 
        itemWidth: 360 ,
        flexibleWidth: '50%'
      });
      
       jQuery(window).trigger('resize');
       
/*Fixed border line frontend*/

  
setTimeout(function(){
jQuery('.for-style-4 .internal-box').each(function(){
    
   var getLeftWidth = jQuery(this).children().children('.style-4-productName').width();
   var getRightWidth = jQuery(this).children().children('.style-4-productPrice').width();
   // Get Parent Height
   var getLeftHeight = jQuery(this).children().children('.style-4-productName').height();
   var getRightHeight = jQuery(this).children().children('.style-4-productPrice').height();
   var getParentHeight = jQuery(this).children('.content-section.name-price').height();
   jQuery(this).children().children('.style-4-border').css({left:getLeftWidth,right:getRightWidth});
 
   // Give Height 
   if(getLeftHeight > getRightHeight)
   {
       console.log('Left Height is Long');
      // jQuery(this).children().children('.style-4-productName').css('height',getLeftHeight);
     //  jQuery(this).children().children('.style-4-productPrice').css('height',getLeftHeight);
   } else
   {
       console.log('Right Height is Long'); 
       //jQuery(this).children().children('.style-4-productName').css('height',getLeftHeight);
       //jQuery(this).children().children('.style-4-productPrice').css('height',getLeftHeight);
   }
   
    // jQuery(this).children().children('.style-4-border').css('margin-top',(getParentHeight/2)+2);
   
});
  jQuery('span.style-4-border').show();
 }, 1000);

/*Fixed border line frontend End */
});      
      

  </script>
		
<!--AK Style -->
