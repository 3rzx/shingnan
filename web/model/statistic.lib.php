<?php

// include the setup script
require_once HOME_DIR . 'configs/config.php';

/**
 * statistic Class
 *
 */
class statistic {
	
	// database object
    public $db = null;
    // smarty template object
    public $smartyTemplate = null;

	
	/**
	 * class constructor
	 */
	function __construct() {
		session_start();
        // instantiate the pdo object
        $this->db = dbSetup::getDbConn();
        // instantiate the template object
        $this->smartyTemplate = new SmartyConfig();
	}

	/**
     * 顯示問卷統計
     * @DateTime 2016-09-08
     */

	function viewSurveyResult() {
		if ($_SESSION['isLogin'] == true) {
			try {
				$begin = date('Y-m-01'); //本月第一天
			    $end   = strtotime($begin);
			    $end   = strtotime('+1 month -1 days', $end);
			    $end   = date("Y-m-d", $end); //本月最後一天

				$surveyResult = $this->dealSurvey($begin,$end);
				$this->smartyTemplate->assign('surveyResult', $surveyResult);

				$survey2Result = $this->dealSurvey2($begin,$end);
				$this->smartyTemplate->assign('survey2Result', $survey2Result);

				$rh = $this->db->prepare('SELECT `survey2_2_result`.`device_id`, `survey2_2_result`.`install` , `device`.`name` FROM `survey2_2_result` , `device` WHERE `survey2_2_result`.`device_id` = `device`.`device_id` ORDER BY install DESC LIMIT 0, 5');
				$rh->execute();
				$survey2DeviceInstallData = $rh->fetchAll();				
				$this->smartyTemplate->assign('survey2DeviceInstallData', $survey2DeviceInstallData);

				$rh = $this->db->prepare('SELECT `survey2_2_result`.`device_id`, `survey2_2_result`.`impression` , `device`.`name` FROM `survey2_2_result` , `device` WHERE `survey2_2_result`.`device_id` = `device`.`device_id` ORDER BY impression DESC LIMIT 0, 5');
				$rh->execute();
				$survey2DeviceImpressionData = $rh->fetchAll();				
				$this->smartyTemplate->assign('survey2DeviceImpressionData', $survey2DeviceImpressionData);

				$rh = $this->db->prepare('SELECT `survey2_2_result`.`device_id`, `survey2_2_result`.`choose`, `survey2_2_result`.`consider1` ,`survey2_2_result`.`consider2` , `survey2_2_result`.`consider3`, `survey2_2_result`.`consider4`, `survey2_2_result`.`consider5`, `survey2_2_result`.`consider6`, `survey2_2_result`.`consider7`, `device`.`name` FROM `survey2_2_result`, `device` WHERE `survey2_2_result`.`device_id` = `device`.`device_id` AND `survey2_2_result`.`consider1` IS NOT NULL ORDER BY choose DESC LIMIT 0, 5');
				$rh->execute();
				$survey2DeviceChooseData = $rh->fetchAll();				
				$this->smartyTemplate->assign('survey2DeviceChooseData', $survey2DeviceChooseData);

				$this->smartyTemplate->display('statistic/surveyResultList.html');
			} catch (PDOException $e) {
				print "Error!: " . $e->getMessage();
			}
		} else {
			$this->error = '請先登入!';
            $this->viewLogin();
		}
	}

