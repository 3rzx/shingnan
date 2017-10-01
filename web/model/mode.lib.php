<?php
// initialize
require_once HOME_DIR . 'configs/config.php';
require_once 'upload.func.php';
/**
 * mode列別
 */
class mode{
    // database object
    public $db = null;
    // smarty template object
    public $smartyTemplate = null;
    // success messages
    public $msg = '';
    // error messages
    public $error = '';

    /**
     * class constructor
     * @DateTime 2016-09-12
     */
    public function __construct()    {
        session_start();
        // instantiate the pdo object
        $this->db = dbSetup::getDbConn();
        // instantiate the template object
        $this->smartyTemplate = new SmartyConfig();
        // php version is less than 5.4.0
        if (PHP_VERSION_ID < 50400) {
            // 登記 Session 變數名稱
            session_register('error');
            session_register('msg');
        }
        $this->error = '';
        $this->msg = '';
    }
   
    /**
     * 新增裝置表單
     * @DateTime 2016-09-12
     */
    public function addModePrepare($input){
        if ($_SESSION['isLogin'] == true) {
            try {
                $zone = $input['zoneID'];

                $this->smartyTemplate->assign('zone', $zone);
                $this->smartyTemplate->assign('error', $this->error);
                $this->smartyTemplate->assign('msg', $this->msg);

                $this->smartyTemplate->display('mode/modeAdd.html');

            } catch (PDOException $e) {
                print "Error!: " . $e->getMessage();
                $this->smartyTemplate->assign('error', $e->getMessage());
            }
        } else {
            header('Location:../controller/userController.php?action=viewLogin');
        }
    }


