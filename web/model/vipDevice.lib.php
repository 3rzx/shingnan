<?php
// initialize
header("Content-Type:text/html; charset=utf-8");
require_once HOME_DIR . 'configs/config.php';
require_once 'upload.func.php';
/**
 * VIP類別
 */
class Vip
{
    // database object
    public $db = null;
    // smarty template object
    public $smarty = null;
    // success messages
    public $msg = '';
    // error messages
    public $error = '';

    public function __construct()
    {
        # code...
        session_start();
        // instantiate the pdo object
        $this->db = dbSetup::getDbConn();
        // instantiate the template object
        $this->smarty = new SmartyConfig();

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
     * 顯示login form
     * @DateTime 2016-09-11
     */
    public function viewLogin()
    {
        $_SESSION['isLogin'] = false;
        $this->smarty->assign('error', $this->error);
        $this->smarty->assign('homePath', APP_ROOT_DIR);
        $this->smarty->display('login.html');
    }

    /**
     * 顯示貴賓證清單
     * @DateTime 2016-09-04
     */
    public function viewVIPList()
    {
        if ($_SESSION['isLogin'] == true) {
            try {
                $sql = 'SELECT *
                        FROM vip_device
                        ORDER BY mac_addr';
                $res = $this->db->prepare($sql);
                $res->execute();
                $vipDeviceData = $res->fetchAll();

                $this->smarty->assign('vipDeviceData', $vipDeviceData);
                $this->smarty->assign('msg', $this->msg);
                $this->smarty->assign('error', $this->error);
                $this->smarty->assign('homePath', APP_ROOT_DIR);
                $this->smarty->display('vipDevice/vipDeviceList.html');
            } catch (PDOException $e) {
                print "Error!: " . $e->getMessage();
            }
        } else {
            $this->error = '請先登入!';
            $this->viewLogin();
        }
    }

    /**
     * 顯示語音清單
     * @DateTime 2016-09-04
     */
    public function viewVIPVoiceList()
    {
        if ($_SESSION['isLogin'] == true) {
            try {
                $sql = "SELECT * FROM vip_voice ";
                $res = $this->db->prepare($sql);
                $res->execute();
                $vipVoiceData = $res->fetchAll();

                $this->smarty->assign('vipVoiceData', $vipVoiceData);
                $this->smarty->assign('msg', $this->msg);
                $this->smarty->assign('error', $this->error);
                $this->smarty->display('vipDevice/vipVoiceList.html');
            } catch (PDOException $e) {
                print "Error!: " . $e->getMessage();
            }
        } else {
            $this->error = '請先登入!';
            $this->viewLogin();
        }
    }

    /**
     * 顯示語音撥放機器清單
     * @DateTime 2016-09-04
     */
    public function viewVIPPiList()
    {
        if ($_SESSION['isLogin'] == true) {
            try {
                $sql = "SELECT * FROM vip_pi";
                $res = $this->db->prepare($sql);
                $res->execute();
                $piData = $res->fetchAll();

                $beacons = array();
                foreach ($piData as $key => $value) {
                    $temp = array();
                    if ($value['visible'] != 0) {
                        $ip     = $value['IPaddress'];
                        $mysqli = new mysqli($ip, 'backend', 'raspberry', 'beacon');
                        if ($mysqli->connect_error) {
                            die('Do not connection(' . $mysqli->connect_errno . ')' . $mysqli->connect_error);
                        }
                        $mysqli->set_charset("utf8");

                        $sql = "SELECT * FROM rssi";
                        $res = $mysqli->query($sql) or die($mysqli->connect_error);

                        // $beacons[$ip] = array();
                        while ($row = $res->fetch_assoc()) {
                            $row['ip'] = $ip;
                            array_push($temp, $row);
                        }
                    }
                    // $temp['ip'] = $ip;
                    array_push($beacons, $temp);
                }

                $sql = "SELECT *
                        FROM vip_voice
                        WHERE 1";
                $res = $this->db->prepare($sql);
                $res->execute();
                $vipVoiceData = $res->fetchAll();

                $sql = "SELECT mac_addr, vip_device_hu_id AS hu_id
                        FROM vip_device
                        WHERE 1";
                $res = $this->db->prepare($sql);
                $res->execute();
                $devices = $res->fetchAll();

                $this->smarty->assign('piData', $piData);
                $this->smarty->assign('beacons', $beacons);
                $this->smarty->assign('vipVoiceData', $vipVoiceData);
                $this->smarty->assign('devices', $devices);
                $this->smarty->assign('msg', $this->msg);
                $this->smarty->assign('error', $this->error);
                $this->smarty->display('vipDevice/vipPiList.html');
            } catch (PDOException $e) {
                print "Error!: " . $e->getMessage();
            }
        } else {
            $this->error = '請先登入!';
            $this->viewLogin();
        }
    }

    /**
     * 顯示新增VIP device form
     * @DateTime 2016-09-11
     */
    public function viewVIPAddForm()
    {
        if ($_SESSION['isLogin'] == true) {
            $this->smarty->assign('error', $this->error);
            $this->smarty->assign('homePath', APP_ROOT_DIR);
            $this->smarty->display('vipDevice/vipDeviceAdd.html');
        } else {
            $this->error = '請先登入!';
            $this->viewLogin();
        }
    }

    /**
     * 顯示新增device form
     * @DateTime 2016-09-11
     */
    public function viewPiAddForm()
    {
        if ($_SESSION['isLogin'] == true) {
            $this->smarty->assign('error', $this->error);
            $this->smarty->assign('homePath', APP_ROOT_DIR);
            $this->smarty->display('vipDevice/vipPiAdd.html');
        } else {
            $this->error = '請先登入!';
            $this->viewLogin();
        }
    }

    /**
     * 顯示新增voice form
     * @DateTime 2016-09-11
     */
    public function viewVIPVoiceAddForm()
    {
        if ($_SESSION['isLogin'] == true) {
            $this->smarty->assign('error', $this->error);
            $this->smarty->display('vipDevice/vipVoiceAdd.html');
        } else {
            $this->error = '請先登入!';
            $this->viewLogin();
        }
    }

    /**
     * 新增device form
     * @DateTime 2016-09-21
     */
    public function addVipDevice($input)
    {
        if ($_SESSION['isLogin'] == true) {
            try {
                $sql = "SELECT mac_addr
                        FROM vip_device
                        WHERE mac_addr = :mac_addr";
                $res = $this->db->prepare($sql);
                $res->bindParam(':mac_addr', $input['macAddr'], PDO::PARAM_STR);
                $res->execute();
                $rows = $res->fetchAll();
                if (count($rows) == 1) {
                    $this->error = '此識別證已經新增';
                    $this->viewVIPAddForm();
                } else {
                    date_default_timezone_set('Asia/Taipei');
                    $now = date('Y-m-d H:i:s');
                    $sql = "INSERT INTO vip_device (mac_addr, vip_device_hu_id, create_date, lastupdate_date)
                            VALUES (:mac_addr, :vip_device_hu_id, :createDate, :lastupdateDate)";
                    $res = $this->db->prepare($sql);
                    $res->bindParam(':mac_addr', $input['macAddr'], PDO::PARAM_STR);
                    $res->bindParam(':vip_device_hu_id', $input['HuId'], PDO::PARAM_INT);
                    $res->bindParam(':createDate', $now, PDO::PARAM_STR);
                    $res->bindParam(':lastupdateDate', $now, PDO::PARAM_STR);

                    if ($res->execute()) {
                        $this->smarty->display('vipDevice/vipDeviceAdd.html');
                    } else {
                        $error = $res->errorInfo();

                        $this->error = $error[0];
                        $this->viewVIPAddForm();
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
     * 新增Voice
     * @DateTime 2016-09-21
     */
    public function addVipVoice($input)
    {
        if ($_SESSION['isLogin'] == true) {
            try {
                $uploadPath = '../media/VIPVoice';
                if ($_FILES['VIPvoice']['error'] == 0) {
                    $fileInfo = $_FILES['VIPvoice'];
                    $voice    = uploadFile($fileInfo, $uploadPath);
                    $now      = date('Y-m-d H:i:s');
                    $sql      = "INSERT INTO vip_voice (voice, voice_name, create_date, lastupdate_date)
                                VALUES (:voice, :voice_name, :createDate, :lastupdateDate)";
                    $res = $this->db->prepare($sql);
                    $res->bindParam(':voice', $voice, PDO::PARAM_STR);
                    $res->bindParam(':voice_name', $input['voiceName'], PDO::PARAM_STR);
                    $res->bindParam(':createDate', $now, PDO::PARAM_STR);
                    $res->bindParam(':lastupdateDate', $now, PDO::PARAM_STR);

                    if ($res->execute()) {
                        $this->viewVIPVoiceList();
                    }

                } else {
                    $this->error = '檔案上傳有誤';
                    $this->smarty->assign('error', $this->error);
                    $this->viewVIPVoiceAddForm();
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
     * 顯示編輯貴賓證畫面
     * @DateTime 2016-09-12
     */
    public function viewVIPEditForm($input)
    {
        if ($_SESSION['isLogin'] == true) {
            // get all data from vip_device
            $sql = 'SELECT *
                    FROM vip_device
                    WHERE vip_device_id = :vipDeviceId';
            $res = $this->db->prepare($sql);
            $res->bindParam(':vipDeviceId', $input['vipDeviceId'], PDO::PARAM_INT);
            $res->execute();
            $vipDeviceData = $res->fetchAll();

            $this->smarty->assign('vip', $vipDeviceData[0]);
            $this->smarty->assign('error', $this->error);
            $this->smarty->assign('homePath', APP_ROOT_DIR);
            $this->smarty->display('vipDevice/vipDeviceEdit.html');
        } else {
            $this->error = '請先登入!';
            $this->viewLogin();
        }
    }

    /**
     * 顯示編輯貴賓語音畫面
     * @DateTime 2016-09-12
     */
    public function viewVIPVoiceEditForm($input)
    {
        if ($_SESSION['isLogin'] == true) {
            // get all data from vip_device
            $sql = 'SELECT * FROM vip_voice WHERE voice_id = :voiceID';
            $res = $this->db->prepare($sql);
            $res->bindParam(':voiceID', $input['voiceID'], PDO::PARAM_INT);
            $res->execute();
            $vipVoiceData = $res->fetch();

            $sql = "SELECT `vip_device_id`, `name` FROM `vip_device`";
            $res = $this->db->prepare($sql);
            $res->execute();
            $allVIP = $res->fetchAll();

            $this->smarty->assign('allVIP', $allVIP);
            $this->smarty->assign('vipVoiceData', $vipVoiceData);
            $this->smarty->assign('error', $this->error);
            $this->smarty->display('vipDevice/vipVoiceSet.html');
        } else {
            $this->error = '請先登入!';
            $this->viewLogin();
        }
    }

    /**
     * 編輯貴賓證
     * @DateTime 2016-09-12
     */
    public function editVipDevice($input)
    {
        if ($_SESSION['isLogin'] == true) {
            try {
                date_default_timezone_set('Asia/Taipei');
                $now = date('Y-m-d H:i:s');
                $sql = 'UPDATE vip_device
                        SET mac_addr = :macAddr, vip_device_hu_id = :vip_device_hu_id, name = :name, lastupdate_date = :lastupdateDate
                        WHERE vip_device_id = :vipDeviceId';
                $res = $this->db->prepare($sql);
                $res->bindParam(':macAddr', $input['macAddr'], PDO::PARAM_STR);
                $res->bindParam(':name', $input['name'], PDO::PARAM_STR);
                $res->bindParam(':vip_device_hu_id', $input['HuId'], PDO::PARAM_INT);
                $res->bindParam(':lastupdateDate', $now, PDO::PARAM_STR);
                $res->bindParam(':vipDeviceId', $input['vipDeviceId'], PDO::PARAM_INT);
                $res->execute();

                $this->viewVIPList();
            } catch (PDOException $e) {
                print_r("Error!: " . $e->getMessage());
            }
        } else {
            $this->error = '請先登入!';
            $this->viewLogin();
        }
    }

    /**
     * 編輯貴賓證
     * @DateTime 2016-09-12
     */
    public function viewVIPSetForm($input)
    {
        if ($_SESSION['isLogin'] == true) {
            // get all data from vip_device
            $sql = 'SELECT *
                    FROM vip_device
                    WHERE vip_device_id = :vipDeviceId';
            $res = $this->db->prepare($sql);
            $res->bindParam(':vipDeviceId', $input['vipDeviceId'], PDO::PARAM_INT);
            $res->execute();
            $vipDeviceData = $res->fetchAll();

            $this->smarty->assign('vipDeviceData', $vipDeviceData[0]);
            $this->smarty->assign('error', $this->error);
            $this->smarty->assign('homePath', APP_ROOT_DIR);
            $this->smarty->display('vipDevice/vipDeviceSet.html');
        } else {
            $this->error = '請先登入!';
            $this->viewLogin();
        }
    }

    /**
     * 編輯貴賓證
     * @DateTime 2016-09-12
     */
    public function setVipDevice($input)
    {
        if ($_SESSION['isLogin'] == true) {
            // 新增使用者姓名
            try {
                $sql = 'UPDATE vip_device
                    SET name = :name
                    WHERE vip_device_id = :vipDeviceId';
                $res = $this->db->prepare($sql);
                $res->bindParam(':name', $input['name'], PDO::PARAM_STR);
                $res->bindParam(':vipDeviceId', $input['vipDeviceId'], PDO::PARAM_INT);
                $res->execute();
                // 更新最後修改時間
                date_default_timezone_set('Asia/Taipei');
                $now = date('Y-m-d H:i:s');
                $sql = "UPDATE vip_device
                    SET lastupdate_date = :lastupdateDate
                    WHERE vip_device_id = :vipDeviceId";
                $res = $this->db->prepare($sql);
                $res->bindParam(':lastupdateDate', $now, PDO::PARAM_STR);
                $res->bindParam(':vipDeviceId', $input['vipDeviceId'], PDO::PARAM_INT);
                $res->execute();

                $this->error = '';
                $this->msg   = '租借成功';
                $this->viewVIPList();
            } catch (PDOException $e) {
                print_r("Error!: " . $e->getMessage());
            }
        } else {
            $this->error = '請先登入!';
            $this->viewLogin();
        }
    }

    /**
     * 編輯貴賓語音
     * @DateTime 2016-09-22
     */
    public function setVipVoice($input)
    {
        if ($_SESSION['isLogin'] == true) {
            // 新增使用者姓名
            $voiceID = $input['voiceID'];
            try {
                $now = date('Y-m-d H:i:s');
                $sql = 'UPDATE vip_voice SET voice_name = :voice_name, lastupdate_date = :lastupdateDate WHERE voice_id = :voiceID';
                $res = $this->db->prepare($sql);
                $res->bindParam(':lastupdateDate', $now, PDO::PARAM_STR);
                $res->bindParam(':voice_name', $input['voiceName'], PDO::PARAM_STR);
                $res->bindParam(':voiceID', $voiceID, PDO::PARAM_INT);

                if ($res->execute()) {
                    //找出舊有的語音
                    $sql = "SELECT voice FROM vip_voice WHERE voice_id = '$voiceID'";
                    $res = $this->db->prepare($sql);
                    $res->execute();
                    $row = $res->fetchAll();

                    $uploadPath = '../media/VIPVoice';
                    if ($_FILES['VIPvoice']['error'] == 0) {
                        $fileInfo = $_FILES['VIPvoice'];
                        $VIPvoice = uploadFile($fileInfo, $uploadPath);
                        if ($this->deleteImg($row[0]['voice'])) {
                            $now = date('Y-m-d H:i:s');
                            $sql = "UPDATE vip_voice SET voice = :voice,  lastupdate_date = :lastupdateDate WHERE voice_id = '$voiceID'";
                            $res = $this->db->prepare($sql);
                            $res->bindParam(':voice', $VIPvoice, PDO::PARAM_STR);
                            $res->bindParam(':lastupdateDate', $now, PDO::PARAM_STR);

                            $res->execute();
                        }
                    }
                    $this->error = '';
                    $this->msg   = '修改成功';
                    $this->viewVIPVoiceList();
                } else {
                    $error       = $res->errorInfo();
                    $this->error = $error[0];
                    $this->smarty->assign('error', $this->error);
                    $this->viewVIPVoiceList();
                }
            } catch (PDOException $e) {
                print_r("Error!: " . $e->getMessage());
            }
        } else {
            $this->error = '請先登入!';
            $this->viewLogin();
        }
    }

    /**
     * 刪除
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
     * 歸還貴賓證
     * @DateTime 2016-09-12
     */
    public function returnVIP($input)
    {
        if ($_SESSION['isLogin'] == true) {
            // 刪除使用者姓名
            try {
                $sql = 'UPDATE vip_device
                    SET name = null
                    WHERE vip_device_id = :vipDeviceId';
                $res = $this->db->prepare($sql);
                $res->bindParam(':vipDeviceId', $input['vipDeviceId'], PDO::PARAM_STR);
                $res->execute();
                // 更新最後修改時間
                date_default_timezone_set('Asia/Taipei');
                $now = date('Y-m-d H:i:s');
                $sql = "UPDATE vip_device
                    SET lastupdate_date = :lastupdateDate
                    WHERE vip_device_id = :vipDeviceId";
                $res = $this->db->prepare($sql);
                $res->bindParam(':lastupdateDate', $now, PDO::PARAM_STR);
                $res->bindParam(':vipDeviceId', $input['vipDeviceId'], PDO::PARAM_INT);
                $res->execute();
                $this->error = '';
                $this->msg   = '歸還成功';
                $this->viewVIPList();
            } catch (PDOException $e) {
                print_r("Error!: " . $e->getMessage());
            }
        } else {
            $this->error = '請先登入!';
            $this->viewLogin();
        }
    }

    public function deletePiDevice($input)
    {
        if ($_SESSION['isLogin'] == true) {
            try {
                $sql = "DELETE FROM vip_pi
                    WHERE IPaddress = :IPaddress";
                $res = $this->db->prepare($sql);
                $res->bindParam(':IPaddress', $input['ip'], PDO::PARAM_STR);
                if ($res->execute()) {
                    $this->error = '';
                    $this->msg   = '刪除成功';
                    $this->smarty->assign('error', $this->error);
                    $this->smarty->assign('msg', $this->msg);
                    $this->viewVIPPiList();
                } else {
                    $error       = $res->errorInfo();
                    $this->error = $error[1];
                    $this->smarty->assign('error', $this->error);
                    $this->smarty->assign('msg', $this->msg);
                    $this->viewVIPPiList();
                }
            } catch (PDOException $e) {
                print_r("Error!: " . $e->getMessage());
            }
        } else {
            $this->error = '請先登入!';
            $this->viewLogin();
        }
    }

    public function deleteVIPDevice($input)
    {
        if ($_SESSION['isLogin'] == true) {
            // 刪除貴賓證語音
            try {
                $sql = "DELETE FROM vip_device
                        WHERE vip_device_id = :vipDeviceId";
                $res = $this->db->prepare($sql);
                $res->bindParam(':vipDeviceId', $input['vipDeviceId'], PDO::PARAM_STR);
                if ($res->execute()) {
                    $this->error = '';
                    $this->msg   = '刪除成功';
                    $this->smarty->assign('error', $this->error);
                    $this->smarty->assign('msg', $this->msg);
                    $this->viewVIPList();
                } else {
                    $error       = $res->errorInfo();
                    $this->error = $error[1];
                    $this->smarty->assign('error', $this->error);
                    $this->smarty->assign('msg', $this->msg);
                    $this->viewVIPList();
                }

            } catch (PDOException $e) {
                print_r("Error!: " . $e->getMessage());
            }
        } else {
            $this->error = '請先登入!';
            $this->viewLogin();
        }
    }

    /**
     * 刪除貴賓證語音
     * @param      voiceID
     * @DateTime 2016-09-22
     */
    public function deleteVIPVoice($input)
    {
        if ($_SESSION['isLogin'] == true) {
            // 刪除貴賓證語音
            try {
                $sql = "DELETE FROM vip_voice
                        WHERE voice_id = :voiceID";
                $res = $this->db->prepare($sql);
                $res->bindParam(':voiceID', $input['voiceID'], PDO::PARAM_STR);
                if ($res->execute()) {
                    $this->error = '';
                    $this->msg   = '刪除成功';
                    $this->smarty->assign('error', $this->error);
                    $this->smarty->assign('msg', $this->msg);
                    $this->viewVIPVoiceList();
                } else {
                    $error       = $res->errorInfo();
                    $this->error = $error[1];
                    $this->smarty->assign('error', $this->error);
                    $this->smarty->assign('msg', $this->msg);
                    $this->viewVIPVoiceList();
                }

            } catch (PDOException $e) {
                print_r("Error!: " . $e->getMessage());
            }
        } else {
            $this->error = '請先登入!';
            $this->viewLogin();
        }
    }
}