	/**
     * 顯示問卷統計日期區間
     * @DateTime 2017-02-06
     */
	function viewSurveyResultDate($input) {
		if ($_SESSION['isLogin'] == true) {
			try {
				$surveyResult = $this->dealSurvey($input['begin'],$input['end']);
				$this->smartyTemplate->assign('surveyResult', $surveyResult);

				$survey2Result = $this->dealSurvey2($input['begin'],$input['end']);
				$this->smartyTemplate->assign('survey2Result', $survey2Result);

				$rh = $this->db->prepare('SELECT `survey2_2_result`.`device_id`, `survey2_2_result`.`install` , `device`.`name` FROM `survey2_2_result` , `device` WHERE `survey2_2_result`.`device_id` = `device`.`device_id` ORDER BY install DESC LIMIT 0, 5');
				$rh->execute();
				$survey2DeviceInstallData = $rh->fetchAll();				
				$this->smartyTemplate->assign('survey2DeviceInstallData', $survey2DeviceInstallData);

				$rh = $this->db->prepare('SELECT `survey2_2_result`.`device_id`, `survey2_2_result`.`impression` , `device`.`name` FROM `survey2_2_result` , `device` WHERE `survey2_2_result`.`device_id` = `device`.`device_id` ORDER BY impression DESC LIMIT 0, 5');
				$rh->execute();
				$survey2DeviceImpressionData = $rh->fetchAll();				
				$this->smartyTemplate->assign('survey2DeviceImpressionData', $survey2DeviceImpressionData);

				$rh = $this->db->prepare('SELECT `survey2_2_result`.`device_id`, `survey2_2_result`.`choose`, `survey2_2_result`.`consider1` ,`survey2_2_result`.`consider2` , `survey2_2_result`.`consider3`, `survey2_2_result`.`consider4`, `survey2_2_result`.`consider5`, `survey2_2_result`.`consider6`, `survey2_2_result`.`consider7`, `device`.`name` FROM `survey2_2_result`, `device` WHERE `survey2_2_result`.`device_id` = `device`.`device_id`  AND `survey2_2_result`.`consider1` IS NOT NULL ORDER BY choose DESC LIMIT 0, 5');
				$rh->execute();
				$survey2DeviceChooseData = $rh->fetchAll();				
				$this->smartyTemplate->assign('survey2DeviceChooseData', $survey2DeviceChooseData);


				$this->smartyTemplate->display('statistic/surveyResultListDate.html');
			} catch (PDOException $e) {
				print "Error!: " . $e->getMessage();
			}
		} else {
			$this->error = '請先登入!';
            $this->viewLogin();
		}
	}