    /**
     * 新增Mode
     * @DateTime 2016-09-11
     */
    public function addMode($input){
        if ($_SESSION['isLogin'] == true) {
            try {
                $zone = $input['zoneID'];
                if(strlen($input['modeNameEn']) == 0)
                    $input['modeNameEn'] = null;

                $now = date('Y-m-d H:i:s');
                $sql = "INSERT INTO mode (name, name_en, introduction, introduction_en, zone_id, create_date, lastupdate_date)
                            VALUES (:name, :nameEn, :introduction, :introduction_en, :zone, :createDate, :lastupdateDate)";
                $res = $this->db->prepare($sql);
                $res->bindParam(':name', $input['modeName'], PDO::PARAM_STR);
                $res->bindParam(':nameEn', $input['modeNameEn'], PDO::PARAM_STR);
                $res->bindParam(':introduction', $input['modeIntroduction'], PDO::PARAM_STR);
                $res->bindParam(':introduction_en', $input['modeIntroductionEn'], PDO::PARAM_STR);
                $res->bindParam(':zone', $zone, PDO::PARAM_INT);
                $res->bindParam(':createDate', $now, PDO::PARAM_STR);
                $res->bindParam(':lastupdateDate', $now, PDO::PARAM_STR);
                if ($res->execute()) {
                    $modeID   = $this->db->lastInsertId();
                    $this->msg = '新增成功';

                    $sql = "SELECT field_map.project_id, zone.field_id, mode.zone_id, mode.mode_id
                            FROM field_map, zone, mode
                            WHERE field_map.field_map_id = zone.field_id
                            AND zone.zone_id = mode.zone_id
                            AND mode.mode_id = $modeID";
                    $res = $this->db->prepare($sql);
                    $res->execute();
                    $res = $res->fetchAll();
                    $projectID = $res[0]['project_id'];
                    //$fieldID = $res[0]['field_id'];
                    $zoneID = $res[0]['zone_id'];
                    //$uploadPath = '../media/project/project' . $projectID . '/zone'. $zoneID . '/mode' . $modeID . '/device' . $deviceID ;
                    $uploadPath = '../media/project/project' . $projectID . '/zone';
                    if (!file_exists($uploadPath) && !is_dir($uploadPath)) {
                        // create project folder with 777 permissions
                        mkdir($uploadPath);
                        chmod($uploadPath, 0777);
                    }
                    if ($_FILES['modeGuideVoice']['error'] == 0) {
                        $fileInfo = $_FILES['modeGuideVoice'];
                        $modeGuideVoice = uploadFile($fileInfo, $uploadPath);

                        $sql = "UPDATE mode
                                SET guide_voice = :guideVoice
                                WHERE mode_id = :modeID";
                        $res = $this->db->prepare($sql);
                        $res->bindParam(':guideVoice', $modeGuideVoice, PDO::PARAM_STR);
                        $res->bindParam(':modeID', $modeID, PDO::PARAM_INT);
                        $res->execute();
                    }
                    if ($_FILES['modeGuideVoiceEn']['error'] == 0) {
                        $fileInfo = $_FILES['modeGuideVoiceEn'];
                        $modeGuideVoiceEn = uploadFile($fileInfo, $uploadPath);

                        $sql = "UPDATE mode
                                SET guide_voice_en = :guideVoiceEn
                                WHERE mode_id = :modeID";
                        $res = $this->db->prepare($sql);
                        $res->bindParam(':guideVoiceEn', $modeGuideVoiceEn, PDO::PARAM_STR);
                        $res->bindParam(':modeID', $modeID, PDO::PARAM_INT);
                        $res->execute();
                    }
                    if (strlen($input['modeVideo']) != 0) {
                        $sql = "UPDATE mode
                                SET video = :modeVideo
                                WHERE mode_id = :modeID";
                        $res = $this->db->prepare($sql);
                        $res->bindParam(':modeVideo', $input['modeVideo'], PDO::PARAM_STR);
                        $res->bindParam(':modeID', $modeID, PDO::PARAM_INT);
                        $res->execute();
                    }
                    if ($_FILES['modeBG']['error'] == 0) {
                        $fileInfo = $_FILES['modeBG'];
                        $modeBG = uploadFile($fileInfo, $uploadPath);

                        $sql = "UPDATE mode
                                SET splash_bg = :modeBG
                                WHERE mode_id = :modeID";
                        $res = $this->db->prepare($sql);
                        $res->bindParam(':modeBG', $modeBG, PDO::PARAM_STR);
                        $res->bindParam(':modeID', $modeID, PDO::PARAM_INT);
                        $res->execute();
                    }
                    if ($_FILES['modeBGVertical']['error'] == 0) {
                        $fileInfo = $_FILES['modeBGVertical'];
                        $modeBGVertical = uploadFile($fileInfo, $uploadPath);

                        $sql = "UPDATE mode
                                SET splash_bg_vertical = :modeBGVertical
                                WHERE mode_id = :modeID";
                        $res = $this->db->prepare($sql);
                        $res->bindParam(':modeBGVertical', $modeBGVertical, PDO::PARAM_STR);
                        $res->bindParam(':modeID', $modeID, PDO::PARAM_INT);
                        $res->execute();
                    }
                    if ($_FILES['modeFG']['error'] == 0) {
                        $fileInfo = $_FILES['modeFG'];
                        $modeFG = uploadFile($fileInfo, $uploadPath);

                        $sql = "UPDATE mode
                                SET splash_fg = :modeFG
                                WHERE mode = :modeID";
                        $res = $this->db->prepare($sql);
                        $res->bindParam(':modeFG', $modeFG, PDO::PARAM_STR);
                        $res->bindParam(':modeID', $modeID, PDO::PARAM_INT);
                        $res->execute();
                    }
                    if ($_FILES['modeFGVertical']['error'] == 0) {
                        $fileInfo = $_FILES['modeFGVertical'];
                        $modeFGVertical = uploadFile($fileInfo, $uploadPath);

                        $sql = "UPDATE mode
                                SET splash_fg_vertical = :modeFGVertical
                                WHERE mode_id = :modeID";
                        $res = $this->db->prepare($sql);
                        $res->bindParam(':modeFGVertical', $modeFGVertical, PDO::PARAM_STR);
                        $res->bindParam(':modeID', $modeID, PDO::PARAM_INT);
                        $res->execute();
                    }
                    if ($_FILES['modeBL']['error'] == 0) {
                        $fileInfo = $_FILES['modeBL'];
                        $modeBL = uploadFile($fileInfo, $uploadPath);

                        $sql = "UPDATE mode
                                SET splash_blur = :modeBL
                                WHERE mode_id = :modeID";
                        $res = $this->db->prepare($sql);
                        $res->bindParam(':modeBL', $modeBL, PDO::PARAM_STR);
                        $res->bindParam(':modeID', $modeID, PDO::PARAM_INT);
                        $res->execute();
                    }
                    if ($_FILES['modeBLVertical']['error'] == 0) {
                        $fileInfo = $_FILES['modeBLVertical'];
                        $modeBLVertical = uploadFile($fileInfo, $uploadPath);

                        $sql = "UPDATE zone
                                SET splash_blur_vertical = :modeBLVertical
                                WHERE mode_id = :modeID";
                        $res = $this->db->prepare($sql);
                        $res->bindParam(':modeBLVertical', $modeBLVertical, PDO::PARAM_STR);
                        $res->bindParam(':modeID', $modeID, PDO::PARAM_INT);
                        $res->execute();
                    }
                    if ($res) { 
                        $this->detailMode(
                                array(
                                    'modeID' => $modeID,
                                )
                            );
                    } else {   //失敗回到Add 顯示錯誤
                        $error = $res->errorInfo();
                        $this->error = $error[0];
                        $this->smartyTemplate->assign('error', $this->error);
                        $this->smartyTemplate->assign('msg', $this->msg);
                        $this->addModePrepare(
                            array(
                                'zoneID' => $zoneID,
                            )
                        );
                    }
                }else {  //失敗回到Add 顯示錯誤
                    $error = $res->errorInfo();
                    $this->error = $error[1];
                    $this->smartyTemplate->assign('error', $this->error);
                    $this->smartyTemplate->assign('msg', $this->msg);
                    $this->addModePrepare(
                        array(
                            'zoneID' => $zoneID,
                        )
                    );
                }                      
            } catch (PDOException $e) {
                print "Error!: " . $e->getMessage();
                $this->smartyTemplate->assign('error', $e->getMessage());
            }
        } else {
            header('Location:../controller/userController.php?action=viewLogin');
        }
    }

