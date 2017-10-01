<?php
// initialize
require_once HOME_DIR . 'configs/config.php';

/**
 * 使用者類別
 */
class journal{
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
     * 新增路徑顯示
     * @DateTime 2016-09-08
     */
    public function addJournalPrepare(){
        if ($_SESSION['isLogin'] == true) {
            try {
                $rh = $this->db->prepare('SELECT MAX(path_id) AS max FROM path ;');
                $rh->execute();
                $maxPath = $rh->fetch();
                $this->smartyTemplate->assign('maxPath', $maxPath);

                $rh = $this->db->prepare('SELECT field_map_id, name FROM field_map;');
                $rh->execute();
                $allField = $rh->fetchAll();
                $this->smartyTemplate->assign('allField', $allField);

                $rh = $this->db->prepare('SELECT zone_id, name, field_id FROM zone ORDER BY field_id;');
                $rh->execute();
                $allZone = $rh->fetchAll();
                $this->smartyTemplate->assign('allZone', $allZone);

                $this->smartyTemplate->assign('error', $this->error);
                $this->smartyTemplate->assign('msg', $this->msg);

                $this->smartyTemplate->display('journal/journalAdd.html');

            } catch (PDOException $e) {
                print "Error!: " . $e->getMessage();
                $this->smartyTemplate->assign('error', $e->getMessage());
            }
        } else {
           header('Location:../controller/userController.php?action=viewLogin');
        }
    }

    /**
     * 新增路徑
     * @DateTime 2016-09-11
     * @param array $input[路徑資料]
     */
    public function addJournal($input){
        if ($_SESSION['isLogin'] == true) {
            try {
                $pathCount = $input['pathCount'];

                //新增路線
                for($i=0;$i<$pathCount;$i++){
                    if($input['zoneChoose'.$i] != 'null'){
                        $now = date('Y-m-d H:i:s');
                        $sql = 'INSERT INTO path (path_id, zone_id, `order`, create_date, lastupdate_date)
                                VALUES (:path_id, :zone_id, :order, :createDate, :lastupdateDate)';
                        $res = $this->db->prepare($sql);
                        $res->bindParam(':path_id', $input['pathId'], PDO::PARAM_INT);
                        $res->bindParam(':zone_id', $input['zoneChoose'.$i], PDO::PARAM_INT);
                        $j = $i+1;
                        $res->bindParam(':order', $j, PDO::PARAM_INT);
                        $res->bindParam(':createDate', $now, PDO::PARAM_STR);
                        $res->bindParam(':lastupdateDate', $now, PDO::PARAM_STR);
                        if(!$res->execute()){
                            $error = $res->errorInfo();
                            $this->error = $error[0];
                            $this->msg = '';
                            $this->addJournalPrepare();
                            break;
                        }
                    }else{
                        break;
                    }
                }
               
                $this->msg = '新增成功';
                $this->smartyTemplate->assign('error', $this->error);
                $this->smartyTemplate->assign('msg', $this->msg);
                $this->listJournal();
                
            } catch (PDOException $e) {
                print "Error!: " . $e->getMessage();
                $this->smartyTemplate->assign('error', $e->getMessage());
            }
        } else {
            header('Location:../controller/userController.php?action=viewLogin');
        }
    }