	/**
     * 顯示按讚統計
     * @DateTime 2016-09-08
     */
	function viewLikeCount() {
		if ($_SESSION['isLogin'] == true) {
			$begin = date('Y-m-01'); //本月第一天
			$end   = strtotime($begin);
			$end   = strtotime('+1 month -1 days', $end);
			$end   = date("Y-m-d", $end); //本月最後一天
			$modeData = array();
			$deviceData = array();
			$zoneData = array();

			try {
				$rh = $this->db->prepare("SELECT mode_id, name FROM mode ORDER BY mode_id;");
				$rh->execute();
				$allMode = $rh->fetchAll();				
				for($i=0;$i<$rh->rowCount();$i++){
					$modeData[$i]['mode_id'] = $allMode[$i]['mode_id'];
					$modeData[$i]['read_count'] = 0; 
					$modeData[$i]['like_count'] = 0; 	
					$modeData[$i]['name'] = $allMode[$i]['name'];
				}

				$rh = $this->db->prepare("SELECT COUNT(*) AS C, mode_id FROM mode_count WHERE count_type = '1' AND create_date BETWEEN '$begin' AND '$end' GROUP BY mode_id;");
				$rh->execute(); 
				if($rh->rowCount()>0){					
		            for($i=0; $i<$rh->rowCount(); $i++){
		                $row = $rh->fetch();
		                $modeData[$row['mode_id']-1]['read_count'] += $row['C'];
		            }
		        }

				$rh = $this->db->prepare("SELECT COUNT(*) AS C, mode_id FROM mode_count WHERE count_type = '2' AND create_date BETWEEN '$begin' AND '$end' GROUP BY mode_id;");
				$rh->execute();
				if($rh->rowCount()>0){
		            for($i=0; $i<$rh->rowCount(); $i++){
		                $row = $rh->fetch();
		        		$modeData[$row['mode_id']-1]['like_count'] += $row['C'];
		            }
		        }
				
		        $rh = $this->db->prepare("SELECT device_id, name FROM device ORDER BY device_id;");
				$rh->execute();
				$allDevice = $rh->fetchAll();
				for($i=0;$i<$rh->rowCount();$i++){
					$deviceData[$i]['device_id'] = $allDevice[$i]['device_id'];
					$deviceData[$i]['read_count'] = 0; 
					$deviceData[$i]['like_count'] = 0; 
					$deviceData[$i]['name'] = $allDevice[$i]['name'];	
				}

				$rh = $this->db->prepare("SELECT COUNT(*) AS C, device_id FROM device_count WHERE count_type = '1' AND create_date BETWEEN '$begin' AND '$end' GROUP BY device_id;");
				$rh->execute();
				if($rh->rowCount()>0){
		            for($i=0; $i<$res->rowCount(); $i++){
		                $row = $rh->fetch_assoc();
		        		$deviceData[$row['device_id']-1]['read_count'] += $row['C'];
		            }
		        }

				$rh = $this->db->prepare("SELECT COUNT(*) AS C, device_id FROM device_count WHERE count_type = '2' AND create_date BETWEEN '$begin' AND '$end' GROUP BY device_id;");
				$rh->execute();
				if($rh->rowCount()>0){
		            for($i=0; $i<$res->rowCount(); $i++){
		                $row = $rh->fetch_assoc();
		        		$deviceData[$row['device_id']-1]['like_count'] += $row['C'];
		            }
		        }

		        $rh = $this->db->prepare("SELECT zone_id, name FROM zone ORDER BY zone_id;");
				$rh->execute();
				$allZone = $rh->fetchAll();				
				for($i=0;$i<$rh->rowCount();$i++){
					$zoneData[$i]['zone_id'] = $allZone[$i]['zone_id'];
					$zoneData[$i]['like_count'] = 0; 	
					$zoneData[$i]['name'] = $allZone[$i]['name'];
				}

				$rh = $this->db->prepare("SELECT COUNT(*) AS C, zone_id FROM zone_count WHERE create_date BETWEEN '$begin' AND '$end' GROUP BY zone_id;");
				$rh->execute(); 
				if($rh->rowCount()>0){					
		            for($i=0; $i<$rh->rowCount(); $i++){
		                $row = $rh->fetch();
		                $zoneData[$row['zone_id']-1]['like_count'] += $row['C'];
		            }
		        }

				$this->smartyTemplate->assign('modeData', $modeData);
				$this->smartyTemplate->assign('zoneData', $zoneData);
				$this->smartyTemplate->assign('deviceData', $deviceData);
				$this->smartyTemplate->display('statistic/likeCountList.html');
			} catch (PDOException $e) {
				print "Error!: " . $e->getMessage();
			}
		} else {
			$this->error = '請先登入!';
            $this->viewLogin();
		}
	}

