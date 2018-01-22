<?php
	require_once("conf.php");
	$data = $_REQUEST['device_countstype'];
	$obj=json_decode($data, true);


	$deviceid = $obj['device_id'];
	$counttype = $obj['count_type'];
	$creatdate = $obj['creat_date'];
	$sql = "INSERT INTO `tncb_new`.`device_count` (`id`, `device_id`, `count_type`, `creat_date`) VALUES (NULL, '$deviceid', '$counttype', '$creatdate');";

	$res = mysql_query($sql);	
		
	if($res){
		echo 'yse';
	}else{
		echo 'no';
	}
		

	$link->close();

?>