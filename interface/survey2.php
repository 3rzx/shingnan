<?php
	include_once("conf.php");

	$data = $_REQUEST['feedback'];
	/*$data = '{
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
		"subscription2":"2",
		"subscription3":"1",
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
		}';*/
	
	
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
		for ($x=0; $x<$tmp; $x++) {
			$tmp2 = substr($first_consider, $x, 1); 
			$sql = "INSERT INTO `tncb_new`.`consider` (`consider_id`, `choose`) VALUES ('$highest_id1', '$tmp2');";
			$result = mysql_query($sql);
				if($result)
					echo 'y';
				else
					echo 'n';
		} 
	}
	
	if ($second_choise != NULL){
		$highest_id = mysql_result(mysql_query("SELECT MAX(consider_id) FROM consider"), 0);
		$highest_id2 = $highest_id + 1;
		$tmp = strlen($second_consider);
		for ($x=0; $x<$tmp; $x++) {
			$tmp2 = substr($second_consider, $x, 1); 
			$sql = "INSERT INTO `tncb_new`.`consider` (`consider_id`, `choose`) VALUES ('$highest_id2', '$tmp2');";
			$result = mysql_query($sql);
				if($result)
					echo 'y';
				else
					echo 'n';
		} 
	}
	
	if ($third_choise != NULL){
		$highest_id = mysql_result(mysql_query("SELECT MAX(consider_id) FROM consider"), 0);
		$highest_id3 = $highest_id + 1;
		$tmp = strlen($third_consider);
		for ($x=0; $x<$tmp; $x++) {
			$tmp2 = substr($third_consider, $x, 1); 
			$sql = "INSERT INTO `tncb_new`.`consider` (`consider_id`, `choose`) VALUES ('$highest_id3', '$tmp2');";
			$result = mysql_query($sql);
				if($result)
					echo 'y';
				else
					echo 'n';
		} 
	}
	
	if ($fourth_choise != NULL){
		$highest_id = mysql_result(mysql_query("SELECT MAX(consider_id) FROM consider"), 0);
		$highest_id4 = $highest_id + 1;
		$tmp = strlen($fourth_consider);
		for ($x=0; $x<$tmp; $x++) {
			$tmp2 = substr($fourth_consider, $x, 1); 
			$sql = "INSERT INTO `tncb_new`.`consider` (`consider_id`, `choose`) VALUES ('$highest_id4', '$tmp2');";
			$result = mysql_query($sql);
				if($result)
					echo 'y';
				else
					echo 'n';
		} 
	}
	
	if ($fifth_choise != NULL){
		$highest_id = mysql_result(mysql_query("SELECT MAX(consider_id) FROM consider"), 0);
		$highest_id5 = $highest_id + 1;
		$tmp = strlen($fifth_consider);
		for ($x=0; $x<$tmp; $x++) {
			$tmp2 = substr($fifth_consider, $x, 1); 
			$sql = "INSERT INTO `tncb_new`.`consider` (`consider_id`, `choose`) VALUES ('$highest_id5', '$tmp2');";
			$result = mysql_query($sql);
				if($result)
					echo 'y';
				else
					echo 'n';
		} 
	}
	
		
	/*$sql = "INSERT INTO `tncb_new`.`survey2` (`attitude`, `functionality`, `visual`, `operability`, `user_friendly`, `price`, `maintenance`, `safety`, `energy`, ` subscription1`, ` subscription2`, ` subscription3`, `install1`, `install2`, `install3`, `install4`, `install5`, `impression1`, `impression2`, `impression3`, `impression4`, `impression5`, `buy`, `reasonable_price`) VALUES 
	('$attitude', '$functionality', '$visual', '$operability', '$user_friendly', '$price', '$maintenance', '$safety', '$energy', '$subscription1', '$subscription2', '$subscription3', '$install1', '$install2', '$install3', '$install4', '$install5', '$impression1', '$impression2', '$impression3', '$impression4', '$impression5', '$buy', '$reasonable_price');";
	*/
	/*$sql = "INSERT INTO `tncb_new`.`survey2` (`survey2_id`, `attitude`, `functionality`, `visual`, `operability`, `user_friendly`, `price`, `maintenance`, `safety`, `energy`, `subscription1`, `subscription2`, `subscription3`, `install1`, `install2`, `install3`, `install4`, `install5`, `impression1`, `impression2`, `impression3`, `impression4`, `impression5`, `buy`, `reasonable_price`, `create_date`, `lastupdate_date`) VALUES 
	(NULL, '$attitude', '$functionality', '$visual', '$operability', '$user_friendly', '$price', '$maintenance', '$safety', '$energy', '$subscription1', '$subscription2', '$subscription3', '$install1', '$install2', '$install3', '$install4', '$install5', '$impression1', '$impression2', '$impression3', '$impression4', '$impression5', '$buy', '$reasonable_price', '$date', '$date');";
	*/
	$highest_survey_id = mysql_result(mysql_query("SELECT MAX(survey2_id) FROM survey2"), 0);
	$highest_survey_id = $highest_survey_id + 1;
	
	$sql = "INSERT INTO `tncb_new`.`survey2` (`survey2_id`, `attitude`, `functionality`, `visual`, `operability`, `user_friendly`, `price`, `maintenance`, `safety`, `energy`, `buy`, `reasonable_price`, `create_date`, `lastupdate_date`) VALUES ('$highest_survey_id', '$attitude', '$functionality', '$visual', '$operability', '$user_friendly', '$price', '$maintenance', '$safety', '$energy', '$buy', '$reasonable_price', '$date', '$date');";
	$result = mysql_query($sql);
	if($result)
		echo 'y';
	else
		echo 'nope';
	
	/////////////////黃河遠上白雲間 一片孤城萬仞山
	if($subscription1 != ''){
		$sql = "UPDATE `tncb_new`.`survey2` SET subscription1 = '$subscription1' WHERE survey2_id = '$highest_survey_id' ;";
		$result = mysql_query($sql);
		if($result)
			echo 'y';
		else
			echo 'nope';
	}
	if($subscription2 != ''){
		$sql = "UPDATE `tncb_new`.`survey2` SET subscription2 = '$subscription2' WHERE survey2_id = '$highest_survey_id' ;";
		$result = mysql_query($sql);
		if($result)
			echo 'y';
		else
			echo 'nope';
	}
	if($subscription3 != ''){
		$sql = "UPDATE `tncb_new`.`survey2` SET subscription3 = '$subscription3' WHERE survey2_id = '$highest_survey_id' ;";
		$result = mysql_query($sql);
		if($result)
			echo 'y';
		else
			echo 'nope';
	}
	if($install1 != ''){
		$sql = "UPDATE `tncb_new`.`survey2` SET install1 = '$install1' WHERE survey2_id = '$highest_survey_id' ;";
		$result = mysql_query($sql);
		if($result)
			echo 'y';
		else
			echo 'nope';
	}
	if($install2 != ''){
		$sql = "UPDATE `tncb_new`.`survey2` SET install2 = '$install2' WHERE survey2_id = '$highest_survey_id' ;";
		$result = mysql_query($sql);
		if($result)
			echo 'y';
		else
			echo 'nope';
	}
	if($install3 != ''){
		$sql = "UPDATE `tncb_new`.`survey2` SET install3 = '$install3' WHERE survey2_id = '$highest_survey_id' ;";
		$result = mysql_query($sql);
		if($result)
			echo 'y';
		else
			echo 'nope';
	}
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
	if($impression1 != ''){
		$sql = "UPDATE `tncb_new`.`survey2` SET impression1 = '$impression1' WHERE survey2_id = '$highest_survey_id' ;";
		$result = mysql_query($sql);
		if($result)
			echo 'y';
		else
			echo 'nope';
	}
	if($impression2 != ''){
		$sql = "UPDATE `tncb_new`.`survey2` SET impression2 = '$impression2' WHERE survey2_id = '$highest_survey_id' ;";
		$result = mysql_query($sql);
		if($result)
			echo 'y';
		else
			echo 'nope';
	}
	if($impression3 != ''){
		$sql = "UPDATE `tncb_new`.`survey2` SET impression3 = '$impression3' WHERE survey2_id = '$highest_survey_id' ;";
		$result = mysql_query($sql);
		if($result)
			echo 'y';
		else
			echo 'nope';
	}
	if($impression4 != ''){
		$sql = "UPDATE `tncb_new`.`survey2` SET impression4 = '$impression4' WHERE survey2_id = '$highest_survey_id' ;";
		$result = mysql_query($sql);
		if($result)
			echo 'y';
		else
			echo 'nope';
	}
	if($impression5 != ''){
		$sql = "UPDATE `tncb_new`.`survey2` SET impression5 = '$impression5' WHERE survey2_id = '$highest_survey_id' ;";
		$result = mysql_query($sql);
		if($result)
			echo 'y';
		else
			echo 'nope';
	}
	///////////昨夜星辰昨夜風 畫樓西畔桂堂東
	
	//$highest_survey_id = mysql_result(mysql_query("SELECT MAX(survey2_id) FROM survey2"), 0);
	
	if ($first_choise != NULL){
		$sql = "INSERT INTO `tncb_new`.`survey2_2` (`id`, `choise`, `order`, `consider`) VALUES ('$highest_survey_id', '$first_choise', '1', '$highest_id1');";
		$result = mysql_query($sql);
			if($result)
				echo 'y';
			else
				echo 'n';
	}
	
	if ($second_choise != NULL){
		$sql = "INSERT INTO `tncb_new`.`survey2_2` (`id`, `choise`, `order`, `consider`) VALUES ('$highest_survey_id', '$second_choise', '2', '$highest_id2');";
		$result = mysql_query($sql);
			if($result)
				echo 'y';
			else
				echo 'n';
	}
	
	if ($third_choise != NULL){
		$sql = "INSERT INTO `tncb_new`.`survey2_2` (`id`, `choise`, `order`, `consider`) VALUES ('$highest_survey_id', '$third_choise', '3', '$highest_id3');";
		$result = mysql_query($sql);
			if($result)
				echo 'y';
			else
				echo 'n';
	}
	
	if ($fourth_choise != NULL){
		$sql = "INSERT INTO `tncb_new`.`survey2_2` (`id`, `choise`, `order`, `consider`) VALUES ('$highest_survey_id', '$fourth_choise', '4', '$highest_id4');";
		$result = mysql_query($sql);
			if($result)
				echo 'y';
			else
				echo 'n';
	}
	
	if ($fifth_choise != NULL){
		$sql = "INSERT INTO `tncb_new`.`survey2_2` (`id`, `choise`, `order`, `consider`) VALUES ('$highest_survey_id', '$fifth_choise', '5', '$highest_id5');";
		$result = mysql_query($sql);
			if($result)
				echo 'y';
			else
				echo 'n';
	}
	
?>