    /**
     * mode詳細資料
     * @DateTime 2016-09-08
     * @param array $input[mode資料]
     */
    public function detailMode($input){
        if ($_SESSION['isLogin'] == true) {
            try {
                $mode = $input['modeID'];
                $sql = "SELECT * FROM mode
                        WHERE mode_id = :modeID";
                $res = $this->db->prepare($sql);
                $res->bindParam(':modeID', $mode, PDO::PARAM_INT);
                $res->execute();
                $modeData = $res->fetch();
                $video = $modeData['video'];
                if(strlen($video) != 0){ 
                    $str_sec = explode("?v=",$video);
                    $modeVideo = $str_sec[1];
                }else{
                    $modeVideo="";
                }


                $sql2 = 'SELECT device.device_id, device.name AS DName, device.name_en, device.company_id, company.name AS CName,
                        device.create_date, device.lastupdate_date
                        FROM device
                        INNER JOIN company ON company.company_id = device.company_id
                        WHERE device.mode_id = :modeID
                        ORDER BY device_id';                //取得device資訊
                $res2 = $this->db->prepare($sql2);
                $res2->bindParam(':modeID', $mode, PDO::PARAM_INT);
                $res2->execute();
                $deviceData = $res2->fetchAll();

                $this->smartyTemplate->assign('modeData', $modeData);
                $this->smartyTemplate->assign('modeVideo',$modeVideo);
                $this->smartyTemplate->assign('deviceData', $deviceData);
                
                if (isset($input['error'])) {
                    $this->error = $input['error'];
                }
                if (isset($input['msg'])) {
                    $this->msg = $input['msg'];
                }
                $this->smartyTemplate->assign('error', $this->error);
                $this->smartyTemplate->assign('msg', $this->msg);

                $this->smartyTemplate->display('mode/modeDetail.html');

            } catch (PDOException $e) {
                print "Error!: " . $e->getMessage();
                $this->smartyTemplate->assign('error', $e->getMessage());
            }
        } else {
            header('Location:../controller/userController.php?action=viewLogin');
        }

    }