    /**
     * path列表
     * @DateTime 2016-09-08
     */
    public function listJournal(){
        if ($_SESSION['isLogin'] == true) {
            try {
                $FilePath = fopen("../pathUsed.txt", "r") or die("Unable to open file!");
                $pathUsed=fgets($FilePath);
                fclose($FilePath);
                $this->smartyTemplate->assign('pathUsed', $pathUsed);

                $rh = $this->db->prepare('SELECT path.path_id, path.zone_id, path.order, path.create_date, path.lastupdate_date, 
                                          zone.name FROM path INNER JOIN zone ON path.zone_id = zone.zone_id ORDER BY `order`');
                $rh->execute();
                $allPath = $rh->fetchAll();
                $this->smartyTemplate->assign('allPath', $allPath);

                $rh = $this->db->prepare('SELECT DISTINCT path_id FROM path');
                $rh->execute();
                $pathCount = $rh->fetchAll();
                $this->smartyTemplate->assign('pathCount', $pathCount);

                $this->smartyTemplate->assign('error', $this->error);
                $this->smartyTemplate->assign('msg', $this->msg);

                $this->smartyTemplate->display('journal/journalList.html');

            } catch (PDOException $e) {
                print "Error!: " . $e->getMessage();
                $this->smartyTemplate->assign('error', $e->getMessage());
            }
        } else {
            header('Location:../controller/userController.php?action=viewLogin');
        }
    }

    /**
     * path編輯列表
     * @DateTime 2016-09-10
     * @param array $input[路徑ID]
     */
    public function updateJournalPrepare($input){
        if ($_SESSION['isLogin'] == true) {
            try{
                $sql = 'SELECT path.path_id, path.zone_id, path.order, zone.name FROM path 
                        INNER JOIN zone ON path.zone_id = zone.zone_id 
                        WHERE path_id = :journalId ORDER BY `order`';
                $res = $this->db->prepare($sql);
                $res->bindParam(':journalId', $input['journalId'], PDO::PARAM_INT);
                $res->execute();
                $pathData = $res->fetchAll();
                $pathCount = count($pathData);

                //先知道這條路在哪一個場域/
                $sql = 'SELECT field_map.field_map_id AS field
                        FROM path
                        INNER JOIN ( zone INNER JOIN field_map ON zone.field_id = field_map.field_map_id ) 
                        ON path.zone_id = zone.zone_id
                        WHERE path.path_id = :journalId
                        LIMIT 0 , 1';
                $res = $this->db->prepare($sql);
                $res->bindParam(':journalId', $input['journalId'], PDO::PARAM_INT);
                $res->execute();
                $pathField = $res->fetch();

                $sql = 'SELECT zone.zone_id, zone.name FROM zone
                        INNER JOIN field_map ON field_map.field_map_id = zone.field_id
                        WHERE zone.field_id = :pathField ORDER BY zone.zone_id';
                $res = $this->db->prepare($sql);
                $res->bindParam(':pathField', $pathField['field'], PDO::PARAM_INT);
                $res->execute();
                $pathData2 = $res->fetchAll();

                $pathID = $input['journalId'];
                $this->smartyTemplate->assign('pathData', $pathData);
                $this->smartyTemplate->assign('pathData2', $pathData2);
                $this->smartyTemplate->assign('pathID', $pathID);
                $this->smartyTemplate->assign('pathCount', $pathCount);
                $this->smartyTemplate->assign('error', $this->error);
                $this->smartyTemplate->assign('msg', $this->msg);

                $this->smartyTemplate->display('journal/journalEdit.html');
            } catch (PDOException $e) {
                print "Error!: " . $e->getMessage();
                $this->smartyTemplate->assign('error', $e->getMessage());
            }
        } else {
            header('Location:../controller/userController.php?action=viewLogin');
        }
    }

    /**
     * path編輯
     * @DateTime 2016-09-11
     * @param array $input[路徑內容]
     */
    public function updateJournal($input){
        if ($_SESSION['isLogin'] == true) {
            try{
                $pathID = $input['pathId'];                

                //取得舊資料
                $sql = 'SELECT path.zone_id, path.`order` FROM path 
                        WHERE path_id = :journalId ORDER BY `order`';
                $res = $this->db->prepare($sql);
                $res->bindParam(':journalId', $pathID, PDO::PARAM_INT);
                $res->execute();
                $pathOldData = $res->fetchAll(PDO::FETCH_ASSOC);
                $i=0;

                //將有改變的update
                foreach($pathOldData as $row){
                    if( $row['zone_id'] != $input['zoneChoose'.$i] ){
                        $now = date('Y-m-d H:i:s');
                        
                        //先刪除
                        $sql2 = 'DELETE FROM path WHERE path_id = :pathId AND zone_id = :zone_id';
                        $res2 = $this->db->prepare($sql2);
                        $res2->bindParam(':pathId', $pathID, PDO::PARAM_INT);
                        $res2->bindParam(':zone_id', $input['zoneChoose'.$i], PDO::PARAM_INT);
                        $res2->execute();

                        //在新增
                        $sql3 = 'INSERT INTO path (path_id, zone_id, `order`, create_date, lastupdate_date)
                                VALUES (:path_id, :zone_id, :order, :createDate, :lastupdateDate)';
                        $res3 = $this->db->prepare($sql3);
                        $res3->bindParam(':path_id', $pathID, PDO::PARAM_INT);
                        $res3->bindParam(':zone_id', $input['zoneChoose'.$i], PDO::PARAM_INT);
                        $j = $i+1;
                        $res3->bindParam(':order', $j, PDO::PARAM_INT);
                        $res3->bindParam(':createDate', $now, PDO::PARAM_STR);
                        $res3->bindParam(':lastupdateDate', $now, PDO::PARAM_STR);
                        
                        if(!$res3->execute()){
                            $error = $res3->errorInfo();
                            $this->error = $error[0];
                            $this->msg = '';
                            //$this->editJournalPrepare();
                            //break;
                            $this->listJournal();
                        }
                    } 
                    $i++;                     
                }
                $this->msg = '成功更新';
                $this->smartyTemplate->assign('error', $this->error);
                $this->smartyTemplate->assign('msg', $this->msg);

                $this->listJournal();
            } catch (PDOException $e) {
                print "Error!: " . $e->getMessage();
                $this->smartyTemplate->assign('error', $e->getMessage());
            }
        } else {
            header('Location:../controller/userController.php?action=viewLogin');
        }
    }


    /**
     *  path刪除
     * @DateTime 2016-09-11
     * @param array $input[路徑ID]
     */
    public function delectPath($input){
        if ($_SESSION['isLogin'] == true) {
            try{

                $this->db->beginTransaction();
                $sql = 'DELETE FROM path WHERE path_id = :pathId';
                $res = $this->db->prepare($sql);
                $res->bindParam(':pathId', $input['journalId'], PDO::PARAM_INT);
                $res->execute();
                $this->db->commit();

                $this->msg = '刪除成功';
                $this->smartyTemplate->assign('error', $this->error);
                $this->smartyTemplate->assign('msg', $this->msg);
                $this->listJournal();
            } catch (PDOException $e) {
                print "Error!: " . $e->getMessage();
                $this->smartyTemplate->assign('error', $e->getMessage());
            }
        } else {
            header('Location:../controller/userController.php?action=viewLogin');
        }
    }    

    /**
     * 設定APP使用路線
     * @DateTime 2016-09-11
     * @param array $input[路徑ID]
     */
    public function editPathUsed($input){
        if ($_SESSION['isLogin'] == true) {
            try{
                $FilePath = fopen("../pathUsed.txt", "w") or die("Unable to open file!");

                $pathID = $input['pathId'];
                fwrite($FilePath, $pathID);
                fclose($FilePath);

                $this->msg = '設定成功';
                $this->smartyTemplate->assign('error', $this->error);
                $this->smartyTemplate->assign('msg', $this->msg);
                $this->listJournal();
            } catch (PDOException $e) {
                print "Error!: " . $e->getMessage();
                $this->smartyTemplate->assign('error', $e->getMessage());
            }
        } else {
           header('Location:../controller/userController.php?action=viewLogin');
        }
    }
}
