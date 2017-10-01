<?php
// initialize
require_once HOME_DIR . 'configs/config.php';
require_once 'upload.func.php';

/**
 * 裝置類別
 */
class device
{
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
     * @DateTime 2016-09-03
     */
    public function __construct()
    {
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
        $this->msg   = '';
    }

    /**
     * 新增裝置表單
     * @DateTime 2016-09-11
     */
    public function addDevicePrepare($input)
    {
        if ($_SESSION['isLogin'] == true) {
            try {
                $mode = $input['modeID'];

                $rh = $this->db->prepare('SELECT company_id, name FROM company');
                $rh->execute();
                $allCompany = $rh->fetchAll();
                $this->smartyTemplate->assign('allCompany', $allCompany);

                $this->smartyTemplate->assign('error', $this->error);
                $this->smartyTemplate->assign('msg', $this->msg);
                $this->smartyTemplate->assign('mode', $mode);
                $this->smartyTemplate->display('device/deviceAdd.html');

            } catch (PDOException $e) {
                print "Error!: " . $e->getMessage();
                $this->smartyTemplate->assign('error', $e->getMessage());
            }
        } else {
            header('Location:../controller/userController.php?action=viewLogin');
        }
    }

    /**
     * 新增裝置
     * @DateTime 2016-09-11
     * 新增文字資訊->找到所屬的project->新增圖片資料->顯示該筆新增的資料
     */
    public function addDevice($input)
    {
        if ($_SESSION['isLogin'] == true) {
            try {
                $mode = $input['deviceMode'];
                if(strlen($input['deviceNameEn']) == 0)
                    $input['deviceNameEn'] = null;
                if(strlen($input['deviceHint']) == 0)
                    $input['deviceHint'] = null;

                $now = date('Y-m-d H:i:s');
                $sql = "INSERT INTO device (name, name_en, introduction, hint, mode_id, company_id, create_date, lastupdate_date)
                            VALUES (:name, :nameEn, :introduction, :hint, :modeID, :company, :createDate, :lastupdateDate)";
                $res = $this->db->prepare($sql);
                $res->bindParam(':name', $input['deviceName'], PDO::PARAM_STR);
                $res->bindParam(':nameEn', $input['deviceNameEn'], PDO::PARAM_STR);
                $res->bindParam(':introduction', $input['deviceIntroduction'], PDO::PARAM_STR);
                $res->bindParam(':hint', $input['deviceHint'], PDO::PARAM_STR);
                $res->bindParam(':modeID', $mode, PDO::PARAM_INT);
                $res->bindParam(':company', $input['deviceCompany'], PDO::PARAM_INT);
                $res->bindParam(':createDate', $now, PDO::PARAM_STR);
                $res->bindParam(':lastupdateDate', $now, PDO::PARAM_STR);
                
                if ($res->execute()) {
                    $deviceID   = $this->db->lastInsertId();
                    $this->msg = '新增成功';

                    $sql = "SELECT field_map.project_id, zone.field_id, mode.zone_id, device.mode_id, device.device_id
                            FROM field_map, zone, mode, device
                            WHERE field_map.field_map_id = zone.field_id
                            AND zone.zone_id = mode.zone_id
                            AND mode.mode_id = device.mode_id
                            AND device.device_id = $deviceID ";
                    $res = $this->db->prepare($sql);
                    $res->execute();
                    $res = $res->fetchAll();
                    $projectID = $res[0]['project_id'];
                    $modeID = $res[0]['mode_id'];
                    $uploadPath = '../media/project/project' . $projectID . '/zone';
                    if (!file_exists($uploadPath) && !is_dir($uploadPath)) {
                        // create project folder with 777 permissions
                        mkdir($uploadPath);
                        chmod($uploadPath, 0777);
                    }
                    if ($_FILES['deviceGuideVoice']['error'] == 0) {
                        $fileInfo = $_FILES['deviceGuideVoice'];
                        $deviceGuideVoice = uploadFile($fileInfo, $uploadPath);

                        $sql = "UPDATE device
                                SET guide_voice = :guideVoice
                                WHERE device_id = :deviceID";
                        $res = $this->db->prepare($sql);
                        $res->bindParam(':guideVoice', $deviceGuideVoice, PDO::PARAM_STR);
                        $res->bindParam(':deviceID', $deviceID, PDO::PARAM_INT);
                        $res->execute();
                    }
                    if ($_FILES['devicePhoto']['error'] == 0) {
                        $fileInfo = $_FILES['devicePhoto'];
                        $photo    = uploadFile($fileInfo, $uploadPath);

                        $sql = "UPDATE device
                                SET photo = :photo
                                WHERE device_id = :deviceID";
                        $res = $this->db->prepare($sql);
                        $res->bindParam(':photo', $photo, PDO::PARAM_STR);
                        $res->bindParam(':deviceID', $deviceID, PDO::PARAM_INT);
                        $res->execute();
                    }
                    if ($_FILES['devicePhotoVertical']['error'] == 0) {
                        $fileInfo = $_FILES['devicePhotoVertical'];
                        $photoVertical = uploadFile($fileInfo, $uploadPath);

                        $sql = "UPDATE zone
                                SET photo_vertical = :photoVertical
                                WHERE device_id = :deviceID";
                        $res = $this->db->prepare($sql);
                        $res->bindParam(':photoVertical', $photoVertical, PDO::PARAM_STR);
                        $res->bindParam(':deviceID', $deviceID, PDO::PARAM_INT);
                        $res->execute();
                    }
                    if ($res) { 
                        $this->detailDevice(
                                array(
                                    'deviceID' => $deviceID,
                                )
                            );
                    } else {   //失敗顯示錯誤
                        $error = $res->errorInfo();
                        var_dump($res->errorInfo());exit;
                        $this->error = $error[0];
                        $this->smartyTemplate->assign('error', $this->error);
                        $this->smartyTemplate->assign('msg', $this->msg);
                        $this->addDevicePrepare(
                                array(
                                    'modeID' => $modeID,
                                )
                            );
                    }
                } else {  //失敗回到Add 顯示錯誤
                    $error = $res->errorInfo();
                    $this->error = $error[1];
                    $this->smartyTemplate->assign('error', $this->error);
                    $this->smartyTemplate->assign('msg', $this->msg);
                    $this->addDevicePrepare(
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
     * device詳細資料
     * @DateTime 2016-09-08
     * @param array $input[裝置資料]
     */
    public function detailDevice($input)
    {
        if ($_SESSION['isLogin'] == true) {
            try {
                $sql = "SELECT * FROM device WHERE device_id = :deviceID";
                $res = $this->db->prepare($sql);
                $res->bindParam(':deviceID', $input['deviceID'], PDO::PARAM_INT);
                $res->execute();
                $deviceData = $res->fetch();
                $companyID  = $deviceData['company_id'];
                $modeID = $deviceData['mode_id'];

                $sql = 'SELECT mode_id, name FROM mode WHERE mode_id = :modeID'; //取得mode資訊
                $res = $this->db->prepare($sql);
                $res->bindParam(':modeID', $modeID, PDO::PARAM_INT);
                $res->execute();
                $modeData = $res->fetch();

                $sql = 'SELECT * FROM company WHERE company_id = :companyID'; //取得公司資訊
                $res = $this->db->prepare($sql);
                $res->bindParam(':companyID', $companyID, PDO::PARAM_INT);
                $res->execute();
                $companyData = $res->fetch();

                $this->smartyTemplate->assign('deviceData', $deviceData);
                $this->smartyTemplate->assign('companyData', $companyData);
                $this->smartyTemplate->assign('modeData',$modeData);
                $this->smartyTemplate->assign('error', $this->error);
                $this->smartyTemplate->assign('msg', $this->msg);

                $this->smartyTemplate->display('device/deviceDetail.html');

            } catch (PDOException $e) {
                print "Error!: " . $e->getMessage();
                $this->smartyTemplate->assign('error', $e->getMessage());
            }
        } else {
            header('Location:../controller/userController.php?action=viewLogin');
        }
    }

    /**
     * device編輯表單
     * @DateTime 2016-09-10
     * @param array $input[裝置資料]
     */
    public function updateDevicePrepare($input)
    {
        if ($_SESSION['isLogin'] == true) {
            try {
                $sql = "SELECT * FROM device WHERE device_id = :deviceID"; //取得裝置資訊
                $res = $this->db->prepare($sql);
                $res->bindParam(':deviceID', $input['deviceID'], PDO::PARAM_INT);
                $res->execute();
                $deviceData = $res->fetch();

                $sql = 'SELECT company_id, name FROM company'; //取得全部公司資訊
                $res = $this->db->prepare($sql);
                $res->execute();
                $allCompanyData = $res->fetchAll();

                $sql = 'SELECT mode_id, name FROM mode'; //取得全部mode資訊
                $res = $this->db->prepare($sql);
                $res->execute();
                $allModeData = $res->fetchAll();

                $this->smartyTemplate->assign('deviceData', $deviceData);
                $this->smartyTemplate->assign('allCompanyData', $allCompanyData);
                $this->smartyTemplate->assign('allModeData', $allModeData);

                $this->smartyTemplate->assign('error', $this->error);
                $this->smartyTemplate->assign('msg', $this->msg);
                $this->smartyTemplate->display('device/deviceEdit.html');

            } catch (PDOException $e) {
                print "Error!: " . $e->getMessage();
                $this->smartyTemplate->assign('error', $e->getMessage());
            }
        } else {
            header('Location:../controller/userController.php?action=viewLogin');
        }
    }

    /**
     * device編輯
     * @DateTime 2016-09-11
     * @param array $input[裝置資料]
     * 先更新非圖非語音部分->找到資料夾->更新圖與語音
     */
    public function updateDevice($input)
    {
        if ($_SESSION['isLogin'] == true) {
            try {
                $deviceID = $input['deviceID'];
                if(strlen($input['deviceNameEn']) == 0)
                    $input['deviceNameEn'] = null;
                if(strlen($input['deviceHint']) == 0)
                    $input['deviceHint'] = null;

                $now = date('Y-m-d H:i:s');
                $sql = 'UPDATE device 
                        SET name = :name, name_en = :nameEn, introduction = :introduction,
                        hint = :hint, mode_id = :mode, company_id = :company, lastupdate_date = :lastupdateDate
                        WHERE device_id = :deviceID'; //取得裝置資訊
                $res = $this->db->prepare($sql);
                $res = $this->db->prepare($sql);
                $res->bindParam(':deviceID', $input['deviceID'], PDO::PARAM_INT);
                $res->bindParam(':name', $input['deviceName'], PDO::PARAM_STR);
                $res->bindParam(':nameEn', $input['deviceNameEn'], PDO::PARAM_STR);
                $res->bindParam(':introduction', $input['deviceIntroduction'], PDO::PARAM_STR);
                $res->bindParam(':hint', $input['deviceHint'], PDO::PARAM_STR);
                $res->bindParam(':mode', $input['deviceMode'], PDO::PARAM_INT);
                $res->bindParam(':company', $input['deviceCompany'], PDO::PARAM_INT);
                $res->bindParam(':lastupdateDate', $now, PDO::PARAM_STR);
                $res->bindParam(':deviceID', $deviceID, PDO::PARAM_INT);
                if($res->execute()){
                    $this->msg = '更新成功';

                    $sql = "SELECT field_map.project_id, zone.field_id, mode.zone_id, device.mode_id, device.device_id
                            FROM field_map, zone, mode, device
                            WHERE field_map.field_map_id = zone.field_id
                            AND zone.zone_id = mode.zone_id
                            AND mode.mode_id = device.mode_id
                            AND device.device_id = $deviceID ";
                    $res = $this->db->prepare($sql);
                    $res->execute();
                    $res = $res->fetchAll();
                    $projectID = $res[0]['project_id'];
                    /*$fieldID = $res[0]['field_id'];
                    $zoneID = $res[0]['zone_id'];
                    $modeID = $res[0]['mode_id'];
                    $deviceID = $res[0]['device_id'];*/
                    //$uploadPath = '../media/project/project' . $projectID . '/zone'. $zoneID . '/mode' . $modeID . '/device' . $deviceID ;
                    $uploadPath = '../media/project/project' . $projectID . '/zone';

                    //找出現有的圖片
                    $sql = "SELECT `photo`, `photo_vertical`,`guide_voice`,
                        FROM device
                        WHERE device_id = $deviceID";
                    $res = $this->db->prepare($sql);
                    $res->execute();
                    $row = $res->fetchAll();

                    if ($_FILES['deviceGuideVoice']['error'] == 0) {
                    $fileInfo = $_FILES['deviceGuideVoice'];
                    $guideVoice = uploadFile($fileInfo, $uploadPath);
                        if ($this->deleteImg($row[0]['photo'])) {
                            $now = date('Y-m-d H:i:s');
                            $sql = "UPDATE device
                                    SET guide_voice = :guideVoice, lastupdate_date = :lastUpdate
                                    WHERE device_id = :deviceID";
                            $res = $this->db->prepare($sql);
                            $res->bindParam(':guideVoice', $guideVoice, PDO::PARAM_STR);
                            $res->bindParam(':lastUpdate', $now, PDO::PARAM_STR);
                            $res->bindParam(':deviceID', $deviceID, PDO::PARAM_INT);
                            $res->execute();
                        }
                    }
                    if ($_FILES['devicePhoto']['error'] == 0) {
                    $fileInfo = $_FILES['devicePhoto'];
                    $photo = uploadFile($fileInfo, $uploadPath);

                        if ($this->deleteImg($row[0]['photo'])) {
                            $now = date('Y-m-d H:i:s');
                            $sql = "UPDATE device
                                    SET photo = :photo, lastupdate_date = :lastUpdate
                                    WHERE device_id = :deviceID";
                            $res = $this->db->prepare($sql);
                            $res->bindParam(':photo', $photo, PDO::PARAM_STR);
                            $res->bindParam(':lastUpdate', $now, PDO::PARAM_STR);
                            $res->bindParam(':deviceID', $deviceID, PDO::PARAM_INT);
                            $res->execute();
                        }
                    }
                    if ($_FILES['devicePhotoVertical']['error'] == 0) {
                        $fileInfo = $_FILES['devicePhotoVertical'];
                        $photoVertical = uploadFile($fileInfo, $uploadPath);

                        if ($this->deleteImg($row[0]['photo_vertical'])) {
                            $now = date('Y-m-d H:i:s');
                            $sql = "UPDATE device
                                    SET photo_vertical = :photoVertical, lastupdate_date = :lastUpdate
                                    WHERE device_id = :deviceID";
                            $res = $this->db->prepare($sql);
                            $res->bindParam(':photoVertical', $photoVertical, PDO::PARAM_STR);
                            $res->bindParam(':lastUpdate', $now, PDO::PARAM_STR);
                            $res->bindParam(':deviceID', $deviceID, PDO::PARAM_INT);
                            $res->execute();
                        }
                    }
                    if ($res) {
                        $this->smartyTemplate->assign('error', $this->error);
                        $this->smartyTemplate->assign('msg', $this->msg);
                        $this->detailDevice(
                                array(
                                    'deviceID' => $deviceID,
                                )
                            );
                    } else {
                        $error = $res->errorInfo();
                        $this->msg = '';
                        $this->error = $error[0];
                        $this->smartyTemplate->assign('error', $this->error);
                        $this->smartyTemplate->assign('msg', $this->msg);
                        $this->detailDevice(
                            array(
                                'deviceID' => $deviceID,
                            )
                        );
                    }
                }else{
                    $error = $res->errorInfo();
                    $this->error = $error[1];
                    $this->smartyTemplate->assign('error', $this->error);
                    $this->smartyTemplate->assign('msg', $this->msg);
                    $this->detailDevice(
                        array(
                            'deviceID' => $deviceID,
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
    public function deleteImg($url)
    {
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
     * device刪除
     * @DateTime 2016-09-10
     * @param array $input[裝置ID]
     * 先刪除圖片語音 -> 刪資料
     */
    public function deleteDevice($input)
    {
        if ($_SESSION['isLogin'] == true) {
            try {
                $deviceID = $input['deviceID'];

                $sql = "SELECT mode_id
                        FROM device
                        WHERE device_id = $deviceID";
                $res = $this->db->prepare($sql);
                $res->execute();
                $modeData = $res->fetch();

                $sql = "SELECT `guide_voice`,`photo`, `photo_vertical`
                        FROM device
                        WHERE device_id = $deviceID";
                $res = $this->db->prepare($sql);
                $res->execute();
                $res = $res->fetchAll();
                //刪除圖片
                if ($this->deleteImg($res[0]['guide_voice']) && $this->deleteImg($res[0]['photo']) && $this->deleteImg($res[0]['photo_vertical'])) {
                    $this->db->beginTransaction();
                    $sql = "DELETE FROM device WHERE device_id = $deviceID";
                    $this->db->exec($sql);
                    $this->db->commit();

                    $this->error = '';
                    $this->msg   = '刪除成功';
                    header('Location:../controller/modeController.php?action=detailMode&modeID=' . $modeData['mode_id'] . '&error=' . $this->error . '&msg=' . $this->msg);
                } else {
                    $this->error = '刪除圖片失敗';
                    $this->msg   = '';
                    header('Location:../controller/modeController.php?action=detailMode&modeID=' . $modeData['mode_id'] . '&error=' . $this->error . '&msg=' . $this->msg);
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
