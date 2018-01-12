<?php
	include_once("conf.php");

	$data = $_REQUEST['survey'];
	/*$json_string = '{
		"data":[
		{"question":"1", "answer":"1"},
		{"question":2, "answer":2},
		{"question":3, "answer":2}	
		]}';*/
		
	/*$data = '{
		"data":[
		{"question":"1", "answer":"1"},
		{"question":2, "answer":2}		
		]}';*/
		
	/*$data = '{
		"gender":"1",
		"age":"2",
		"education":"3",
		"career":"1",
		"experience":"2",
		"salary":"2",
		"location":"2",
		"house_type":"2",
		"family_type":"2",
		"fimily_member":"1",
		"know_way":"1",
		"name":"4G lin",
		"email":"GGGG@gmail.com"
		}';
	*/
	
	$obj=json_decode($data, true);
	
	$gender = $obj['gender'];
	$age = $obj['age'];
	$education = $obj['education'];
	$career = $obj['career'];
	$experience = $obj['experience'];
	$salary = $obj['salary'];
	$location = $obj['location'];
	$house_type = $obj['house_type'];
	$family_type = $obj['family_type'];
	$family_member = $obj['family_member'];
	$know_way = $obj['know_way'];
	$name = $obj['name'];
	$email = $obj['email'];
	$date = date('Y/m/d h:i:sa', time());
	//echo $know_way . "  ".$gender. " ".$family_type."  ".$date ." ". $age ." ". $email ." ". $name ." ". $salary ." ". $location ;
	
	$sql = "INSERT INTO `tncb_new`.`survey` (`survey_id`, `name`, `email`, `gender`, `age`, `education`, `career`, `experience`, `salary`, `location`, `house_type`, `family_type`, `family_member`, `know_way`, `create_date`, `lastupdate_date`) VALUES (NULL, '$name', '$email', '$gender', '$age', '$education', '$career', '$experience', '$salary', '$location', '$house_type', '$family_type', '$family_member', '$know_way', '$date', '$date');";
	$result = mysql_query($sql);
	if($result)
		echo 'y';
	else
		echo $sql;
	
	
	/*
	foreach( $obj['data'] as $val ){
			$question = $val['question'];
			$answer = $val['answer'];
			
			$sql = "SELECT * FROM `survey_result` WHERE question = $question AND answer = $answer ";
			$result = mysql_query($sql);
			if($result){
				$sql = "UPDATE `survey_result` SET `total` = `total` + 1 WHERE question = $question AND answer = $answer ";
				$res = mysql_query($sql);
			}
			
		}
		if($res){
					echo 'y';
				}
			else{
				echo 'no';
			}
		*/
	//$link->close();
?>