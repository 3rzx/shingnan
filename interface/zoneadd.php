<?php
	require_once("conf.php");

	$data = $_REQUEST['zone_counts'];
	/*$json_string = '{
		"data":[
		{"zone_id":"1", "like_count":2},
		{"zone_id":3, "like_count":2},
		{"zone_id":5, "like_count":1}	
		]}';*/

	$obj=json_decode($data, true);
	$zoneid = $obj['zone_id'];
	$addlike = $obj['like_count'];
	
	$sql = "UPDATE `zone` SET `like_count` = `like_count` + $addlike WHERE `zone_id` = $zoneid ";
	$res = mysql_query($sql);
	if($res){
		echo 'yse';
	}else{
		echo 'no';
	}
	/*	foreach( $obj['data'] as $val ){
			$zoneid = $val['zone_id'];
			$addlike = $val['like_count'];
			$sql = "UPDATE `zone` SET `like_count` = `like_count` + $addlike WHERE `zone_id` = $zoneid ";
			$res = mysql_query($sql);	
		}
		if($res){
			echo 'yse';
		}else{
			echo 'no';
		}*/
		
	$link->close();
	
?>