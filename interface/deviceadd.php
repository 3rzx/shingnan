<?php
	require_once("conf.php");

	$data = $_REQUEST['device_counts'];
	/*$json_string = '{
		"data":[
		{ "device_id":"1", "read_count":3, "like_count":2},
		{ "device_id":2, "read_count":4, "like_count":2},
		{ "device_id":5, "read_count":5, "like_count":1}	
		]}';*/
		//$json_string = "{'type':1,'data':[{'mode_id':1,'device_id':1,'read_count':2},{'mode_id':1,'device_id':2,'read_count':5},{'mode_id':1,'device_id':23,'read_count':2}]}";


	$obj=json_decode($data, true);

		foreach( $obj as $val ){
			$deviceid = $val['device_id'];
			$addread = $val['read_count'];
			$addlike = $val['like_count'];
			$sql = "UPDATE `device` SET `read_count` = `read_count` + $addread , `like_count` = `like_count` + $addlike WHERE `device_id` = $deviceid ";
			$res = mysql_query($sql);	
		}
		if($res){
			echo 'yse';
		}else{
			echo 'no';
		}
		

	$link->close();
	
	
	
	
?>