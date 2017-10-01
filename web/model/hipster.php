<?php
	include_once("conf.php");

	$data = $_REQUEST['json_string'];
	
	//$data = '{"content":"66666","picture":"../media/template/N!57e16b27cc1809.58067951","combine_picture":"../media/template/N!57e16b27cc1809.58067951","hipster_template_id":"30","hipster_text_id":"1","zone_id":"9"}';
	
	$obj=json_decode($data, true);
	
	$content = $obj['content'];
	$picture = $obj['picture'];
	$combine_picture = $obj['combine_picture'];
	$hipster_template_id = $obj['hipster_template_id'];
	$hipster_text_id = $obj['hipster_text_id'];
	$zone_id = $obj['zone_id'];
	$date = date('Y/m/d h:i:sa', time());
	
	$picture_data = $obj['picture'];
	$combine_picture_data =  $obj['combine_picture_data'];
	$path = "../web/media/combine_picture/123.txt";
	$combine_picture_data = "hello World. Testing!" ;
	//	file_put_contents($path,base64_decode($image));
	echo file_put_contents($path,"Hello World. Testing!");
//file_put_contents($path,$combine_picture_data);
	echo "666";
	/*
	$sql = "INSERT INTO `tncb_new`.`hipster_content` (`content`, `picture`, `combine_picture`, `hipster_template_id`, `hipster_text_id`, `zone_id`, `create_date`, `lastupdate_date`) VALUES ($content, '$picture', '$combine_picture', '$hipster_template_id', '$hipster_text_id', '$zone_id', '$date', '$date');";
	$result = mysql_query($sql);
	if($result)
		echo 'y';
	else
		echo 'no';
	*/
	$link->close();
	
?>