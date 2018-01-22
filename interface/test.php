<?php
	include_once("conf.php");
   /* $highest_id = mysql_result(mysql_query("SELECT MAX(consider_id) FROM consider"), 0);
	//echo $highest_id ;
	
	$data = '{
		"aaa":"1",
		"bbb":"2",
		"ccc":"235"
		}';
		
	$obj=json_decode($data, true);
	$ccc = $obj['ccc'];
	$tmp = strlen($ccc);
	
	for ($x=0; $x<$tmp; $x++) {
		$tt = substr($ccc, $x, 1); 
		echo "$tt <br>";

	} 
	
	$ttttt = NULL;
	$ttttt = 1;
	echo "$ttttt <br>";
	*/
	
	$data = $_REQUEST['json_string'];
	$data = '{
		"attitude":"1",
		"functionality":"2",
		"visual":"3",
		"operability":"1",
		"user_friendly":"2",
		"price":"2",
		"maintenance":"2",
		"safety":"2",
		"energy":"2",
		"first_choise":"2",
		"second_choise":"3",
		"third_choise":"4",
		"fourth_choise":"",
		"fifth_choise":"",
		"first_consider":"16",
		"second_consider":"3",
		"third_consider":"247",
		"fourth_consider":"",
		"fifth_consider":"",
		"subscription1":"6",
		"subscription2":"8",
		"subscription3":"9",
		"install1":"9",
		"install2":"10",
		"install3":"11",
		"install4":"12",
		"install5":"",
		"impression1":"10",
		"impression2":"12",
		"impression3":"",
		"impression4":"",
		"impression5":"",
		"buy":"2",
		"reasonable_price":"1"
		}';
	
	
	$obj=json_decode($data, true);
	
	$attitude = $obj['attitude'];
	$functionality = $obj['functionality'];
	$visual = $obj['visual'];
	$operability = $obj['operability'];
	$user_friendly = $obj['user_friendly'];
	$price = $obj['price'];
	$maintenance = $obj['maintenance'];
	$safety = $obj['safety'];
	$energy = $obj['energy'];
	$first_choise = $obj['first_choise'];
	$second_choise = $obj['second_choise'];
	$third_choise = $obj['third_choise'];
	$fourth_choise = $obj['fourth_choise'];
	$fifth_choise = $obj['fifth_choise']; 
	$first_consider = $obj['first_consider']; 
	$second_consider = $obj['second_consider']; 
	$third_consider = $obj['third_consider']; 
	$fourth_consider = $obj['fourth_consider']; 
	$fifth_consider = $obj['fifth_consider'];
	$subscription1 = $obj['subscription1'];
	$subscription2 = $obj['subscription2'];
	$subscription3 = $obj['subscription3'];
	$install1 = $obj['install1'];
	$install2 = $obj['install2'];
	$install3 = $obj['install3'];
	$install4 = $obj['install4'];
	$install5 = $obj['install5'];
	$impression1 = $obj['impression1'];
	$impression2 = $obj['impression2'];
	$impression3 = $obj['impression3'];
	$impression4 = $obj['impression4'];
	$impression5 = $obj['impression5'];
	$buy = $obj['buy'];
	$reasonable_price = $obj['reasonable_price'];
	$date = date('Y/m/d h:i:sa', time());
	$highest_id1 = NULL;
	$highest_id2 = NULL;
	$highest_id3 = NULL;
	$highest_id4 = NULL;
	$highest_id5 = NULL;
	
	if ($first_choise != NULL){
		$highest_id = mysql_result(mysql_query("SELECT MAX(consider_id) FROM consider"), 0);
		$highest_id1 = $highest_id + 1;
		$tmp = strlen($first_consider);
		
	}
	
	if ($second_choise != NULL){
		$highest_id = mysql_result(mysql_query("SELECT MAX(consider_id) FROM consider"), 0);
		$highest_id2 = $highest_id + 1;
		$tmp = strlen($second_consider);
		
	}
	
	if ($third_choise != NULL){
		$highest_id = mysql_result(mysql_query("SELECT MAX(consider_id) FROM consider"), 0);
		$highest_id3 = $highest_id + 1;
		$tmp = strlen($third_consider);
		
	}
	
	if ($fourth_choise != NULL){
		$highest_id = mysql_result(mysql_query("SELECT MAX(consider_id) FROM consider"), 0);
		$highest_id4 = $highest_id + 1;
		$tmp = strlen($fourth_consider);
		
	}
	
	if ($fifth_choise != NULL){
		$highest_id = mysql_result(mysql_query("SELECT MAX(consider_id) FROM consider"), 0);
		$highest_id5 = $highest_id + 1;
		$tmp = strlen($fifth_consider);
		
	}
	
	
	$install5 = '';
	/*$sql = "INSERT INTO `tncb_new`.`survey2` (`attitude`, `functionality`, `visual`, `operability`, `user_friendly`, `price`, `maintenance`, `safety`, `energy`, ` subscription1`, ` subscription2`, ` subscription3`, `install1`, `install2`, `install3`, `install4`, `install5`, `impression1`, `impression2`, `impression3`, `impression4`, `impression5`, `buy`, `reasonable_price`) VALUES 
	('$attitude', '$functionality', '$visual', '$operability', '$user_friendly', '$price', '$maintenance', '$safety', '$energy', '$subscription1', '$subscription2', '$subscription3', '$install1', '$install2', '$install3', '$install4', '$install5', '$impression1', '$impression2', '$impression3', '$impression4', '$impression5', '$buy', '$reasonable_price');";
	*/
	/*$sql = "INSERT INTO `tncb_new`.`survey2` (`survey2_id`, `attitude`, `functionality`, `visual`, `operability`, `user_friendly`, `price`, `maintenance`, `safety`, `energy`, `subscription1`, `subscription2`, `subscription3`, `install1`, `install2`, `install3`, `install4`, `install5`, `impression1`, `impression2`, `impression3`, `impression4`, `impression5`, `buy`, `reasonable_price`, `create_date`, `lastupdate_date`) VALUES 
	(NULL, '$attitude', '$functionality', '$visual', '$operability', '$user_friendly', '$price', '$maintenance', '$safety', '$energy', '$subscription1', '$subscription2', '$subscription3', '$install1', '$install2', '$install3', '$install4', '$install5', '$impression1', '$impression2', '$impression3', '$impression4', '$impression5', '$buy', '$reasonable_price', '$date', '$date');";
	*/
	//$sql = "INSERT INTO `tncb_new`.`survey2` (`survey2_id`, `attitude`, `functionality`, `visual`, `operability`, `user_friendly`, `price`, `maintenance`, `safety`, `energy`, `subscription1`, `subscription2`, `subscription3`, `install1`, `install2`, `install3`, `install4`, `install5`) VALUES (NULL, '$attitude', '$functionality', '$visual', '$operability', '$user_friendly', '$price', '$maintenance', '$safety', '$energy', '$subscription1', '$subscription2', '$subscription3', '$install1', '$install2', '$install3', '$install4', '$install5');";
	$highest_survey_id = mysql_result(mysql_query("SELECT MAX(survey2_id) FROM survey2"), 0);
	$highest_survey_id = $highest_survey_id + 1;
		$sql = "INSERT INTO `tncb_new`.`survey2` (`survey2_id`, `install1`, `install2`, `install3`) VALUES ('$highest_survey_id', '$install1', '$install2', '$install3');";
		$result = mysql_query($sql);
	if($result)
		echo 'y';
	else
		echo 'nope';
		
		
		if($install4 != ''){
			$sql = "UPDATE `tncb_new`.`survey2` SET install4 = '$install4' WHERE survey2_id = '$highest_survey_id' ;";
			$result = mysql_query($sql);
				if($result)
					echo 'y';
				else
					echo 'nope';
		}
		if($install5 != ''){
			$sql = "UPDATE `tncb_new`.`survey2` SET install5 = '$install5' WHERE survey2_id = '$highest_survey_id' ;";
			$result = mysql_query($sql);
			if($result)
				echo 'y';
			else
				echo 'nope';
		}
	
	//echo $sql;
	
	
	?>