	/**
     * 顯示按讚統計日期區間
     * @DateTime 2017-02-06
     */
	function viewLikeCountDate($input) {
		if ($_SESSION['isLogin'] == true) {
			$begin = $input['begin'];
			$end = $input['end'];
			try {
				$rh = $this->db->prepare("SELECT mode_id, name FROM mode ORDER BY mode_id;");
				$rh->execute();
				$allMode = $rh->fetchAll();				
				for($i=0;$i<$rh->rowCount();$i++){
					$modeData[$i]['mode_id'] = $allMode[$i]['mode_id'];
					$modeData[$i]['read_count'] = 0; 
					$modeData[$i]['like_count'] = 0; 	
					$modeData[$i]['name'] = $allMode[$i]['name'];
				}

				$rh = $this->db->prepare("SELECT COUNT(*) AS C, mode_id FROM mode_count WHERE count_type = '1' AND create_date BETWEEN '$begin' AND '$end' GROUP BY mode_id;");
				$rh->execute(); 
				if($rh->rowCount()>0){					
		            for($i=0; $i<$rh->rowCount(); $i++){
		                $row = $rh->fetch();
		                $modeData[$row['mode_id']-1]['read_count'] += $row['C'];
		            }
		        }

				$rh = $this->db->prepare("SELECT COUNT(*) AS C, mode_id FROM mode_count WHERE count_type = '2' AND create_date BETWEEN '$begin' AND '$end' GROUP BY mode_id;");
				$rh->execute();
				if($rh->rowCount()>0){
		            for($i=0; $i<$rh->rowCount(); $i++){
		                $row = $rh->fetch();
		        		$modeData[$row['mode_id']-1]['like_count'] += $row['C'];
		            }
		        }
				
		        $rh = $this->db->prepare("SELECT device_id, name FROM device ORDER BY device_id;");
				$rh->execute();
				$allDevice = $rh->fetchAll();
				for($i=0;$i<$rh->rowCount();$i++){
					$deviceData[$i]['device_id'] = $allDevice[$i]['device_id'];
					$deviceData[$i]['read_count'] = 0; 
					$deviceData[$i]['like_count'] = 0; 
					$deviceData[$i]['name'] = $allDevice[$i]['name'];	
				}

				$rh = $this->db->prepare("SELECT COUNT(*) AS C, device_id FROM device_count WHERE count_type = '1' AND create_date BETWEEN '$begin' AND '$end' GROUP BY device_id;");
				$rh->execute();
				if($rh->rowCount()>0){
		            for($i=0; $i<$res->rowCount(); $i++){
		                $row = $rh->fetch_assoc();
		        		$deviceData[$row['device_id']-1]['read_count'] += $row['C'];
		            }
		        }

				$rh = $this->db->prepare("SELECT COUNT(*) AS C, device_id FROM device_count WHERE count_type = '2' AND create_date BETWEEN '$begin' AND '$end' GROUP BY device_id;");
				$rh->execute();
				if($rh->rowCount()>0){
		            for($i=0; $i<$res->rowCount(); $i++){
		                $row = $rh->fetch_assoc();
		        		$deviceData[$row['device_id']-1]['like_count'] += $row['C'];
		            }
		        }

		        $rh = $this->db->prepare("SELECT zone_id, name FROM zone ORDER BY zone_id;");
				$rh->execute();
				$allZone = $rh->fetchAll();				
				for($i=0;$i<$rh->rowCount();$i++){
					$zoneData[$i]['zone_id'] = $allZone[$i]['zone_id'];
					$zoneData[$i]['like_count'] = 0; 	
					$zoneData[$i]['name'] = $allZone[$i]['name'];
				}

				$rh = $this->db->prepare("SELECT COUNT(*) AS C, `zone_id` FROM zone_count WHERE `create_date` BETWEEN '$begin' AND '$end' GROUP BY `zone_id`;");
				$rh->execute(); 
				if($rh->rowCount()>0){					
		            for($i=0; $i<$rh->rowCount(); $i++){
		                $row = $rh->fetch();
		                $zoneData[$row['zone_id']-1]['like_count'] += $row['C'];
		            }
		        }

				$this->smartyTemplate->assign('modeData', $modeData);
				$this->smartyTemplate->assign('deviceData', $deviceData);
				$this->smartyTemplate->assign('zoneData',$zoneData);
				$this->smartyTemplate->display('statistic/likeCountListDate.html');
			} catch (PDOException $e) {
				print "Error!: " . $e->getMessage();
			}
		} else {
			$this->error = '請先登入!';
            $this->viewLogin();
		}
	}

	/**
     * 顯示文青使用統計
     * @DateTime 2016-09-14
     */
	function viewHipster() {
		if ($_SESSION['isLogin'] == true) {
			try {
				$sql = 'SELECT * FROM hipster_content';
				$rh = $this->db->prepare($sql);
				$rh->execute();
				$hipster_contentData = $rh->fetchAll();

				foreach ($hipster_contentData as $key => $value) {
					$template_id = $value['hipster_template_id'];
					$sql = "SELECT template,name FROM hipster_template WHERE hipster_template_id = $template_id";
					$rh = $this->db->prepare($sql);
					$rh->execute();
					$template = $rh->fetchAll();
					$hipster_contentData[$key]['template_path'] = $template[0]['template'];
					$hipster_contentData[$key]['template_name'] = $template[0]['name'];
				}

				$this->smartyTemplate->assign('hipster_contentData', $hipster_contentData);
				$this->smartyTemplate->display('statistic/hipsterList.html');
			} catch (PDOException $e) {
				print "Error!: " . $e->getMessage();
			}
		} else {
			$this->error = '請先登入!';
            $this->viewLogin();
		}
	}


