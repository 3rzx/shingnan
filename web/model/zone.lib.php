<?php
// initialize
require_once HOME_DIR . 'configs/config.php';
require_once 'upload.func.php';

/**
 * 專案圖資類別
 */
class Zone
{
    // database object
    public $db = null;
    // smarty template object
    public $smarty = null;
    // success messages
    public $msg = '';
    // error messages
    public $error = '';

    /**
     * Zone constructor
     * @DateTime 2016-09-12
     */
    public function __construct()
    {
        session_start();
        // instantiate the pdo object
        $this->db = dbSetup::getDbConn();
        // instantiate the template object
        $this->smarty = new SmartyConfig();
    }
    /**
     * 顯示增加場域畫面
     * @DateTime 2016-09-12
     * @param    array     $input [場域ID]
     */
    public function viewAddForm($input)
    {
        if ($_SESSION['isLogin'] == true) {
            $this->smarty->assign('fieldId', $input['fieldId']);
            $this->smarty->assign('homePath', APP_ROOT_DIR);
            $this->smarty->assign('error', $this->error);
            $this->smarty->display('zone/zoneAdd.html');
        } else {
            header('Location:../controller/userController.php?action=viewLogin');
        }
    }
    /**
     * 驗證輸入
     * @DateTime 2016-09-12
     * @param    [type]     $input [區域資料]
     * @return   boolean           [是否為有效輸入]
     */
    public function isValidAddForm($input)
    {
        // 清除空格
        $input['zoneName']         = trim($input['zoneName']);
        $input['zoneNameEn']       = trim($input['zoneNameEn']);
        $input['zoneHint']         = trim($input['zoneHint']);
        $input['zoneIntroduction'] = trim($input['zoneIntroduction']);

        // 測試是否為空值
        if (strlen($input['zoneName']) == 0) {
            $this->error = '場域名稱不得為空值';
            return false;
        } else if (strlen($input['zoneNameEn']) == 0) {
            $this->error = '場域英文名稱不得為空值';
            return false;
        } else if (strlen($input['zoneIntroduction']) == 0) {
            $this->error = '場域介紹不得為空值';
            return false;
        } else if (strlen($input['zoneHint']) == 0) {
            $this->error = '場域提示不得為空值';
            return false;
        }
        return true;
    }
    /**
     * 新增場域
     * @DateTime 2016-09-12
     * @param    array     $input [場域資料]
     */
    public function addZone($input)
    {
        if ($_SESSION['isLogin'] == true) {
            try {
                $fieldId = $input['fieldId'];

                $now = date('Y-m-d H:i:s');
                $sql = "INSERT INTO zone (name, name_en, field_id, introduction, introduction_en, hint, photo, photo_vertical, create_date, lastupdate_date)
                        VALUES (:name, :nameEn, :fieldId, :introduction, introductionEn, :hint, '', '', :createDate, :lastupdateDate)";
                $res = $this->db->prepare($sql);
                $res->bindParam(':name', $input['zoneName'], PDO::PARAM_STR);
                $res->bindParam(':nameEn', $input['zoneNameEn'], PDO::PARAM_STR);
                $res->bindParam(':fieldId', $fieldId, PDO::PARAM_INT);
                $res->bindParam(':introduction', $input['zoneIntroduction'], PDO::PARAM_STR);
                $res->bindParam(':introductionEn', $input['zoneIntroductionEn'], PDO::PARAM_STR);
                $res->bindParam(':hint', $input['zoneHint'], PDO::PARAM_STR);
                $res->bindParam(':createDate', $now, PDO::PARAM_STR);
                $res->bindParam(':lastupdateDate', $now, PDO::PARAM_STR);

                if ($res->execute()) {
                    $this->error = '';
                    $this->msg   = '新增成功';
                    $zoneId      = $this->db->lastInsertId();

                    $sql = "SELECT `project_id`
                            FROM field_map
                            WHERE field_map_id = $fieldId";
                    $res = $this->db->prepare($sql);
                    $res->execute();
                    $res = $res->fetchAll();
                    //偵測資料夾是否存在
                    $projectId  = $res[0]['project_id'];
                    $uploadPath = '../media/project/project' . $projectId . '/zone';
                    if (!file_exists($uploadPath) && !is_dir($uploadPath)) {
                        // create project folder with 777 permissions
                        mkdir($uploadPath);
                        chmod($uploadPath, 0777);
                    }
                    if ($_FILES['zoneVoiceEn']['error'] == 0) {
                        $fileInfo     = $_FILES['zoneVoiceEn'];
                        $guideVoiceEn = uploadFile($fileInfo, $uploadPath);

                        $sql = "UPDATE zone
                                SET guide_voice_en = :guideVoiceEn
                                WHERE zone_id = :zoneId";
                        $res = $this->db->prepare($sql);
                        $res->bindParam(':guideVoiceEn', $guideVoiceEn, PDO::PARAM_STR);
                        $res->bindParam(':zoneId', $zoneId, PDO::PARAM_INT);
                        $res->execute();
                    }
                    if ($_FILES['zoneVoice']['error'] == 0) {
                        $fileInfo   = $_FILES['zoneVoice'];
                        $guideVoice = uploadFile($fileInfo, $uploadPath);

                        $sql = "UPDATE zone
                                SET guide_voice = :guideVoice
                                WHERE zone_id = :zoneId";
                        $res = $this->db->prepare($sql);
                        $res->bindParam(':guideVoice', $guideVoice, PDO::PARAM_STR);
                        $res->bindParam(':zoneId', $zoneId, PDO::PARAM_INT);
                        $res->execute();
                    }
                    if ($_FILES['zonePhoto']['error'] == 0) {
                        $fileInfo = $_FILES['zonePhoto'];
                        $photo    = uploadFile($fileInfo, $uploadPath);

                        $sql = "UPDATE zone
                                SET photo = :photo
                                WHERE zone_id = :zoneId";
                        $res = $this->db->prepare($sql);
                        $res->bindParam(':photo', $photo, PDO::PARAM_STR);
                        $res->bindParam(':zoneId', $zoneId, PDO::PARAM_INT);
                        $res->execute();
                    }
                    if ($_FILES['zonePhotoApp']['error'] == 0) {
                        $fileInfo = $_FILES['zonePhotoApp'];
                        $photoApp = uploadFile($fileInfo, $uploadPath);

                        $sql = "UPDATE zone
                                SET photo_vertical = :photoApp
                                WHERE zone_id = :zoneId";
                        $res = $this->db->prepare($sql);
                        $res->bindParam(':photoApp', $photoApp, PDO::PARAM_STR);
                        $res->bindParam(':zoneId', $zoneId, PDO::PARAM_INT);
                        $res->execute();
                    }
                    if ($res) {
                        $this->viewzoneDetail(
                            array(
                                'zoneId' => $zoneId,
                            )
                        );
                    } else {
                        $error = $res->errorInfo();

                        $this->error = $error[0];
                        $this->viewAddForm($input);
                    }
                } else {
                    $error = $res->errorInfo();
                    var_dump($error);exit;
                    $this->error = $error[0];
                    $this->viewAddForm($input);
                }

            } catch (PDOException $e) {
                print "Error!: " . $e->getMessage();
            }
        } else {
            header('Location:../controller/userController.php?action=viewLogin');
        }
    }
    /**
     * 顯示編輯場域畫面
     * @DateTime 2016-09-12
     * @param    array     $input [區域ID]
     */
    public function viewEditForm($input)
    {
        if ($_SESSION['isLogin'] == true) {
            $sql = "SELECT *
                    FROM zone
                    WHERE zone_id = :zoneId";
            $res = $this->db->prepare($sql);
            $res->bindParam(':zoneId', $input['zoneId'], PDO::PARAM_INT);
            $res->execute();
            $zoneData = $res->fetchAll();

            $this->smarty->assign('zone', $zoneData[0]);
            $this->smarty->assign('homePath', APP_ROOT_DIR);
            $this->smarty->assign('error', $this->error);
            $this->smarty->display('zone/zoneEdit.html');
        } else {
            header('Location:../controller/userController.php?action=viewLogin');
        }
    }
    /**
     * 更新場域資料
     * @DateTime 2016-09-12
     * @param    array     $input [區域資料]
     */
    public function updateZone($input)
    {
        if ($_SESSION['isLogin'] == true) {
            try {
                $zoneId  = $input['zoneId'];
                $fieldId = $input['fieldId'];
                // get project id
                $sql = "SELECT `project_id`
                        FROM field_map
                        WHERE field_map_id = $fieldId";
                $res = $this->db->prepare($sql);
                $res->execute();
                $res        = $res->fetchAll();
                $projectId  = $res[0]['project_id'];
                $uploadPath = '../media/project/project' . $projectId . '/zone';
                // update data from zone
                $now = date('Y-m-d H:i:s');
                $sql = "UPDATE zone
                        SET name = :name, name_en = :nameEn, introduction = :introduction, introduction_en = :introductionEn, hint = :hint, lastupdate_date = :lastUpdate
                        WHERE zone_id = :zoneId";
                $res = $this->db->prepare($sql);
                $res->bindParam(':name', $input['zoneName'], PDO::PARAM_STR);
                $res->bindParam(':nameEn', $input['zoneNameEn'], PDO::PARAM_STR);
                $res->bindParam(':introduction', $input['zoneIntroduction'], PDO::PARAM_STR);
                $res->bindParam(':introductionEn', $input['zoneIntroductionEn'], PDO::PARAM_STR);
                $res->bindParam(':hint', $input['zoneHint'], PDO::PARAM_STR);
                $res->bindParam(':lastUpdate', $now, PDO::PARAM_STR);
                $res->bindParam(':zoneId', $zoneId, PDO::PARAM_INT);
                $res->execute();

                $sql = "SELECT guide_voice_en, guide_voice, photo, photo_vertical
                        FROM zone
                        WHERE zone_id = $zoneId";
                $res = $this->db->prepare($sql);
                $res->execute();
                $row = $res->fetchAll();

                if ($_FILES['zoneVoiceEn']['error'] == 0) {
                    $fileInfo     = $_FILES['zoneVoiceEn'];
                    $guideVoiceEn = uploadFile($fileInfo, $uploadPath);

                    if ($this->deleteImg($row[0]['guide_voice_en'])) {
                        $now = date('Y-m-d H:i:s');
                        $sql = "UPDATE zone
                                SET guide_voice_en = :guideVoiceEn, lastupdate_date = :lastUpdate
                                WHERE zone_id = :zoneId";
                        $res = $this->db->prepare($sql);
                        $res->bindParam(':guideVoiceEn', $guideVoiceEn, PDO::PARAM_STR);
                        $res->bindParam(':lastUpdate', $now, PDO::PARAM_STR);
                        $res->bindParam(':zoneId', $zoneId, PDO::PARAM_INT);
                        $res->execute();
                    }
                }
                if ($_FILES['zoneVoice']['error'] == 0) {
                    $fileInfo   = $_FILES['zoneVoice'];
                    $guideVoice = uploadFile($fileInfo, $uploadPath);

                    if ($this->deleteImg($row[0]['guide_voice'])) {
                        $now = date('Y-m-d H:i:s');
                        $sql = "UPDATE zone
                                SET guide_voice = :guideVoice, lastupdate_date = :lastUpdate
                                WHERE zone_id = :zoneId";
                        $res = $this->db->prepare($sql);
                        $res->bindParam(':guideVoice', $guideVoice, PDO::PARAM_STR);
                        $res->bindParam(':lastUpdate', $now, PDO::PARAM_STR);
                        $res->bindParam(':zoneId', $zoneId, PDO::PARAM_INT);
                        $res->execute();
                    }
                }
                if ($_FILES['zonePhoto']['error'] == 0) {
                    $fileInfo = $_FILES['zonePhoto'];
                    $photo    = uploadFile($fileInfo, $uploadPath);

                    if ($this->deleteImg($row[0]['photo'])) {
                        $now = date('Y-m-d H:i:s');
                        $sql = "UPDATE zone
                                SET photo = :photo, lastupdate_date = :lastUpdate
                                WHERE zone_id = :zoneId";
                        $res = $this->db->prepare($sql);
                        $res->bindParam(':photo', $photo, PDO::PARAM_STR);
                        $res->bindParam(':lastUpdate', $now, PDO::PARAM_STR);
                        $res->bindParam(':zoneId', $zoneId, PDO::PARAM_INT);
                        $res->execute();
                    }
                }
                if ($_FILES['zonePhotoApp']['error'] == 0) {
                    $fileInfo = $_FILES['zonePhotoApp'];
                    $photoApp = uploadFile($fileInfo, $uploadPath);

                    if ($this->deleteImg($row[0]['photo_vertical'])) {
                        $now = date('Y-m-d H:i:s');
                        $sql = "UPDATE zone
                                SET photo_vertical = :photoApp, lastupdate_date = :lastUpdate
                                WHERE zone_id = :zoneId";
                        $res = $this->db->prepare($sql);
                        $res->bindParam(':photoApp', $photoApp, PDO::PARAM_STR);
                        $res->bindParam(':lastUpdate', $now, PDO::PARAM_STR);
                        $res->bindParam(':zoneId', $zoneId, PDO::PARAM_INT);
                        $res->execute();
                    }
                }
                if ($res) {
                    header('Location:../controller/fieldController.php?action=viewFieldDetail&fieldId=' . $fieldId . '&msg=更新成功');
                } else {
                    $error = $res->errorInfo();

                    $this->error = '更新失敗';
                    $this->viewAddForm($input);
                }
            } catch (PDOException $e) {
                print_r("Error!: " . $e->getMessage());
            }
        } else {
            header('Location:../controller/userController.php?action=viewLogin');
        }
    }
    /**
     * 刪除圖片
     * @DateTime 2016-09-12
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
     * 刪除場域
     * @DateTime 2016-09-12
     * @param    array     $input [場域與區域ID]
     */
    public function deleteZone($input)
    {
        if ($_SESSION['isLogin'] == true) {
            try {
                $fieldId = $input['fieldId'];
                $zoneId  = $input['zoneId'];

                $sql = "SELECT *
                        FROM mode
                        WHERE zone_id = $zoneId";
                $res = $this->db->prepare($sql);
                $res->execute();
                $res = $res->fetchAll();

                if (count($res) > 0) {
                    $this->error = '區域中還有其他資料，請先刪除資料';
                    $this->msg   = '';
                } else {
                    $sql = "SELECT `photo`, `photo_vertical`
                            FROM zone
                            WHERE zone_id = $zoneId";
                    $res = $this->db->prepare($sql);
                    $res->execute();
                    $res = $res->fetchAll();
                    //刪除圖片
                    if ($this->deleteImg($res[0]['photo']) && $this->deleteImg($res[0]['photo_vertical'])) {
                        $this->db->beginTransaction();
                        $sql = "DELETE FROM zone
                                WHERE zone_id = $zoneId";
                        $this->db->exec($sql);
                        $this->db->commit();

                        $this->error = '';
                        $this->msg   = '刪除成功';
                    } else {
                        $this->error = '刪除圖片失敗';
                        $this->msg   = '';
                    }
                }
                header('Location:../controller/fieldController.php?action=viewFieldDetail&fieldId=' . $fieldId . '&error=' . $this->error . '&msg=' . $this->msg);

            } catch (PDOException $e) {
                $this->db->rollBack();
                print "Error!: " . $e->getMessage();
            }
        } else {
            header('Location:../controller/userController.php?action=viewLogin');
        }
    }
    /**
     * 顯示場域詳細資料
     * @DateTime 2016-09-12
     * @param    array     $input [場域與區域ID]
     */
    public function viewZoneDetail($input)
    {
        if ($_SESSION['isLogin'] == true) {
            $zone = $input['zoneId'];
            try {
                $sql = "SELECT *
                        FROM zone
                        WHERE zone_id = :zoneId";
                $res = $this->db->prepare($sql);
                $res->bindParam(':zoneId', $input['zoneId'], PDO::PARAM_INT);
                $res->execute();
                $zoneData = $res->fetchAll();

                $sql = "SELECT *
                        FROM mode
                        WHERE zone_id = :zoneId";
                $res = $this->db->prepare($sql);
                $res->bindParam(':zoneId', $zone, PDO::PARAM_INT);
                $res->execute();
                $modeData = $res->fetchAll();

                $this->smarty->assign('zone', $zoneData[0]);
                $this->smarty->assign('mode', $modeData);
                if (isset($input['error'])) {
                    $this->error = $input['error'];
                }
                if (isset($input['msg'])) {
                    $this->msg = $input['msg'];
                }
                $this->smarty->assign('msg', $this->msg);
                $this->smarty->assign('error', $this->error);
                $this->smarty->assign('homePath', APP_ROOT_DIR);
                $this->smarty->display('zone/zoneDetail.html');
            } catch (PDOException $e) {
                print "Error!: " . $e->getMessage();
            }
        } else {
            header('Location:../controller/userController.php?action=viewLogin');
        }
    }
}