    /**
     * mode編輯表單
     * @DateTime 2016-09-10
     * @param array $input[mode資料]
     */

    function updateModePrepare($input){
        if ($_SESSION['isLogin'] == true) {
            try{
                $sql = "SELECT * FROM mode WHERE mode_id = :modeID";  //取得裝置資訊
                $res = $this->db->prepare($sql);
                $res->bindParam(':modeID', $input['modeID'], PDO::PARAM_INT);
                $res->execute();
                $modeData = $res->fetch();
                $video = $modeData['video'];
                if(strlen($video) != 0){ 
                    $str_sec = explode("?v=",$video);
                    $modeVideo = $str_sec[1];
                }else{
                    $modeVideo="";
                } 

                $sql = 'SELECT zone_id, name FROM zone';    //取得全部zone資訊
                $res = $this->db->prepare($sql);
                $res->execute();
                $allZoneData = $res->fetchAll();
                
                $this->smartyTemplate->assign('modeData', $modeData);
                $this->smartyTemplate->assign('modeVideo',$modeVideo);
                $this->smartyTemplate->assign('allZoneData', $allZoneData);
                
                $this->smartyTemplate->assign('error', $this->error);
                $this->smartyTemplate->assign('msg', $this->msg);
                $this->smartyTemplate->display('mode/modeEdit.html');

            } catch (PDOException $e) {
                print "Error!: " . $e->getMessage();
                $this->smartyTemplate->assign('error', $e->getMessage());
            }
        } else {
            header('Location:../controller/userController.php?action=viewLogin');
        }
    }