	function dealSurvey2($begin,$end){
		$field  = ['attitude', 'functionality', 'visual', 'operability', 'user_friendly', 'price', 'maintenance', 'safety', 'energy', 'buy', 'reasonable_price'];
	    $ansNum = [5, 5, 5, 5, 5, 5, 5, 5, 5, 2, 5];
	    $len = count($ansNum);
	    $data = array();

	    for ($i = 0; $i < $len; $i++) {
	        $table = $field[$i];
	        $ans   = $ansNum[$i];

	        while ($ans > 0) {
	            $sql = "SELECT `$table` , COUNT(`$table`) AS count
	                    FROM  `survey2`
	                    WHERE  `$table` = '$ans' AND create_date BETWEEN '$begin' AND '$end';";

	            $res = $this->db->prepare($sql);
	            if ($res->execute()) {
	                $res          = $res->fetchAll();
	                $temp = $res[0]['count'];
	            } else {
	                $temp = 0;
	            }
	            $data[$i][$ans] = $temp;
	            $ans--;
	        }
	    }

	    $res = $this->db->prepare("TRUNCATE TABLE `survey2_2_result`;");
	    $res->execute();

	    //處理impression
	    $sql = "UPDATE `survey2_2_result` SET  `impression` =  '0' ";
	    $res = $this->db->prepare($sql);
	    $res->execute();
	    for ($i = 1; $i < 6; $i++) {
	        $var = 'impression'.$i;
	        $sql = "SELECT `$var`, COUNT(*) AS C FROM `survey2` WHERE create_date BETWEEN '$begin' AND '$end' GROUP BY `$var` ORDER BY `$var`;";
	        $res = $this->db->prepare($sql);
	        $res->execute();
	        for($j=0; $j<$res->rowCount(); $j++){
	            $row = $res->fetch(); 
	            if($row[$var]!=NULL){   
	                $sql = "INSERT INTO survey2_2_result(`device_id`, `impression`) VALUES
	                        ('$row[$var]', '$row[C]')
	                        ON DUPLICATE KEY UPDATE `impression` = `impression` + '$row[C]' ";
	                $res2 = $this->db->prepare($sql);
	                $res2->execute();
	            }
	        }

	    }
	    //處理install
	    $sql = "UPDATE `survey2_2_result` SET  `install` =  '0' ";
	    $res = $this->db->prepare($sql);
	    $res->execute();
	    for ($i = 1; $i < 6; $i++) {
	        $var = 'install'.$i;
	        $sql = "SELECT `$var`, COUNT(*) AS C FROM `survey2` WHERE create_date BETWEEN '$begin' AND '$end' GROUP BY `$var` ORDER BY `$var`;";
	        $res = $this->db->prepare($sql);
	        $res->execute();
	        for($j=0; $j<$res->rowCount(); $j++){
	            $row = $res->fetch();
	            if($row[$var]!=NULL){
	                $sql = "INSERT INTO survey2_2_result(`device_id`, `install`) VALUES
	                        ('$row[$var]', '$row[C]')
	                        ON DUPLICATE KEY UPDATE `install` = `install` + '$row[C]' ";
	                $res2 = $this->db->prepare($sql);
	                $res2->execute();
	            }
	        }
	    }

	    //處理subscript
	    $sql = "UPDATE `survey2_2_result` SET  `subscript` =  '0' ";
	    $res = $this->db->prepare($sql);
	    $res->execute();
	    for ($i = 1; $i < 4; $i++) {
	        $var = 'subscription'.$i;
	        $sql = "SELECT `$var`, COUNT(*) AS C FROM `survey2` WHERE create_date BETWEEN '$begin' AND '$end' GROUP BY `$var` ORDER BY `$var`;";
	        $res = $this->db->prepare($sql);
	        $res->execute();
	        if($res->rowCount()!=0){
	            for($j=0; $j<$res->rowCount(); $j++){
	                $row = $res->fetch();
	                if($row[$var]!=NULL){	                	
	                    $sql = "INSERT INTO survey2_2_result(`device_id`, `subscript`) VALUES
	                        ('$row[$var]', '$row[C]')
	                        ON DUPLICATE KEY UPDATE `subscript` = `subscript` + '$row[C]' ";
	                    $res2 = $this->db->prepare($sql);
	                    $res2->execute();
	                }
	            }
	        }
	    }

	    //處理choise  累計所有的
	    $sql = "SELECT COUNT( choise ) AS D, `choise` 
	    		FROM `survey2_2`, `survey2` 
	    		WHERE `survey2_2`.`id` = `survey2`.`survey2_id` AND 
	    			  `survey2`.`create_date` BETWEEN '$begin' AND '$end' 
	    		GROUP BY `choise` 
	    		ORDER BY `choise`;";  
	    //算出choise中有多少種機器 並有幾個人投
	    $res = $this->db->prepare($sql);
	    $res->execute();
	    for($i=0; $i<$res->rowCount(); $i++){
	        $R = [0,0,0,0,0,0,0];
	        $row = $res->fetch();
	        $sql2 = "INSERT INTO survey2_2_result(`device_id`, `choose`) VALUES('$row[choise]', '$row[D]')  
	                ON DUPLICATE KEY UPDATE `choose` = '$row[D]' ";                                     
	                //將資料新增上去
	        $res2 = $this->db->prepare($sql2);
	        $res2->execute();
	        $device = $row['choise'];
	        $sql3 = "SELECT  `survey2_2`.`choise` AS D, `consider`.`choose` 
	        		FROM  `survey2_2` ,  `consider` , `survey2`
	                WHERE  `survey2_2`.`choise` = '$device' 
	                AND `survey2_2`.`id` = `survey2`.`survey2_id`
	                AND  `survey2_2`.`consider` =  `consider`.`consider_id`
	                AND create_date BETWEEN '$begin' AND '$end';";    
	                //get the consider of the choise
	        $res3 = $this->db->prepare($sql3);
	        $res3->execute();
	        for($j = 0;$j<$res3->rowCount();$j++){
	            $row3 = $res3->fetch();
	            $R[$row3['choose']-1]++;
	        }
	        $sql4 = "INSERT INTO survey2_2_result(`device_id`, `consider1`,`consider2`,`consider3`,`consider4`,`consider5`,`consider6`,`consider7`) 
	                VALUES('$device', '$R[0]','$R[1]','$R[2]','$R[3]','$R[4]','$R[5]','$R[6]')
	                ON DUPLICATE KEY UPDATE  `consider1` = '$R[0]' , `consider2` = '$R[1]', `consider3` = '$R[2]',  `consider4` = '$R[3]', 
	                    `consider5` = '$R[4]', `consider6` = '$R[5]', `consider7` = '$R[6]'";
	        $res4 = $this->db->prepare($sql4);
	        $res4->execute();
	    }

	    return $data;
	}

	function dealSurvey($begin,$end){
		$field  = ['gender', 'age', 'education', 'career', 'location', 'house_type', 'family_type', 'experience', 'salary', 'family_member', 'know_way'];
	    $ansNum = [2, 7, 4, 12, 6, 4, 6, 6, 7, 3, 6];
	    $len    = count($ansNum);
	    $data   = array();

	    for ($i = 0; $i < $len; $i++) {
	        $table = $field[$i];
	        $ans   = $ansNum[$i];

	        while ($ans > 0) {
	            // 統計每個答案的票數
	            $sql = "SELECT $table , COUNT($table) AS count
	                    FROM  survey
	                    WHERE  $table = :ans AND create_date BETWEEN '$begin' AND '$end';";
	            $res = $this->db->prepare($sql);
	            $res->bindParam(':ans', $ans, PDO::PARAM_INT);

	            if ($res->execute()) {
	                $res          = $res->fetchAll();
	                $temp['$ans'] = $res[0]['count'];
	            } else {
	                $temp['$ans'] = 0;
	            }
	            $data[$i][$ans] = $temp['$ans'];
	            $ans--;
	        }
	        //$data[$i] = $temp;
	    }

    	return $data;
	}

}

?>