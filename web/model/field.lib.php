<?php
// initialize
require_once HOME_DIR . 'configs/config.php';
require_once 'upload.func.php';

/**
 * 專案圖資類別
 */
class Field
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
     * Field constructor
     * @DateTime 2016-09-07
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
     * @DateTime 2016-09-09
     * @param    array     $input [專案ID]
     */
    public function viewAddForm($input)
    {
        if ($_SESSION['isLogin'] == true) {
            $this->smarty->assign('projectId', $input['projectId']);
            $this->smarty->assign('homePath', APP_ROOT_DIR);
            $this->smarty->assign('error', $this->error);
            $this->smarty->display('field/fieldAdd.html');
        } else {
            header('Location:../controller/userController.php?action=viewLogin');
        }
    }
    /**
     * 顯示增加Beacon畫面
     * @DateTime 2016-09-10
     * @param    array     $input [未知]
     */
    public function viewBeaconAddForm($input)
    {
        if ($_SESSION['isLogin'] == true) {
            //get all zone_id
            $sql = "SELECT zone_id, name
                    FROM zone
                    ORDER BY zone_id";
            $res = $this->db->prepare($sql);
            $res->execute();
            $zoneId = $res->fetchAll();

            $this->smarty->assign('fieldId', $input['fieldId']);
            $this->smarty->assign('zoneId', $zoneId);
            $this->smarty->assign('error', $this->error);
            $this->smarty->assign('homePath', APP_ROOT_DIR);
            $this->smarty->display('beacon/beaconAdd.html');
        } else {
            $this->error = '請先登入!';
            $this->viewLogin();
        }
    }
    /**
     * 驗證輸入
     * @DateTime 2016-09-09
     * @param    [type]     $input [場域資料]
     * @return   boolean           [是否為有效輸入]
     */
    public function isValidAddForm($input)
    {
        // 清除空格
        $input['fieldName']         = trim($input['fieldName']);
        $input['fieldNameEn']       = trim($input['fieldNameEn']);
        $input['fieldIntroduction'] = trim($input['fieldIntroduction']);

        // 測試是否為空值
        if (strlen($input['fieldName']) == 0) {
            $this->error = '場域名稱不得為空值';
            return false;
        } else if (strlen($input['fieldNameEn']) == 0) {
            $this->error = '場域英文名稱不得為空值';
            return false;
        } else if (strlen($input['fieldIntroduction']) == 0) {
            $this->error = '場域介紹不得為空值';
            return false;
        }
        return true;
    }
    /**
     * 新增場域
     * @DateTime 2016-09-09
     * @param    array     $input [場域資料]
     */
    public function addField($input)
    {
        if ($_SESSION['isLogin'] == true) {
            try {
                $projectId = $input['projectId'];

                $now = date('Y-m-d H:i:s');
                $sql = "INSERT INTO field_map (name, name_en, project_id, introduction, photo, photo_vertical, map_svg, create_date, lastupdate_date)
                        VALUES (:name, :nameEn, :projectId, :introduction, '', '', '', :createDate, :lastupdateDate)";
                $res = $this->db->prepare($sql);
                $res->bindParam(':name', $input['fieldName'], PDO::PARAM_STR);
                $res->bindParam(':nameEn', $input['fieldNameEn'], PDO::PARAM_STR);
                $res->bindParam(':projectId', $projectId, PDO::PARAM_INT);
                $res->bindParam(':introduction', $input['fieldIntroduction'], PDO::PARAM_STR);
                $res->bindParam(':createDate', $now, PDO::PARAM_STR);
                $res->bindParam(':lastupdateDate', $now, PDO::PARAM_STR);

                if ($res->execute()) {
                    $this->error = '';
                    $this->msg   = '新增成功';
                    $fieldId     = $this->db->lastInsertId();

                    //偵測資料夾是否存在
                    $uploadPath = '../media/project/project' . $projectId . '/field';
                    if (!file_exists($uploadPath) && !is_dir($uploadPath)) {
                        // create project folder with 777 permissions
                        mkdir($uploadPath);
                        chmod($uploadPath, 0777);
                    }

                    if ($_FILES['fieldPhoto']['error'] == 0) {
                        $fileInfo = $_FILES['fieldPhoto'];
                        $photo    = uploadFile($fileInfo, $uploadPath);

                        $sql = "UPDATE field_map
                                SET photo = :photo
                                WHERE field_map_id = :fieldId";
                        $res = $this->db->prepare($sql);
                        $res->bindParam(':photo', $photo, PDO::PARAM_STR);
                        $res->bindParam(':fieldId', $fieldId, PDO::PARAM_INT);
                        $res->execute();
                    }
                    if ($_FILES['fieldPhotoApp']['error'] == 0) {
                        $fileInfo = $_FILES['fieldPhotoApp'];
                        $photoApp = uploadFile($fileInfo, $uploadPath);

                        $sql = "UPDATE field_map
                                SET photo_vertical = :photoApp
                                WHERE field_map_id = :fieldId";
                        $res = $this->db->prepare($sql);
                        $res->bindParam(':photoApp', $photoApp, PDO::PARAM_STR);
                        $res->bindParam(':fieldId', $fieldId, PDO::PARAM_INT);
                        $res->execute();
                    }
                    if ($_FILES['fieldMap']['error'] == 0) {
                        $fileInfo = $_FILES['fieldMap'];
                        $mapSvg   = uploadFile($fileInfo, $uploadPath);

                        $sql = "UPDATE field_map
                                SET map_svg = :mapSvg
                                WHERE field_map_id = :fieldId";
                        $res = $this->db->prepare($sql);
                        $res->bindParam(':mapSvg', $mapSvg, PDO::PARAM_STR);
                        $res->bindParam(':fieldId', $fieldId, PDO::PARAM_INT);
                        $res->execute();
                    }
                    if ($_FILES['fieldMapEn']['error'] == 0) {
                        $fileInfo = $_FILES['fieldMapEn'];
                        $mapSvgEn = uploadFile($fileInfo, $uploadPath);

                        $sql = "UPDATE field_map
                                SET map_svg_en = :mapSvgEn
                                WHERE field_map_id = :fieldId";
                        $res = $this->db->prepare($sql);
                        $res->bindParam(':mapSvgEn', $mapSvgEn, PDO::PARAM_STR);
                        $res->bindParam(':fieldId', $fieldId, PDO::PARAM_INT);
                        $res->execute();
                    }
                    if ($_FILES['fieldMapBg']['error'] == 0) {
                        $fileInfo = $_FILES['fieldMapBg'];
                        $mapBg    = uploadFile($fileInfo, $uploadPath);

                        $sql = "UPDATE field_map
                                SET map_bg = :mapBg
                                WHERE field_map_id = :fieldId";
                        $res = $this->db->prepare($sql);
                        $res->bindParam(':mapBg', $mapBg, PDO::PARAM_STR);
                        $res->bindParam(':fieldId', $fieldId, PDO::PARAM_INT);
                        $res->execute();
                    }
                    if ($res) {
                        $this->viewFieldDetail(
                            array(
                                'fieldId' => $fieldId,
                            )
                        );
                    } else {
                        $error = $res->errorInfo();

                        $this->error = $error[0];
                        $this->viewAddForm($input);
                    }
                } else {
                    $error = $res->errorInfo();

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
     * 新增Beacon
     * @DateTime 2016-09-10
     * @param    array     $input [Beacon資料]
     */
    public function addBeacon($input)
    {
        if ($_SESSION['isLogin'] == true) {
            try {
                $sql = "SELECT mac_addr
                        FROM beacon
                        WHERE mac_addr = :mac_addr";
                $res = $this->db->prepare($sql);
                $res->bindParam(':mac_addr', $input['mac_addr'], PDO::PARAM_STR);
                $res->execute();
                $rows = $res->fetchAll();
                if (count($rows) == 1) {
                    $this->error = '此 Beacon Mac 已登記';
                    $this->viewAddForm();
                } else {
                    $now = date('Y-m-d H:i:s');

                    $sql = "INSERT INTO beacon (mac_addr, name, power, status, zone, x, y, create_date, lastupdate_date)
                            VALUES (:mac_addr, :name, :power, :status, :zone, :x, :y, :createDate, :lastupdateDate)";
                    $res = $this->db->prepare($sql);
                    $res->bindParam(':mac_addr', $input['mac_addr'], PDO::PARAM_STR);
                    $res->bindParam(':name', $input['name'], PDO::PARAM_STR);
                    $res->bindValue(':power', 0, PDO::PARAM_INT);
                    $res->bindValue(':status', $input['status'], PDO::PARAM_INT);
                    $res->bindValue(':zone', $input['zone'], PDO::PARAM_INT);
                    $res->bindValue(':x', $input['x'], PDO::PARAM_INT);
                    $res->bindValue(':y', $input['y'], PDO::PARAM_INT);
                    $res->bindParam(':createDate', $now, PDO::PARAM_STR);
                    $res->bindParam(':lastupdateDate', $now, PDO::PARAM_STR);

                    if ($res->execute()) {
                        $zone = $input['zone'];
                        $sql  = "SELECT field_id FROM zone WHERE zone_id = $zone";
                        $res  = $this->db->prepare($sql);
                        $res->execute();
                        $row = $res->fetchAll();

                        $fieldId     = $row[0]['field_id'];
                        $this->error = '';
                        $this->viewFieldDetail(
                            array(
                                'fieldId' => $fieldId,
                            )
                        );
                    } else {
                        $error       = $res->errorInfo();
                        $this->error = $error[0];
                        $this->viewAddForm();
                    }
                }
            } catch (PDOException $e) {
                print "Error!: " . $e->getMessage();
            }
        } else {
            $this->error = '請先登入!';
            $this->viewLogin();
        }
    }
    /**
     * 顯示編輯場域畫面
     * @DateTime 2016-09-10
     * @param    array     $input [場域ID]
     */
    public function viewEditForm($input)
    {
        if ($_SESSION['isLogin'] == true) {
            $sql = 'SELECT *
                    FROM field_map
                    WHERE field_map_id = :fieldId';
            $res = $this->db->prepare($sql);
            $res->bindParam(':fieldId', $input['fieldId'], PDO::PARAM_INT);
            $res->execute();
            $fieldData = $res->fetchAll();

            $this->smarty->assign('field', $fieldData[0]);
            $this->smarty->assign('homePath', APP_ROOT_DIR);
            $this->smarty->assign('error', $this->error);
            $this->smarty->display('field/fieldEdit.html');
        } else {
            header('Location:../controller/userController.php?action=viewLogin');
        }
    }
    /**
     * 顯示編輯Beacon畫面
     * @DateTime 2016-09-10
     * @param    array     $input [BeaconID]
     */
    public function viewBeaconEditForm($input)
    {
        if ($_SESSION['isLogin'] == true) {
            // get all data from beacon
            $sql = 'SELECT *
                    FROM beacon
                    WHERE beacon_id = :beaconId';
            $res = $this->db->prepare($sql);
            $res->bindParam(':beaconId', $input['beaconId'], PDO::PARAM_INT);
            $res->execute();
            $beaconData = $res->fetchAll();

            //get all zone_id
            $sql = "SELECT zone_id, name
                    FROM zone
                    ORDER BY zone_id";
            $res = $this->db->prepare($sql);
            $res->execute();
            $zoneId = $res->fetchAll();

            $this->smarty->assign('fieldId', $input['fieldId']);
            $this->smarty->assign('zoneId', $zoneId);
            $this->smarty->assign('beaconData', $beaconData[0]);
            $this->smarty->assign('error', $this->error);
            $this->smarty->assign('homePath', APP_ROOT_DIR);
            $this->smarty->display('beacon/beaconEdit.html');
        } else {
            $this->error = '請先登入!';
            $this->viewLogin();
        }
    }
    /**
     * 更新場域資料
     * @DateTime 2016-09-10
     * @param    array     $input [場域資料]
     */
    public function updateField($input)
    {
        if ($_SESSION['isLogin'] == true) {
            try {
                $fieldId   = $input['fieldId'];
                $projectId = $input['projectId'];
                // update data from field
                $uploadPath = '../media/project/project' . $projectId . '/field';

                $now = date('Y-m-d H:i:s');
                $sql = 'UPDATE field_map
                        SET name = :name, name_en = :nameEn, introduction = :introduction, lastupdate_date = :lastUpdate
                        WHERE field_map_id = :fieldId';
                $res = $this->db->prepare($sql);
                $res->bindParam(':name', $input['fieldName'], PDO::PARAM_STR);
                $res->bindParam(':nameEn', $input['fieldNameEn'], PDO::PARAM_STR);
                $res->bindParam(':introduction', $input['fieldIntroduction'], PDO::PARAM_STR);
                $res->bindParam(':lastUpdate', $now, PDO::PARAM_STR);
                $res->bindParam(':fieldId', $fieldId, PDO::PARAM_INT);
                $res->execute();

                $sql = "SELECT photo, photo_vertical, map_svg, map_svg_en, map_bg
                        FROM field_map
                        WHERE field_map_id = $fieldId";
                $res = $this->db->prepare($sql);
                $res->execute();
                $row = $res->fetchAll();

                if ($_FILES['fieldPhoto']['error'] == 0) {
                    $fileInfo = $_FILES['fieldPhoto'];
                    $photo    = uploadFile($fileInfo, $uploadPath);

                    if ($this->deleteImg($row[0]['photo'])) {
                        $now = date('Y-m-d H:i:s');
                        $sql = 'UPDATE field_map
                                SET photo = :photo, lastupdate_date = :lastUpdate
                                WHERE field_map_id = :fieldId';
                        $res = $this->db->prepare($sql);
                        $res->bindParam(':photo', $photo, PDO::PARAM_STR);
                        $res->bindParam(':lastUpdate', $now, PDO::PARAM_STR);
                        $res->bindParam(':fieldId', $fieldId, PDO::PARAM_INT);
                        $res->execute();
                    }
                }
                if ($_FILES['fieldPhotoApp']['error'] == 0) {
                    $fileInfo = $_FILES['fieldPhotoApp'];
                    $photoApp = uploadFile($fileInfo, $uploadPath);

                    if ($this->deleteImg($row[0]['photo_vertical'])) {
                        $now = date('Y-m-d H:i:s');
                        $sql = "UPDATE field_map
                                SET photo_vertical = :photoApp, lastupdate_date = :lastUpdate
                                WHERE field_map_id = :fieldId";
                        $res = $this->db->prepare($sql);
                        $res->bindParam(':photoApp', $photoApp, PDO::PARAM_STR);
                        $res->bindParam(':lastUpdate', $now, PDO::PARAM_STR);
                        $res->bindParam(':fieldId', $fieldId, PDO::PARAM_INT);
                        $res->execute();
                    }
                }
                if ($_FILES['fieldMap']['error'] == 0) {
                    $fileInfo = $_FILES['fieldMap'];
                    $mapSvg   = uploadFile($fileInfo, $uploadPath);

                    if ($this->deleteImg($row[0]['map_svg'])) {
                        $now = date('Y-m-d H:i:s');
                        $sql = 'UPDATE field_map
                                SET map_svg = :mapSvg, lastupdate_date = :lastUpdate
                                WHERE field_map_id = :fieldId';
                        $res = $this->db->prepare($sql);
                        $res->bindParam(':mapSvg', $mapSvg, PDO::PARAM_STR);
                        $res->bindParam(':lastUpdate', $now, PDO::PARAM_STR);
                        $res->bindParam(':fieldId', $fieldId, PDO::PARAM_INT);
                        $res->execute();
                    }
                }
                if ($_FILES['fieldMapEn']['error'] == 0) {
                    $fileInfo = $_FILES['fieldMapEn'];
                    $mapSvgEn = uploadFile($fileInfo, $uploadPath);

                    if ($this->deleteImg($row[0]['map_svg_en'])) {
                        $now = date('Y-m-d H:i:s');
                        $sql = 'UPDATE field_map
                                SET map_svg_en = :mapSvgEn, lastupdate_date = :lastUpdate
                                WHERE field_map_id = :fieldId';
                        $res = $this->db->prepare($sql);
                        $res->bindParam(':mapSvgEn', $mapSvgEn, PDO::PARAM_STR);
                        $res->bindParam(':lastUpdate', $now, PDO::PARAM_STR);
                        $res->bindParam(':fieldId', $fieldId, PDO::PARAM_INT);
                        $res->execute();
                    }
                }
                if ($_FILES['fieldMapBg']['error'] == 0) {
                    $fileInfo = $_FILES['fieldMapBg'];
                    $mapBg    = uploadFile($fileInfo, $uploadPath);

                    if ($this->deleteImg($row[0]['map_bg'])) {
                        $now = date('Y-m-d H:i:s');
                        $sql = 'UPDATE field_map
                                SET map_bg = :mapBg, lastupdate_date = :lastUpdate
                                WHERE field_map_id = :fieldId';
                        $res = $this->db->prepare($sql);
                        $res->bindParam(':mapBg', $mapBg, PDO::PARAM_STR);
                        $res->bindParam(':lastUpdate', $now, PDO::PARAM_STR);
                        $res->bindParam(':fieldId', $fieldId, PDO::PARAM_INT);
                        $res->execute();
                    }
                }
                if ($res) {
                    header('Location:../controller/projectController.php?action=viewProjectDetail&projectId=' . $projectId . '&msg=更新成功');
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
     * 更新Beacon資料
     * @DateTime 2016-09-10
     * @param    array     $input [Beacon資料]
     * @return   json             [Beacon更新後的資料]
     */
    public function updateBeacon($input)
    {
        if ($_SESSION['isLogin'] == true) {
            try {
                // update data from beacon
                $sql = 'UPDATE beacon
                    SET mac_addr = :mac_addr, name = :name, status = :status, zone = :zone, x = :x, y = :y
                    WHERE beacon_id = :beaconId';
                $res = $this->db->prepare($sql);
                $res->bindParam(':mac_addr', $input['mac_addr'], PDO::PARAM_STR);
                $res->bindParam(':name', $input['name'], PDO::PARAM_STR);
                $res->bindValue(':status', $input['status'], PDO::PARAM_INT);
                $res->bindValue(':zone', $input['zone'], PDO::PARAM_INT);
                $res->bindValue(':x', $input['x'], PDO::PARAM_INT);
                $res->bindValue(':y', $input['y'], PDO::PARAM_INT);
                $res->bindParam(':beaconId', $input['beaconId'], PDO::PARAM_INT);
                $res->execute();
                // 更新最後修改時間
                $now = date('Y-m-d H:i:s');
                $sql = "UPDATE beacon
                    SET lastupdate_date = :lastupdateDate
                    WHERE beacon_id = :beaconId";
                $res = $this->db->prepare($sql);
                $res->bindParam(':lastupdateDate', $now, PDO::PARAM_STR);
                $res->bindParam(':beaconId', $input['beaconId'], PDO::PARAM_INT);
                $res->execute();

                $this->error = '';
                $this->msg   = '更新成功';
                $zone        = $input['zone'];
                $sql         = "SELECT field_id FROM zone WHERE zone_id = $zone";
                $res         = $this->db->prepare($sql);
                $res->execute();
                $row = $res->fetchAll();

                $fieldId     = $row[0]['field_id'];
                $this->error = '';
                $this->viewFieldDetail(
                    array(
                        'fieldId' => $fieldId,
                    )
                );
            } catch (PDOException $e) {
                print_r("Error!: " . $e->getMessage());
            }
        } else {
            $this->error = '請先登入!';
            $this->viewLogin();
        }
    }
    /**
     * 刪除圖片
     * @DateTime 2016-09-12
     * @param    array     $url [圖片URL]
     * @return   boolean        [是否刪除成功]
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
     * @DateTime 2016-09-08
     * @param    array     $input [場域與專案ID]
     */
    public function deleteField($input)
    {
        if ($_SESSION['isLogin'] == true) {
            try {
                $projectId = $input['projectId'];
                $fieldId   = $input['fieldId'];

                $sql = "SELECT *
                        FROM zone
                        WHERE field_id = $fieldId";
                $res = $this->db->prepare($sql);
                $res->execute();
                $res = $res->fetchAll();

                if (count($res) > 0) {
                    $this->error = '場域中還有其他資料，請先刪除資料';
                    $this->msg   = '';
                } else {
                    $sql = "SELECT `photo`, `photo_vertical`, `map_svg`
                            FROM field_map
                            WHERE field_map_id = $fieldId";
                    $res = $this->db->prepare($sql);
                    $res->execute();
                    $res = $res->fetchAll();
                    //刪除圖片
                    if ($this->deleteImg($res[0]['photo']) && $this->deleteImg($res[0]['map_svg']) && $this->deleteImg($res[0]['photo_vertical'])) {
                        $this->db->beginTransaction();
                        $sql = "DELETE FROM field_map
                                WHERE field_map_id = $fieldId";
                        $this->db->exec($sql);
                        $this->db->commit();

                        $this->error = '';
                        $this->msg   = '刪除成功';
                    } else {
                        $this->error = '刪除圖片失敗';
                        $this->msg   = '';
                    }
                }
                header('Location:../controller/projectController.php?action=viewProjectDetail&projectId=' . $projectId . '&error=' . $this->error . '&msg=' . $this->msg);

            } catch (PDOException $e) {
                $this->db->rollBack();
                print "Error!: " . $e->getMessage();
            }
        } else {
            header('Location:../controller/userController.php?action=viewLogin');
        }
    }
    /**
     * 刪除Beacon
     * @DateTime 2016-09-10
     * @param    array     $input [Beaconid]
     */
    public function deleteBeacon($input)
    {
        if ($_SESSION['isLogin'] == true) {
            try {
                $this->db->beginTransaction();
                $beaconId = $input['beaconId'];
                $sql      = "DELETE FROM beacon
                           WHERE beacon_id = $beaconId";
                $this->db->exec($sql);
                $this->db->commit();

                $this->error = '';
                $this->msg   = '刪除成功';
                $this->viewFieldDetail($input);
            } catch (PDOException $e) {
                $this->db->rollBack();
                print "Error!: " . $e->getMessage();
            }
        } else {
            $this->error = '請先登入!';
            $this->viewLogin();
        }
    }
    /**
     * 顯示場域詳細資料
     * @DateTime 2016-09-08
     * @param    array     $input [場域與專案ID]
     */
    public function viewFieldDetail($input)
    {
        if ($_SESSION['isLogin'] == true) {
            try {
                $sql = 'SELECT *
                        FROM field_map
                        WHERE field_map_id = :fieldId';
                $res = $this->db->prepare($sql);
                $res->bindParam(':fieldId', $input['fieldId'], PDO::PARAM_INT);
                $res->execute();
                $fieldData = $res->fetchAll();

                $sql = 'SELECT *
                        FROM zone
                        WHERE field_id = :fieldId';
                $res = $this->db->prepare($sql);
                $res->bindParam(':fieldId', $input['fieldId'], PDO::PARAM_INT);
                $res->execute();
                $zoneData = $res->fetchAll();
                //get beacon
                $sql = 'SELECT *
                        FROM beacon
                        WHERE zone = :zoneId
                        ORDER BY beacon_id';
                $res = $this->db->prepare($sql);

                $beaconData = array();
                foreach ($zoneData as $key => $value) {
                    $res->bindParam(':zoneId', $value['zone_id'], PDO::PARAM_INT);
                    $res->execute();
                    $rows = $res->fetchAll();

                    if (count($rows) != 0) {
                        for ($i = 0; $i < count($rows); $i++) {
                            $rows[$i]['zone_name'] = $value['name'];
                            array_push($beaconData, $rows[$i]);
                        }
                    }
                }

                $this->smarty->assign('beaconData', $beaconData);
                $this->smarty->assign('field', $fieldData[0]);
                if (isset($input['error'])) {
                    $this->error = $input['error'];
                }
                if (isset($input['msg'])) {
                    $this->msg = $input['msg'];
                }
                $this->smarty->assign('zone', $zoneData);
                $this->smarty->assign('msg', $this->msg);
                $this->smarty->assign('error', $this->error);
                $this->smarty->assign('homePath', APP_ROOT_DIR);
                $this->smarty->display('field/fieldDetail.html');
            } catch (PDOException $e) {
                print "Error!: " . $e->getMessage();
            }
        } else {
            header('Location:../controller/userController.php?action=viewLogin');
        }
    }
    /**
     * 顯示Beacon清單
     * @DateTime 2016-09-10
     */
    public function viewBeaconList()
    {
        if ($_SESSION['isLogin'] == true) {
            try {
                $sql = 'SELECT *
                        FROM beacon
                        ORDER BY beacon_id';
                $res = $this->db->prepare($sql);
                $res->execute();
                $beaconData = $res->fetchAll();

                //get zone name
                $sql = 'SELECT name
                        FROM zone
                        WHERE zone_id = :zone_id';
                $res = $this->db->prepare($sql);
                foreach ($beaconData as $key => $value) {
                    $res->bindParam(':zone_id', $value['zone'], PDO::PARAM_INT);
                    $res->execute();
                    $zoneName                      = $res->fetchAll();
                    $beaconData[$key]['zone_name'] = $zoneName[0]['name'];
                }

                $this->smarty->assign('beaconData', $beaconData);
                $this->smarty->assign('msg', $this->msg);
                $this->smarty->assign('error', $this->error);
                $this->smarty->assign('homePath', APP_ROOT_DIR);
                $this->smarty->display('beacon/beaconList.html');
            } catch (PDOException $e) {
                print "Error!: " . $e->getMessage();
            }
        } else {
            $this->error = '請先登入!';
            $this->viewLogin();
        }
    }
}