    /**
     * mode編輯
     * @DateTime 2016-09-11
     * @param array $input[mode資料]
     */
    function updateMode($input){
        if ($_SESSION['isLogin'] == true) {
            try{
                $modeID = $input['modeID'];
                if(strlen($input['modeNameEn']) == 0)
                    $input['modeNameEn'] = null;

                $now = date('Y-m-d H:i:s');
                $sql = 'UPDATE mode SET name = :name, name_en = :nameEn , introduction = :introduction, introduction_en = :introduction_en,
                        zone_id = :zone, lastupdate_date = :lastupdateDate 
                        WHERE mode_id = :modeID';  //取得裝置資訊
                $res = $this->db->prepare($sql);
                $res->bindParam(':modeID', $modeID, PDO::PARAM_INT);
                $res->bindParam(':name', $input['modeName'], PDO::PARAM_STR);
                $res->bindParam(':nameEn', $input['modeNameEn'], PDO::PARAM_STR);
                $res->bindParam(':introduction', $input['modeIntroduction'], PDO::PARAM_STR);
                $res->bindParam(':introduction_en', $input['modeIntroductionEn'], PDO::PARAM_STR);
                $res->bindParam(':zone', $input['modeZone'], PDO::PARAM_INT);
                $res->bindParam(':lastupdateDate', $now, PDO::PARAM_STR);

                if($res->execute()){
                    $this->msg = '更新成功';

                    $sql = "SELECT field_map.project_id, zone.field_id, mode.zone_id, mode.mode_id
                            FROM field_map, zone, mode
                            WHERE field_map.field_map_id = zone.field_id
                            AND zone.zone_id = mode.zone_id
                            AND mode.mode_id = $modeID";
                    $res = $this->db->prepare($sql);
                    $res->execute();
                    $res = $res->fetchAll();
                    $projectID = $res[0]['project_id'];
                    //$fieldID = $res[0]['field_id'];
                    $zoneID = $res[0]['zone_id'];
                    //$uploadPath = '../media/project/project' . $projectID . '/zone'. $zoneID . '/mode' . $modeID . '/device' . $deviceID ;
                    $uploadPath = '../media/project/project' . $projectID . '/zone';
                
                    //找出現有的圖片
                    $sql = "SELECT `splash_bg`, `splash_bg_vertical`, `splash_fg`, `splash_fg_vertical`, 
                                    `splash_blur`, `splash_blur_vertical`, `guide_voice`, `guide_voice_en`, `video`
                            FROM mode
                            WHERE mode_id = $modeID";
                    $res = $this->db->prepare($sql);
                    $res->execute();
                    $row = $res->fetchAll();

                    if ($_FILES['modeGuideVoice']['error'] == 0) {
                        $fileInfo = $_FILES['modeGuideVoice'];
                        $modeGuideVoice = uploadFile($fileInfo, $uploadPath);
                        if ($this->deleteImg($row[0]['guide_voice'])) {
                            $now = date('Y-m-d H:i:s');
                            $sql = "UPDATE mode
                                    SET guide_voice = :modeGuideVoice, lastupdate_date = :lastUpdate
                                    WHERE mode_id = :modeID";
                            $res = $this->db->prepare($sql);
                            $res->bindParam(':modeGuideVoice', $modeGuideVoice, PDO::PARAM_STR);
                            $res->bindParam(':lastUpdate', $now, PDO::PARAM_STR);
                            $res->bindParam(':modeID', $modeID, PDO::PARAM_INT);
                            $res->execute();
                        }
                    }
                    if ($_FILES['modeGuideVoiceEn']['error'] == 0) {
                        $fileInfo = $_FILES['modeGuideVoiceEn'];
                        $modeGuideVoiceEn = uploadFile($fileInfo, $uploadPath);
                        if ($this->deleteImg($row[0]['guide_voice_en'])) {
                            $now = date('Y-m-d H:i:s');
                            $sql = "UPDATE mode
                                    SET guide_voice_en = :modeGuideVoiceEn, lastupdate_date = :lastUpdate
                                    WHERE mode_id = :modeID";
                            $res = $this->db->prepare($sql);
                            $res->bindParam(':modeGuideVoiceEn', $modeGuideVoiceEn, PDO::PARAM_STR);
                            $res->bindParam(':lastUpdate', $now, PDO::PARAM_STR);
                            $res->bindParam(':modeID', $modeID, PDO::PARAM_INT);
                            $res->execute();
                        }
                    }
                    if (strlen($input['modeVideo']) != 0) {
                        $now = date('Y-m-d H:i:s');
                        $sql = "UPDATE mode
                                SET video = :video, lastupdate_date = :lastUpdate
                                WHERE mode_id = :modeID";
                        $res = $this->db->prepare($sql);
                        $res->bindParam(':video', $input['modeVideo'], PDO::PARAM_STR);
                        $res->bindParam(':lastUpdate', $now, PDO::PARAM_STR);
                        $res->bindParam(':modeID', $modeID, PDO::PARAM_INT);
                        $res->execute();
                    }
                    if ($_FILES['modeBG']['error'] == 0) {
                        $fileInfo = $_FILES['modeBG'];
                        $modeBG = uploadFile($fileInfo, $uploadPath);
                        if ($this->deleteImg($row[0]['splash_bg'])) {
                            $now = date('Y-m-d H:i:s');
                            $sql = "UPDATE mode
                                    SET splash_bg = :modeBG, lastupdate_date = :lastUpdate
                                    WHERE mode_id = :modeID";
                            $res = $this->db->prepare($sql);
                            $res->bindParam(':modeBG', $modeBG, PDO::PARAM_STR);
                            $res->bindParam(':lastUpdate', $now, PDO::PARAM_STR);
                            $res->bindParam(':modeID', $modeID, PDO::PARAM_INT);
                            $res->execute();
                        }
                    }
                    if ($_FILES['modeBGVertical']['error'] == 0) {
                        $fileInfo = $_FILES['modeBGVertical'];
                        $modeBGVertical = uploadFile($fileInfo, $uploadPath);
                        if ($this->deleteImg($row[0]['splash_bg_vertical'])) {
                            $now = date('Y-m-d H:i:s');
                            $sql = "UPDATE mode
                                    SET splash_bg_vertical = :modeBGVertical, lastupdate_date = :lastUpdate
                                    WHERE mode_id = :modeID";
                            $res = $this->db->prepare($sql);
                            $res->bindParam(':modeBGVertical', $modeBGVertical, PDO::PARAM_STR);
                            $res->bindParam(':lastUpdate', $now, PDO::PARAM_STR);
                            $res->bindParam(':modeID', $modeID, PDO::PARAM_INT);
                            $res->execute();
                        }
                    }
                    if ($_FILES['modeFG']['error'] == 0) {
                        $fileInfo = $_FILES['modeFG'];
                        $modeFG = uploadFile($fileInfo, $uploadPath);
                        if ($this->deleteImg($row[0]['splash_fg'])) {
                            $now = date('Y-m-d H:i:s');
                            $sql = "UPDATE mode
                                    SET splash_fg = :modeFG, lastupdate_date = :lastUpdate
                                    WHERE mode_id = :modeID";
                            $res = $this->db->prepare($sql);
                            $res->bindParam(':modeFG', $modeFG, PDO::PARAM_STR);
                            $res->bindParam(':lastUpdate', $now, PDO::PARAM_STR);
                            $res->bindParam(':modeID', $modeID, PDO::PARAM_INT);
                            $res->execute();
                        }
                    }
                    if ($_FILES['modeFGVertical']['error'] == 0) {
                        $fileInfo = $_FILES['modeFGVertical'];
                        $modeFGVertical = uploadFile($fileInfo, $uploadPath);
                        if ($this->deleteImg($row[0]['splash_fg_vertical'])) {
                            $now = date('Y-m-d H:i:s');
                            $sql = "UPDATE mode
                                    SET splash_fg_vertical = :modeFGVertical, lastupdate_date = :lastUpdate
                                    WHERE mode_id = :modeID";
                            $res = $this->db->prepare($sql);
                            $res->bindParam(':modeFGVertical', $modeFGVertical, PDO::PARAM_STR);
                            $res->bindParam(':lastUpdate', $now, PDO::PARAM_STR);
                            $res->bindParam(':modeID', $modeID, PDO::PARAM_INT);
                            $res->execute();
                        }
                    }
                    if ($_FILES['modeBL']['error'] == 0) {
                        $fileInfo = $_FILES['modeBL'];
                        $modeBL = uploadFile($fileInfo, $uploadPath);
                        if ($this->deleteImg($row[0]['splash_blur'])) {
                            $now = date('Y-m-d H:i:s');
                            $sql = "UPDATE mode
                                    SET splash_blur = :modeBL, lastupdate_date = :lastUpdate
                                    WHERE mode_id = :modeID";
                            $res = $this->db->prepare($sql);
                            $res->bindParam(':modeBL', $modeBL, PDO::PARAM_STR);
                            $res->bindParam(':lastUpdate', $now, PDO::PARAM_STR);
                            $res->bindParam(':modeID', $modeID, PDO::PARAM_INT);
                            $res->execute();
                        }
                    }
                    if ($_FILES['modeBLVertical']['error'] == 0) {
                        $fileInfo = $_FILES['modeBLVertical'];
                        $modeBLVertical = uploadFile($fileInfo, $uploadPath);
                        if ($this->deleteImg($row[0]['splash_blur_vertical'])) {
                            $now = date('Y-m-d H:i:s');
                            $sql = "UPDATE mode
                                    SET splash_blur_vertical = :modeBLVertical, lastupdate_date = :lastUpdate
                                    WHERE mode_id = :modeID";
                            $res = $this->db->prepare($sql);
                            $res->bindParam(':modeBLVertical', $modeBLVertical, PDO::PARAM_STR);
                            $res->bindParam(':lastUpdate', $now, PDO::PARAM_STR);
                            $res->bindParam(':modeID', $modeID, PDO::PARAM_INT);
                            $res->execute();
                        }
                    }
                    if ($res) {
                        $this->smartyTemplate->assign('error', $this->error);
                        $this->smartyTemplate->assign('msg', $this->msg);
                        $this->detailMode(
                                array(
                                    'modeID' => $modeID,
                                )
                            );
                    } else {
                        $error = $res->errorInfo();
                        $this->msg = '';
                        $this->error = $error[1];
                        $this->smartyTemplate->assign('error', $this->error);
                        $this->smartyTemplate->assign('msg', $this->msg);
                        $this->detailMode(
                            array(
                                'modeID' => $modeID,
                            )
                        );
                    }
                }else{
                    $error = $res->errorInfo();
                    $this->error = $error[1];
                    $this->smartyTemplate->assign('error', $this->error);
                    $this->smartyTemplate->assign('msg', $this->msg);
                    $this->detailMode(
                        array(
                            'modeID' => $modeID,
                        )
                    );
                }

            } catch (PDOException $e) {
                print "Error!: " . $e->getMessage();
                $this->smartyTemplate->assign('error', $e->getMessage());
            }
        } else {
            header('Location:../controller/userController.php?action=viewLogin');
        }
    }

