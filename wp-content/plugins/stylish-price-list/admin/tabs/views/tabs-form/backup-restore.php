<?php

function ExportCSVFile($records) {
	
 // create a file pointer connected to the output stream
 $fh = fopen( 'php://output', 'w' );
 $heading = false;
 
 if(!empty($records))
   foreach($records as $row) {
	  
 if(!$heading) {
   // output the column headings
   fputcsv($fh, array_keys($row));
   $heading = true;
 }
  $v = array_values($row);
  
 // loop over the rows, outputting them
 fputcsv($fh,$v);
 
   }
   fclose($fh);
   ob_end_flush();
   die();
}

if(isset($_POST['backup'])){
$id = $_POST['list_id'];
$cats_data=spl_get_option($id);
$data = array(
 '0' => array('List Name'=> $cats_data['list_name'], 'Tab Style' =>$cats_data['tab_style'], 'Default Tab'=>$cats_data['default_tab'], 'All Tab'=>$cats_data['all_tab'],'Toggle All Tab'=>$cats_data['toggle_all_tab'],'Toggle'=>$cats_data['toggle'],'Style Cat Tab Btn'=>$cats_data['style_cat_tab_btn'],'Price List Desc'=>$cats_data['price_list_desc'],'Title Font Size'=>$cats_data['title_font_size'],'Title Color Top'=>$cats_data['title_color_top'],'List Name Font'=>$cats_data['list_name_font'],'Tab Font Size'=>$cats_data['tab_font_size'],'Title Color'=>$cats_data['title_color'],'Title Font'=>$cats_data['title_font'],'Service Font Size'=>$cats_data['service_font_size'],'Service Color'=>$cats_data['service_color'],'Desc Font'=>$cats_data['desc_font'],'Hover Color'=>$cats_data['hover_color'],'Service Price Font Size'=>$cats_data['service_price_font_size'],'Price Color'=>$cats_data['price_color'],'Price Font'=>$cats_data['price_font'],'category'=>json_encode($cats_data['category']),'Field Id'=>$cats_data['field_id'],'ID'=>$cats_data['id']),
 );
/***export data***/
$filename = $_POST["backup"] . ".csv"; 
 header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
 header("Content-type: text/csv");
 header("Content-Disposition: attachment; filename=\"$filename\"");
 ExportCSVFile($data);

}

/****Import data****/
if(isset($_POST['restore'])){
	$dir = plugin_dir_path( __FILE__ );
	$allowed = array('csv');
    $filename = $_FILES['importtocsv']['name'];
    $ext = pathinfo($filename, PATHINFO_EXTENSION);
	if (!in_array($ext, $allowed)) {
        // show error message
       $message = 'Invalid file type, please use .CSV file!';
    }else {
         move_uploaded_file($_FILES["importtocsv"]["tmp_name"], $dir."upload-csv/" . $_FILES['importtocsv']['name']);
        $file = $dir."upload-csv/" . $_FILES['importtocsv']['name'];
         $file = fopen($file, "r");
		// echo $randnum = rand(1000000000,9999999999);
		 $file_data= array();
		 while (($emapData = fgetcsv($file, 10000, ",")) !== FALSE)
         {
			 
			 $file_data[] = $emapData;
			 //
            /*$sql = "INSERT into tableName(name,email,address) values('$emapData[0]','$emapData[1]','$emapData[2]')";
            mysql_query($sql);*/
         }
		 $catdata=json_decode($file_data[1][21],1);
		 //echo "<pre>"; print_r($catdata);
		 $rand_num=rand((int)1000000000,(int)9999999999);
		 $data = array('list_name'=>$file_data[1][0],'tab_style'=>$file_data[1][1],'default_tab'=>$file_data[1][2],'all_tab'=>$file_data[1][3],'toggle_all_tab'=>$file_data[1][4],'toggle'=>$file_data[1][5],'style_cat_tab_btn'=>$file_data[1][6],'price_list_desc'=>$file_data[1][7],'title_font_size'=>$file_data[1][8],'title_color_top'=>$file_data[1][9],'list_name_font'=>$file_data[1][10],'tab_font_size'=>$file_data[1][11],'title_color'=>$file_data[1][12],'title_font'=>$file_data[1][13],'service_font_size'=>$file_data[1][14],'service_color'=>$file_data[1][15],'desc_font'=>$file_data[1][16],'hover_color'=>$file_data[1][17],'service_price_font_size'=>$file_data[1][18],'price_color'=>$file_data[1][19],'price_font'=>$file_data[1][20],'category'=>$catdata,'field_id'=>$rand_num,'id'=>$rand_num);
		     update_option( 'spl_cats_'.$rand_num, $data ); 
			 $url = admin_url().'/admin.php?page=spl-tabs&action=edit&id='.$rand_num;
			 
			 fclose($file);
			 header("Location: " . $url);
			 exit;
		 
		
		 
	}
}
?>