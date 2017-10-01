<?php
	require_once("conf.php");

	$data = $_REQUEST['json_string'];
	/*$json_string = '{
		"type" : 1,
		"data":[
		{"mode_id":"1", "device_id":"1", "read_count":3},
		{"mode_id":1, "device_id":2, "read_count":4},
		{"mode_id":1, "device_id":23, "read_count":5}	
		]}';*/
		//$json_string = "{'type':1,'data':[{'mode_id':1,'device_id':1,'read_count':2},{'mode_id':1,'device_id':2,'read_count':5},{'mode_id':1,'device_id':23,'read_count':2}]}";

	$obj=json_decode($data, true);

	if($obj['type'] == 1){
		foreach( $obj['data'] as $val ){
			$deviceid = $val['device_id'];
			$modeid = $val['mode_id'];
			$add = $val['read_count'];
			
			$sql = "UPDATE `device` SET `read_count` = `read_count` + $add WHERE `device_id` = $deviceid ";
			$res = mysql_query($sql);	
		}
		if($res){
			echo 'yse';
		}else{
			echo 'no';
		}
		
	}else{
		echo 'no';
	}
	$link->close();
?>