    /**
     * 刪除圖片
     * @DateTime 2016-09-14
     * @param    array     $url [圖片URL]
     * @return   bool           [是否刪除成功]
     */
    public function deleteImg($url){
        if ($url != null) {
            $begin   = strpos($url, '../') + 3;
            $url     = substr($url, $begin);
            $abspath = $_SERVER['DOCUMENT_ROOT'];
            $url     = $abspath . '/web/' . $url;

            if (file_exists($url)) {
                if (unlink($url)) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return true;
            }
        } else {
            return true;
        }
    }

    /**
     * mode刪除
     * @DateTime 2016-09-12
     * @param array $input[modeID]
     */
    function deleteMode($input){
        if ($_SESSION['isLogin'] == true) {
            try{
                $modeID = $input['modeID'];

                $sql = "SELECT zone_id
                        FROM mode
                        WHERE mode_id = $modeID";
                $res = $this->db->prepare($sql);
                $res->execute();
                $zoneData = $res->fetch();

                $sql = "SELECT count(device_id) AS num FROM device WHERE mode_id = $modeID";
                $res = $this->db->prepare($sql);
                $res->bindParam(':modeId', $input['modeID'], PDO::PARAM_INT);
                $res->execute();
                $res = $res->fetch();
                
                if ($res['num'] > 0) {
                    $this->error = '區域中還有其他資料，請先刪除資料';
                    $this->msg   = '';
                    header('Location:../controller/modeController.php?action=detailMode&modeID=' . $modeID . '&error=' . count($res));
                } else {
                     $sql = "SELECT `guide_voice`, `guide_voice_en`, `video`, `splash_bg`, `splash_bg_vertical` 
                                    `splash_fg`, `splash_fg_vertical`, `splash_blur`, `splash_blur_vertical`
                            FROM mode
                            WHERE mode_id = $modeID";
                    $res = $this->db->prepare($sql);
                    $res->execute();
                    $res = $res->fetchAll();
                    //刪除圖片
                    if ($this->deleteImg($res[0]['guide_voice']) && $this->deleteImg($res[0]['guide_voice_en']) 
                        && $this->deleteImg($res[0]['video']) 
                        && $this->deleteImg($res[0]['splash_bg']) && $this->deleteImg($res[0]['splash_bg_vertical'])
                        && $this->deleteImg($res[0]['splash_fg']) && $this->deleteImg($res[0]['splash_fg_vertical'])
                        && $this->deleteImg($res[0]['splash_blurl']) && $this->deleteImg($res[0]['splash_blur_vertical'])) {
                            $this->db->beginTransaction();
                            $sql = "DELETE FROM mode
                                    WHERE mode_id = $modeID";
                            $this->db->exec($sql);
                            $this->db->commit();

                            $this->error = '';
                            $this->msg   = '刪除成功';
                            header('Location:../controller/zoneController.php?action=viewZoneDetail&zoneId=' . $zoneData['zone_id'] . '&msg=' . $this->msg);
                    } else {
                            $this->error = '刪除圖片失敗';
                            $this->msg   = '';
                            header('Location:../controller/modeController.php?action=detailMode&modeID=' . $modeID . '&error=' . $this->error);
                    }
                }
                
            } catch (PDOException $e) {
                print "Error!: " . $e->getMessage();
                $this->smartyTemplate->assign('error', $e->getMessage());
            }
        } else {
            header('Location:../controller/userController.php?action=viewLogin');
        }
    }    


}
