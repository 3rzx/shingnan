<?php
// initialize
require_once HOME_DIR . 'configs/config.php';

/**
 * 使用者類別
 */
class Beacon
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
     * class constructor
     * @DateTime 2016-09-10
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
     * 顯示login form
     * @DateTime 2016-09-10
     */
    public function viewLogin()
    {
        $_SESSION['isLogin'] = false;
        $this->smarty->assign('error', $this->error);
        $this->smarty->assign('homePath', APP_ROOT_DIR);
        $this->smarty->display('login.html');
    }
    /**
     * 顯示增加Beacon畫面
     * @DateTime 2016-09-10
     * @param    array     $input [未知]
     */
    public function viewAddForm()
    {
        if ($_SESSION['isLogin'] == true) {
            //get all zone_id
            $sql = "SELECT zone_id, name
                    FROM zone
                    ORDER BY zone_id";
            $res = $this->db->prepare($sql);
            $res->execute();
            $zoneId = $res->fetchAll();

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
                        $beaconId    = $this->db->lastInsertId();
                        $this->error = '';
                        header('Location:../controller/beaconController.php?action=viewBeaconList');
                    } else {
                        $error = $res->errorInfo();

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
     * 顯示編輯Beacon畫面
     * @DateTime 2016-09-10
     * @param    array     $input [BeaconID]
     */
    public function viewEditForm($input)
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
                $this->viewBeaconList();
            } catch (PDOException $e) {
                print_r("Error!: " . $e->getMessage());
            }
        } else {
            $this->error = '請先登入!';
            $this->viewLogin();
        }
    }

    /**
     * 刪除使用者
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
                $this->viewBeaconList();
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

    public function logout()
    {
        session_unset();
        session_destroy();
        $this->viewLogin();
    }
}
