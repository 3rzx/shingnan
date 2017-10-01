<?php
/*
field
zone
mode
device
 */

header("Content-Type:text/html; charset=utf-8");
include_once "conf.php";
mysql_query("SET NAMES UTF8");

if (isset($_REQUEST['data'])) {
    $data = $_REQUEST['data'];
} else {
    echo $_SERVER['REQUEST_URI'];
}
//$data = 'mode';

if ($data == "888") {
	$filename = '../web/media/project/project1/zone/photo_1-5638920671c92.jpg';
	if (file_exists($filename)) {
		echo $filename . ': ' . filesize($filename) . ' bytes';
	} else {
		echo "The file $filename does not exist";
	}
}

if ($data == "zone") {
    $sql      = "SELECT zone_id, name, name_en, introduction, introduction_en, hint, field_id, guide_voice, guide_voice_en, photo, photo_vertical, lastupdate_date FROM `zone` ORDER BY lastupdate_date DESC";
    $result   = mysql_query($sql);
    $i        = 0;
    $list_arr = array();
	//$photosize = array();
	//$photo_verticalsize = array();
    while ($row = mysql_fetch_array($result)) {
		//if ($row['photo'] != NULL and $row['photo_vertical'] != NULL ){
		/*$photo2 = str_replace ("..","../web",$row['photo']);
		$photo_vertical2 = str_replace ("..","../web",$row['photo_vertical']);
		if ($row['photo'] == NULL or $row['photo_vertical'] == NULL){
			$list_arr[$i] = $row;
			$i++;
		}
		if (!file_exists($photo2)) 
			break;
		if (!file_exists($photo_vertical2)) 
			break;*/
		if($row['photo'] != NULL){
			$photo2 = str_replace ("..","../web",$row['photo']);
			if (file_exists($photo2)) {
				$photosize = filesize($photo2);
			}
		}
		else{
			$photosize = NULL;
		}
		if($row['photo_vertical'] != NULL){
			$photo_vertical2 = str_replace ("..","../web",$row['photo_vertical']);
			if (file_exists($photo_vertical2)) {
				$photo_verticalsize = filesize($photo_vertical2);
			}
		}
		else{
			$photo_verticalsize = NULL;
		}
		if($row['guide_voice'] != NULL){
			$voice2 = str_replace ("..","../web",$row['guide_voice']);
			if (file_exists($voice2)) {
				$voicesize = filesize($voice2);
			}
		}
		else{
			$voicesize = NULL;
		}
		if($row['guide_voice_en'] != NULL){
			$guide_voice_en2 = str_replace ("..","../web",$row['guide_voice_en']);
			if (file_exists($guide_voice_en2)) {
				$guide_voice_ensize = filesize($guide_voice_en2);
			}
		}
		else{
			$guide_voice_ensize = NULL;
		}
		
		$row['photo_size'] = floor($photosize/1024);
		$row['photo_vertical_size'] = floor($photo_verticalsize/1024);
		$row['guide_voice_size'] = floor($voicesize/1024);
		$row['guide_voice_en_size'] = floor($guide_voice_ensize/1024);
		
		$list_arr[$i] = $row;
		$i++;
		
					     
    }
	/*for($j = 0; $j < count($list_arr); $j++){
		//var_dump($list_arr[$j]["photo_vertical"]);
		if($list_arr[$j]['photo'] != NULL){
			$photo2 = str_replace ("..","../web",$list_arr[$j]['photo']);
			if (file_exists($photo2)) {
			$photosize[$j] = filesize($photo2);
			}
		}
		else{
			$photosize[$j] = NULL;
		}
		
		if($list_arr[$j]['photo_vertical'] != NULL){
			$photo_vertical2 = str_replace ("..","../web",$list_arr[$j]['photo_vertical']);
			if (file_exists($photo_vertical2)) {
			$photo_verticalsize[$j] = filesize($photo_vertical2);
			}
		}
		else{
			$photo_verticalsize[$j] = NULL;
		}
		
		//var_dump($photosize);
		//var_dump($photo_verticalsize);	
	}
	$list_arr[$i] = $photosize;
	$list_arr[$i+1] = $photo_verticalsize;
	*/
    echo (json_encode($list_arr));
    $i = 0;

} elseif ($data == "beacon") {
    //$sql = "SELECT beacon_id, mac_addr, name, power, status, zone, x, y FROM `beacon` ";
    /*$sql = "SELECT `beacon`.`beacon_id`, `beacon`.`mac_addr`, `beacon`.`name`, `beacon`.`power`, `beacon`.`status`, `beacon`.`zone`, `beacon`.`x`,
    `beacon`.`y`, `Fid`.`field_id` AS  `field_id`  FROM `beacon`, ( SELECT  `zone`.`field_id`, `zone`.`zone_id` FROM  `zone` ) AS  `Fid` WHERE  `beacon`.`zone` =  `Fid`.`zone_id` ";
     */
    $sql = "SELECT `beacon`.`beacon_id`, `beacon`.`mac_addr`, `beacon`.`name`, `beacon`.`power`, `beacon`.`status`, `beacon`.`zone`, `beacon`.`x`, `beacon`.`lastupdate_date`,
	`beacon`.`y`, `Fid`.`field_id` AS  `field_id`, `Fname`.`name` AS `field_name`  FROM `beacon`,
	( SELECT  `zone`.`field_id`, `zone`.`zone_id` FROM  `zone` ) AS  `Fid` , ( SELECT  `field_map`.`field_map_id` ,  `field_map`.`name` FROM  `field_map` ) AS  `Fname`
	WHERE  `beacon`.`zone` =  `Fid`.`zone_id` AND `Fname`.`field_map_id` =  `Fid`.`field_id` ORDER BY `beacon`.`lastupdate_date` DESC";
    $result   = mysql_query($sql);
    $i        = 0;
    $list_arr = array();
    while ($row = mysql_fetch_array($result)) {
        $list_arr[$i] = $row;
        $i++;
    }
    echo (json_encode($list_arr));

} elseif ($data == "company") {
    $sql      = "SELECT company_id, name, tel, fax, addr, web, qrcode, lastupdate_date FROM `company` ORDER BY lastupdate_date DESC";
    $result   = mysql_query($sql);
    $i        = 0;
    $list_arr = array();
    while ($row = mysql_fetch_array($result)) {
			$list_arr[$i] = $row;
			$i++;
    }
    echo (json_encode($list_arr));
} elseif ($data == "device") {
    $sql      = "SELECT device_id, name, name_en, introduction, introduction_en, hint, mode_id, company_id, read_count, guide_voice, guide_voice_en, photo, photo_vertical, lastupdate_date FROM `device` ORDER BY lastupdate_date DESC";
    $result   = mysql_query($sql);
    $i        = 0;
    $list_arr = array();
    while ($row = mysql_fetch_array($result)) {
		/*if ($row['photo'] != NULL and $row['photo_vertical'] != NULL ){
			$list_arr[$i] = $row;
			$i++;			
		}*/
		if($row['photo'] != NULL){
			$photo2 = str_replace ("..","../web",$row['photo']);
			if (file_exists($photo2)) {
				$photosize = filesize($photo2);
			}
		}
		else{
			$photosize = NULL;
		}
		if($row['photo_vertical'] != NULL){
			$photo_vertical2 = str_replace ("..","../web",$row['photo_vertical']);
			if (file_exists($photo_vertical2)) {
				$photo_verticalsize = filesize($photo_vertical2);
			}
		}
		else{
			$photo_verticalsize = NULL;
		}
		if($row['guide_voice'] != NULL){
			$voice2 = str_replace ("..","../web",$row['guide_voice']);
			if (file_exists($voice2)) {
				$voicesize = filesize($voice2);
			}
		}
		else{
			$voicesize = NULL;
		}
		if($row['guide_voice_en'] != NULL){
			$guide_voice_en2 = str_replace ("..","../web",$row['guide_voice_en']);
			if (file_exists($guide_voice_en2)) {
				$guide_voice_ensize = filesize($guide_voice_en2);
			}
		}
		else{
			$guide_voice_ensize = NULL;
		}
		
		$row['photo_size'] = floor($photosize/1024);
		$row['photo_vertical_size'] = floor($photo_verticalsize/1024);
		$row['guide_voice_size'] = floor($voicesize/1024);
		$row['guide_voice_en_size'] = floor($guide_voice_ensize/1024);
		
		$list_arr[$i] = $row;
		$i++;
    }
    echo (json_encode($list_arr));

} elseif ($data == "field_map") {
    $sql      = "SELECT field_map_id, name, name_en, project_id, introduction, map_bg, photo, photo_vertical, map_svg, map_svg_en, lastupdate_date FROM `field_map` ORDER BY lastupdate_date DESC";
    $result   = mysql_query($sql);
    $i        = 0;
    $list_arr = array();
    while ($row = mysql_fetch_array($result)) {
		if($row['photo'] != NULL){
			$photo2 = str_replace ("..","../web",$row['photo']);
			if (file_exists($photo2)) {
				$photosize = filesize($photo2);
			}
		}
		else{
			$photosize = NULL;
		}
		if($row['photo_vertical'] != NULL){
			$photo_vertical2 = str_replace ("..","../web",$row['photo_vertical']);
			if (file_exists($photo_vertical2)) {
				$photo_verticalsize = filesize($photo_vertical2);
			}
		}
		else{
			$photo_verticalsize = NULL;
		}
		if($row['map_svg'] != NULL){
			$map_svg2 = str_replace ("..","../web",$row['map_svg']);
			if (file_exists($map_svg2)) {
				$map_svg_size = filesize($map_svg2);
			}
		}
		else{
			$map_svg_size = NULL;
		}
		if($row['map_svg_en'] != NULL){
			$map_svg_en2 = str_replace ("..","../web",$row['map_svg_en']);
			if (file_exists($map_svg_en2)) {
				$map_svg_en_size = filesize($map_svg_en2);
			}
		}
		else{
			$map_svg_en_size = NULL;
		}
		if($row['map_bg'] != NULL){
			$map_bg2 = str_replace ("..","../web",$row['map_bg']);
			if (file_exists($map_bg2)) {
				$map_bg_size = filesize($map_bg2);
			}
		}
		else{
			$map_bg_size = NULL;
		}
		
		$row['photo_size'] = floor($photosize/1024);
		$row['photo_vertical_size'] = floor($photo_verticalsize/1024);
		$row['map_svg_size'] = floor($map_svg_size/1024);
		$row['map_svg_en_size'] = floor($map_svg_en_size/1024);
		$row['map_bg_size'] = floor($map_bg_size/1024);
		
        $list_arr[$i] = $row;
        $i++;
    }
    echo (json_encode($list_arr));

} elseif ($data == "path") {
    //$sql = "SELECT hipster_template_id, name, template FROM `hipster_template` ";
    //$sql = "SELECT * FROM path ,choose_path where path.svg_id =choose_path.svg_id ";
    //$sql = "SELECT * FROM path UNION SELECT * FROM choose_path ";
    $choose_path_id = 1;
	$routefile = fopen('../web/pathUsed.txt', "r");
	if ($routefile) {
		while (!feof($routefile)) {
			$choose_path_id = fgets($routefile, 10);
			//echo $choose.'123';
		/*}
		fclose($routefile);
	}*/

    $sql = "SELECT `choose_path`.`choose_path_id`,  `choose_path`.`order`, `choose_path`.`svg_id`, `choose_path`.`lastupdate_date` ,`path`.`start` ,  `Sname`.`name` AS  `Sn` ,  `path`.`end` ,  `Ename`.`name` AS  `En`
FROM  `path` , `choose_path`,
( SELECT  `zone`.`name` ,  `zone`.`zone_id` FROM  `zone` ) AS  `Sname` ,
( SELECT  `zone`.`name` ,  `zone`.`zone_id` FROM  `zone` ) AS  `Ename`
WHERE  `path`.`start` =  `Sname`.`zone_id`
AND  `path`.`end` =  `Ename`.`zone_id`
AND `choose_path`.`svg_id` = `path`.`svg_id` AND `choose_path`.`choose_path_id` = '$choose_path_id' ORDER BY `choose_path`.`order` ASC";
    $result   = mysql_query($sql);
    $i        = 0;
    $list_arr = array();
    while ($row = mysql_fetch_array($result)) {
        $list_arr[$i] = $row;
        $i++;
    }
	if($choose_path_id)
		echo (json_encode($list_arr));

	}
		fclose($routefile);
	}
	
	
} elseif ($data == "hipster_template") {
    $sql      = "SELECT hipster_template_id, name, template, lastupdate_date FROM `hipster_template` ORDER BY lastupdate_date DESC";
    $result   = mysql_query($sql);
    $i        = 0;
    $list_arr = array();
    while ($row = mysql_fetch_array($result)) {
		if($row['template'] != NULL){
			$template2 = str_replace ("..","../web",$row['template']);
			if (file_exists($template2)) {
				$templatesize = filesize($template2);
			}
		}
		else{
			$templatesize = NULL;
		}
		$row['template_size'] = floor($templatesize/1024);
		
        $list_arr[$i] = $row;
        $i++;
    }
    echo (json_encode($list_arr));

} elseif ($data == "hipster_text") {
    $sql      = "SELECT hipster_text_id, content, content_en, lastupdate_date FROM `hipster_text` ORDER BY lastupdate_date DESC";
    $result   = mysql_query($sql);
    $i        = 0;
    $list_arr = array();
    while ($row = mysql_fetch_array($result)) {
        $list_arr[$i] = $row;
        $i++;
    }
    echo (json_encode($list_arr));

} elseif ($data == "mode") {
    $sql      = "SELECT mode_id, name, name_en, introduction, introduction_en, like_count, time_total, zone_id, guide_voice, guide_voice_en, video, splash_bg_vertical, splash_fg_vertical, splash_blur_vertical, splash_bg, splash_fg, lastupdate_date, splash_blur FROM `mode` ORDER BY lastupdate_date DESC";
    $result   = mysql_query($sql);
    $i        = 0;
    $list_arr = array();
    while ($row = mysql_fetch_array($result)) {
		if($row['guide_voice'] != NULL){
			$guide_voice2 = str_replace ("..","../web",$row['guide_voice']);
			if (file_exists($guide_voice2)) {
				$guide_voicesize = filesize($guide_voice2);
			}
		}
		else{
			$guide_voicesize = NULL;
		}
		if($row['guide_voice_en'] != NULL){
			$guide_voice_en2 = str_replace ("..","../web",$row['guide_voice_en']);
			if (file_exists($guide_voice_en2)) {
				$guide_voice_ensize = filesize($guide_voice_en2);
			}
		}
		else{
			$guide_voice_ensize = NULL;
		}
		if($row['splash_bg'] != NULL){
			$splash_bg2 = str_replace ("..","../web",$row['splash_bg']);
			if (file_exists($splash_bg2)) {
				$splash_bgsize = filesize($splash_bg2);
			}
		}
		else{
			$splash_bgsize = NULL;
		}
		if($row['splash_bg_vertical'] != NULL){
			$splash_bg_vertical2 = str_replace ("..","../web",$row['splash_bg_vertical']);
			if (file_exists($splash_bg_vertical2)) {
				$splash_bg_verticalsize = filesize($splash_bg_vertical2);
			}
		}
		else{
			$splash_bg_verticalsize = NULL;
		}
		if($row['splash_fg'] != NULL){
			$splash_fg2 = str_replace ("..","../web",$row['splash_fg']);
			if (file_exists($splash_fg2)) {
				$splash_fgsize = filesize($splash_fg2);
			}
		}
		else{
			$splash_fgsize = NULL;
		}
		if($row['splash_fg_vertical'] != NULL){
			$splash_fg_vertical2 = str_replace ("..","../web",$row['splash_fg_vertical']);
			if (file_exists($splash_fg_vertical2)) {
				$splash_fg_verticalsize = filesize($splash_fg_vertical2);
			}
		}
		else{
			$splash_fg_verticalsize = NULL;
		}
		if($row['splash_blur'] != NULL){
			$splash_blur2 = str_replace ("..","../web",$row['splash_blur']);
			if (file_exists($splash_blur2)) {
				$splash_blursize = filesize($splash_blur2);
			}
		}
		else{
			$splash_blursize = NULL;
		}
		if($row['splash_blur_vertical'] != NULL){
			$splash_blur_vertical2 = str_replace ("..","../web",$row['splash_blur_vertical']);
			if (file_exists($splash_blur_vertical2)) {
				$splash_blur_verticalsize = filesize($splash_blur_vertical2);
			}
		}
		else{
			$splash_blur_verticalsize = NULL;
		}
		
		
		$row['guide_voice_size'] = floor($guide_voicesize/1024);
		$row['guide_voice_en_size'] = floor($guide_voice_ensize/1024);
		$row['splash_bg_size'] = floor($splash_bgsize/1024);
		$row['splash_bg_vertical_size'] = floor($splash_bg_verticalsize/1024);
		$row['splash_fg_size'] = floor($splash_fgsize/1024);
		$row['splash_fg_vertical_size'] = floor($splash_fg_verticalsize/1024);
		$row['splash_blur_size'] = floor($splash_blursize/1024);
		$row['splash_blur_vertical_size'] = floor($splash_blur_verticalsize/1024);
		
        $list_arr[$i] = $row;
        $i++;
    }
    echo (json_encode($list_arr));

} else {
    echo $data;
}
; /*
$abspath = $_SERVER['DOCUMENT_ROOT'];
$proj = $_REQUEST['proj'];
$proj = 'project1';
$path = $abspath . '/web/media/project/' . $proj;
echo $path ;
echo '<br><br>';

$pathfield = $path . '/field';
$filefield = array_diff(scandir($pathfield), array('.', '..'));

if($filefield){
echo json_encode($filefield);
}
else{
echo 'nofield';
}
echo '<br><br>';
 */
