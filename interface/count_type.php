<?php

	/*$data = '{
    "count_table" : {
	"device_count": {
	    "6": {
		"1": {
			"count_number": 3,
			"create_date": "2017-02-09 01:00:01"
                	},
                	"2": {
			"count_number": 1,
			"create_date": "2017-02-09 01:00:01"
                	}
                },
             "2": {
		"1": {
			"count_number": 6,
			"create_date": "2017-02-09 01:00:01"
                	},
                	"2": {
			"count_number": 3,
			"create_date": "2017-02-09 01:00:01"
                	}
                }
	},
	"mode_count": {
               "1": {
		"1": {
			"count_number": 3,
			"create_date": "2017-02-09 01:00:01"
                	},
                	"2": {
			"count_number": 1,
			"create_date": "2017-02-09 01:00:01"
                	}
                },
             "2": {
		"1": {
			"count_number": 4,
			"create_date": "2017-02-09 01:00:01"
                	},
                	"2": {
			"count_number": 2,
			"create_date": "2017-02-09 01:00:01"
                	}
                }
        },
        "zone_count": {
            "1": {
		"1": {
			"count_number": 1,
			"create_date": "2017-02-09 01:00:01"
                	}
                },
	    "2": {
		"1": {
			"count_number": 2,
			"create_date": "2017-02-09 01:00:01"
                	}
                }
           }
     }
}';*/

	require_once("conf.php");
	$data = $_REQUEST['count_type'];
	$obj=json_decode($data, true);
	//echo $data;

//foreach( $obj['device_count']['1'] as $val ){
		//echo $val['1'];
		//var_dump($val);

		foreach($obj['count_table'] as $key => $arrays){
			 if($key == "device_count"){
				 

				 foreach($arrays as $device_id => $value){

					 foreach($value as $count_type => $value2){

						 $create_date = $value2['create_date'];
						 if ($value2['count_number'] != 0) {
							 $sql = "INSERT INTO `tncb_new`.device_count(`id`,`device_id`,`count_type`,`create_date`) VALUES ";
							 for ($x = 0; $x < $value2['count_number']; $x++) {
								$sql = $sql . "(NULL,'$device_id','$count_type','$create_date'),";
							}
						 }
					 }
				 }
				 $sql = substr($sql, 0,strlen($sql)-1);
				 $sql = $sql . ";";
				$res = mysql_query($sql);

				if($res){
					echo 'device yes';
				}else{
					echo 'device no';
				}
			 }

		}

		foreach($obj['count_table'] as $key => $arrays){
			if($key == "mode_count"){
				 

				 foreach($arrays as $mode_id => $value){

					 foreach($value as $count_type => $value2){

						 $create_date = $value2['create_date'];
						 if ($value2['count_number'] != 0) {
							 $sql = "INSERT INTO `tncb_new`.mode_count(`id`,`mode_id`,`count_type`,`create_date`) VALUES ";
							 for ($x = 0; $x < $value2['count_number']; $x++) {
								$sql = $sql . "(NULL,'$mode_id','$count_type','$create_date'),";
							}
						}
					 }
				 }
				 $sql = substr($sql, 0,strlen($sql)-1);
				$sql = $sql . ";";
				$res = mysql_query($sql);

				if($res){
					echo 'mode yes';
				}else{
					echo 'mode no';
				}
			 }
		}

// zone
		foreach($obj['count_table'] as $key => $arrays){
			if($key == "zone_count"){


				 foreach($arrays as $zone_id => $value){

					 foreach($value as $count_type => $value2){

						 $create_date = $value2['create_date'];
						 if ($value2['count_number'] != 0) {
							 $sql = "INSERT INTO `tncb_new`.zone_count(`id`,`zone_id`,`create_date`) VALUES ";
							// $sql = $sql . "(NULL,'$zone_id','$create_date'),";
								for ($x = 0; $x < $value2['count_number']; $x++) {
 									$sql = $sql . "(NULL,'$zone_id','$create_date'),";
 								}
						 }
					 }
				 }
				 $sql = substr($sql, 0,strlen($sql)-1);
				$sql = $sql . ";";
				$res = mysql_query($sql);
				// echo $res;
				//echo $sql;
				if($res){
					echo 'zone yes';
				}else{
					echo 'zone no';
				}
			 }
		}

		/*$device_id = $obj['device_count']['1']['device_id'];
		$count_number = $obj['device_count']['1']['count_number'];
		$create_date = $obj['device_count']['1']['create_date'];
		echo $device_id; echo $count_number; echo $create_date;*/
	//}



/*	$modeid = $obj['mode_id'];
	$counttype = $obj['count_type'];
	$creatdate = $obj['creat_date'];
	$sql = "INSERT INTO `tncb_new`.`mode_count` (`id`, `mode_id`, `count_type`, `creat_date`) VALUES (NULL, '$modeid', '$counttype', '$creatdate');";

	$res = mysql_query($sql);

	if($res){
		echo 'yse';
	}else{
		echo 'no';
	}
		*/


?>
