<?php
	require_once("conf.php");

	$data = $_REQUEST['mode_counts'];
	/*$json_string = '{

		"mode_id":"1", "read_count":3, "like_count":2
		}';*/

	$obj=json_decode($data, true);


			$modeid = $obj['mode_id'];
			$addread = $obj['read_count'];
			$addlike = $obj['like_count'];
			$sql = "UPDATE `mode` SET `read_count` = `read_count` + $addread , `like_count` = `like_count` + $addlike WHERE `mode_id` = $modeid ";
			$res = mysql_query($sql);	
		
		if($res){
			echo 'yse';
		}else{
			echo 'no';
		}
		

	$link->close();
	
	
	
	
?>