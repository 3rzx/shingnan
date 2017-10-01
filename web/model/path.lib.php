<?php
// initialize
require_once HOME_DIR . 'configs/config.php';

/**
 * 使用者類別
 */
class path{
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
     * choose_path新增路徑顯示
     * @DateTime 2016-09-08
     */
    public function addChoosePathPrepare(){
        if ($_SESSION['isLogin'] == true) {
            try {
                
                $rh = $this->db->prepare('SELECT  `path`.`path_id` , `path`.`svg_id` ,  `path`.`start` ,  
                                            `Sname`.`name` AS  `Sn` ,  `path`.`end` ,  `Ename`.`name` AS  `En` 
                                        FROM  `path` ,
                                        ( SELECT  `zone`.`name` ,  `zone`.`zone_id` FROM  `zone`) AS  `Sname` , 
                                        ( SELECT  `zone`.`name` ,  `zone`.`zone_id` FROM  `zone`) AS  `Ename` 
                                        WHERE  `path`.`start` =  `Sname`.`zone_id` 
                                        AND  `path`.`end` =  `Ename`.`zone_id` 
                                        ORDER BY `path`.`svg_id` ');
                $rh->execute();
                $allPath = $rh->fetchAll();
                $this->smartyTemplate->assign('allPath', $allPath);

                $this->smartyTemplate->assign('error', $this->error);
                $this->smartyTemplate->assign('msg', $this->msg);

                $this->smartyTemplate->display('path/choosePathAdd.html');

            } catch (PDOException $e) {
                print "Error!: " . $e->getMessage();
                $this->smartyTemplate->assign('error', $e->getMessage());
            }
        } else {
           header('Location:../controller/userController.php?action=viewLogin');
        }
    }


    /**
     * path新增路徑顯示
     * @DateTime 2016-09-08
     */
    public function addPathPrepare(){
        if ($_SESSION['isLogin'] == true) {
            try {

                $rh = $this->db->prepare('SELECT svg_id FROM path');
                $rh->execute();
                $allSvgID = $rh->fetchAll();
                $this->smartyTemplate->assign('allSvgID', $allSvgID);

                $rh = $this->db->prepare('SELECT zone_id, name FROM zone ORDER BY zone_id');
                $rh->execute();
                $allZone = $rh->fetchAll();
                $this->smartyTemplate->assign('allZone', $allZone);

                $this->smartyTemplate->assign('error', $this->error);
                $this->smartyTemplate->assign('msg', $this->msg);

                $this->smartyTemplate->display('path/pathAdd.html');

            } catch (PDOException $e) {
                print "Error!: " . $e->getMessage();
                $this->smartyTemplate->assign('error', $e->getMessage());
            }
        } else {
           header('Location:../controller/userController.php?action=viewLogin');
        }
    }

    /**
     * choose_path新增路徑
     * @DateTime 2016-09-11
     * @param array $input[路徑資料]
     */
    public function addChoosePath($input){
        if ($_SESSION['isLogin'] == true) {
            try {
                $res = $this->db->prepare('SELECT max(choose_path_id) FROM choose_path');
                $res->execute();
                $max = $res->fetch();
                $choosePathID = $max[0]+1;
                
                $pathCount = $input['pathCount'];
                //新增路線
                for($i=1;$i<=$pathCount;$i++){
                    if($input['path'.$i] != 'null'){
                        $now = date('Y-m-d H:i:s');
                        $sql = 'INSERT INTO choose_path (`choose_path_id`, `svg_id`, `order`, create_date, lastupdate_date)
                                VALUES (:choose_path_id, :svg_id, :order, :createDate, :lastupdateDate)';
                        $res = $this->db->prepare($sql);
                        $res->bindParam(':choose_path_id', $choosePathID, PDO::PARAM_INT);
                        $res->bindParam(':svg_id', $input['path'.$i], PDO::PARAM_STR);
                        $res->bindParam(':order', $i, PDO::PARAM_INT);
                        $res->bindParam(':createDate', $now, PDO::PARAM_STR);
                        $res->bindParam(':lastupdateDate', $now, PDO::PARAM_STR);
                        if(!$res->execute()){
                            $error = $res->errorInfo();
                            $this->error = $error[0];
                            $this->msg = '';
                            $this->addChoosePathPrepare();
                            break;
                        }
                    }else{
                        break;
                    }
                }
               
                $this->msg = '新增成功';
                $this->smartyTemplate->assign('error', $this->error);
                $this->smartyTemplate->assign('msg', $this->msg);
                $this->listChoosePath();
                
            } catch (PDOException $e) {
                print "Error!: " . $e->getMessage();
                $this->smartyTemplate->assign('error', $e->getMessage());
            }
        } else {
            header('Location:../controller/userController.php?action=viewLogin');
        }
    }

    /**
     * path新增路徑
     * @DateTime 2016-10-15
     * @param array $input[路徑資料]
     */
    public function addPath($input){
        if ($_SESSION['isLogin'] == true) {
            try {

                //新增path
                $now = date('Y-m-d H:i:s');
                $sql = 'INSERT INTO path (start, end, svg_id, create_date, lastupdate_date)
                                VALUES (:start, :end, :svg_id, :createDate, :lastupdateDate)';
                $res = $this->db->prepare($sql);
                $res->bindParam(':start', $input['start'], PDO::PARAM_INT);
                $res->bindParam(':end', $input['end'], PDO::PARAM_INT);
                $res->bindParam(':svg_id', $input['svg_id'], PDO::PARAM_STR);
                $res->bindParam(':createDate', $now, PDO::PARAM_STR);
                $res->bindParam(':lastupdateDate', $now, PDO::PARAM_STR);
                if(!$res->execute()){
                    $error = $res->errorInfo();
                    $this->error = $error[0];
                    $this->msg = '';
                    $this->addPathPrepare();
                }

                $this->msg = '新增成功';
                $this->smartyTemplate->assign('error', $this->error);
                $this->smartyTemplate->assign('msg', $this->msg);
                $this->listPath();
                
            } catch (PDOException $e) {
                print "Error!: " . $e->getMessage();
                $this->smartyTemplate->assign('error', $e->getMessage());
            }
        } else {
            header('Location:../controller/userController.php?action=viewLogin');
        }
    }


    /**
     * choose_path列表
     * @DateTime 2016-09-08
     */
    public function listChoosePath(){
        if ($_SESSION['isLogin'] == true) {
            try {
                $FilePath = fopen("../pathUsed.txt", "r") or die("Unable to open file!");
                $pathUsed=fgets($FilePath);
                fclose($FilePath);
                $this->smartyTemplate->assign('pathUsed', $pathUsed);

                $rh = $this->db->prepare('SELECT  `choose_path`.`choose_path_id` ,  `choose_path`.`order` ,  `choose_path`.`svg_id` ,  `path`.`start` ,  `Sname`.`name` AS  `Sn` ,  `path`.`end` ,  `Ename`.`name` AS  `En` , `choose_path`.`create_date` ,  `choose_path`.`lastupdate_date` 
                                    FROM  `path` ,  `choose_path` , 
                                    ( SELECT  `zone`.`name` ,  `zone`.`zone_id` FROM  `zone` ) AS `Sname` , 
                                    ( SELECT  `zone`.`name` ,  `zone`.`zone_id` FROM  `zone` ) AS `Ename` 
                                    WHERE  `path`.`start` =  `Sname`.`zone_id` 
                                    AND  `path`.`end` =  `Ename`.`zone_id` 
                                    AND  `choose_path`.`svg_id` = `path`.`svg_id`
                                    ORDER BY  `choose_path`.`order` ');
                $rh->execute();
                $allPath = $rh->fetchAll();
                $this->smartyTemplate->assign('allPath', $allPath);

                $rh = $this->db->prepare('SELECT DISTINCT `choose_path`.`choose_path_id` FROM  `choose_path` ');
                $rh->execute();
                $pathCount = $rh->fetchAll();
                $this->smartyTemplate->assign('pathCount', $pathCount);

                $this->smartyTemplate->assign('error', $this->error);
                $this->smartyTemplate->assign('msg', $this->msg);

                $this->smartyTemplate->display('path/choosePathList.html');

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
    public function listPath(){
        if ($_SESSION['isLogin'] == true) {
            try {
                $rh = $this->db->prepare('SELECT  `path`.`path_id`, `path`.`svg_id` ,  `path`.`start` ,  `Sname`.`name` AS  `Sn` ,  `path`.`end` ,  `Ename`.`name` AS  `En` ,  `path`.`create_date` ,  `path`.`lastupdate_date` 
                        FROM  `path` , 
                        ( SELECT  `zone`.`name` ,  `zone`.`zone_id` FROM  `zone` ) AS  `Sname` , 
                        ( SELECT  `zone`.`name` ,  `zone`.`zone_id` FROM  `zone` ) AS  `Ename` 
                        WHERE  `path`.`start` =  `Sname`.`zone_id` 
                        AND  `path`.`end` =  `Ename`.`zone_id` 
                        ORDER BY `path`.`svg_id` ');
                $rh->execute();
                $allPath = $rh->fetchAll();
                $this->smartyTemplate->assign('allPath', $allPath);

                $this->smartyTemplate->assign('error', $this->error);
                $this->smartyTemplate->assign('msg', $this->msg);

                $this->smartyTemplate->display('path/pathList.html');

            } catch (PDOException $e) {
                print "Error!: " . $e->getMessage();
                $this->smartyTemplate->assign('error', $e->getMessage());
            }
        } else {
            header('Location:../controller/userController.php?action=viewLogin');
        }
    }


    /**
     * choose_path編輯列表
     * @DateTime 2016-09-10
     * @param array $input[路徑ID]
     */
    public function updateChoosePathPrepare($input){
        if ($_SESSION['isLogin'] == true) {
            try{
                $choosePathID = $input['choosePathID'];
                $rh = $this->db->prepare('SELECT  `path`.`path_id` , `path`.`svg_id` ,  `path`.`start` ,  
                                            `Sname`.`name` AS  `Sn` ,  `path`.`end` ,  `Ename`.`name` AS  `En` 
                                        FROM  `path` ,
                                        ( SELECT  `zone`.`name` ,  `zone`.`zone_id` FROM  `zone`) AS  `Sname` , 
                                        ( SELECT  `zone`.`name` ,  `zone`.`zone_id` FROM  `zone`) AS  `Ename` 
                                        WHERE  `path`.`start` =  `Sname`.`zone_id` 
                                        AND  `path`.`end` =  `Ename`.`zone_id` 
                                        ORDER BY `path`.`svg_id` ');
                $rh->execute();
                $allPath = $rh->fetchAll();
                $this->smartyTemplate->assign('allPath', $allPath);

                $sql = 'SELECT  `choose_path`.`choose_path_id` ,  `choose_path`.`order` ,  `choose_path`.`svg_id` ,  `path`.`start` ,  `Sname`.`name` AS  `Sn` ,  `path`.`end` ,  `Ename`.`name` AS  `En` , `choose_path`.`create_date` ,  `choose_path`.`lastupdate_date` 
                                    FROM  `path` ,  `choose_path` , 
                                    ( SELECT  `zone`.`name` ,  `zone`.`zone_id` FROM  `zone` ) AS `Sname` , 
                                    ( SELECT  `zone`.`name` ,  `zone`.`zone_id` FROM  `zone` ) AS `Ename` 
                                    WHERE  `path`.`start` =  `Sname`.`zone_id` 
                                    AND `path`.`end` =  `Ename`.`zone_id` 
                                    AND `choose_path`.`svg_id` =  `path`.`svg_id` 
                                    AND `choose_path`.`choose_path_id` = :choosePathID
                                    ORDER BY  `choose_path`.`order` ';
                $res = $this->db->prepare($sql);
                $res->bindParam(':choosePathID', $choosePathID, PDO::PARAM_INT);
                $res->execute();
                $pathData = $res->fetchAll();
                $this->smartyTemplate->assign('pathData', $pathData);
                $pathCount = count($pathData);
                $this->smartyTemplate->assign('pathCount',$pathCount);

                $this->smartyTemplate->assign('choosePathID',$choosePathID);
                $this->smartyTemplate->assign('error', $this->error);
                $this->smartyTemplate->assign('msg', $this->msg);

                $this->smartyTemplate->display('path/choosePathEdit.html');
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
    public function updatePathPrepare($input){
        if ($_SESSION['isLogin'] == true) {
            try{
                $pathID = $input['pathID'];
                $sql = 'SELECT * FROM path WHERE path_id = ' . $pathID;
                $rh = $this->db->prepare($sql);
                $rh->execute();
                $pathData = $rh->fetch();
                $this->smartyTemplate->assign('pathData', $pathData);

                //先知道一些其他資訊/
                $rh = $this->db->prepare('SELECT svg_id FROM path');
                $rh->execute();
                $allSvgID = $rh->fetchAll();
                $this->smartyTemplate->assign('allSvgID', $allSvgID);

                $rh = $this->db->prepare('SELECT zone_id, name FROM zone ORDER BY zone_id');
                $rh->execute();
                $allZone = $rh->fetchAll();
                $this->smartyTemplate->assign('allZone', $allZone);

                $this->smartyTemplate->assign('pathID', $pathID);
                $this->smartyTemplate->assign('error', $this->error);
                $this->smartyTemplate->assign('msg', $this->msg);

                $this->smartyTemplate->display('path/pathEdit.html');
            } catch (PDOException $e) {
                print "Error!: " . $e->getMessage();
                $this->smartyTemplate->assign('error', $e->getMessage());
            }
        } else {
            header('Location:../controller/userController.php?action=viewLogin');
        }
    }

    /**
     * choose_path編輯
     * @DateTime 2016-09-11
     * @param array $input[路徑內容]
     */
    public function updateChoosePath($input){
        if ($_SESSION['isLogin'] == true) {
            try{
                $choosePathID = $input['choosePathID'];                
                $pathCount = $input['pathCount'];
                //echo $choosePathID . $pathCount;
            
                //將有改變的update
                for($i=1;$i<=$pathCount;$i++){
                    $now = date('Y-m-d H:i:s');
                    $sql = 'UPDATE choose_path SET svg_id = :svg_id, lastupdate_date = :lastupdateDate
                    WHERE choose_path_id = :choosePathID
                    AND `order` = :order ' ;
                    $res = $this->db->prepare($sql);
                    $res->bindParam(':svg_id', $input['path'.$i], PDO::PARAM_STR);
                    $res->bindParam(':lastupdateDate', $now, PDO::PARAM_STR);
                    $res->bindParam(':choosePathID',$choosePathID,PDO::PARAM_INT);
                    $res->bindParam(':order',$i,PDO::PARAM_INT);
                        
                    if(!$res->execute()){
                        $error = $res3->errorInfo();
                        $this->error = $error[0];
                        $this->msg = '';
                        $this->listChoosePath();
                    }
                }                      
                $this->msg = '成功更新';
                $this->smartyTemplate->assign('error', $this->error);
                $this->smartyTemplate->assign('msg', $this->msg);

                $this->listChoosePath();
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
    public function updatePath($input){
        if ($_SESSION['isLogin'] == true) {
            try{
                //echo $input['svg_id'].$input['start'].$input['end'].$input['pathID'];
                $now = date('Y-m-d H:i:s');
                $sql = 'UPDATE path SET svg_id = :svg_id, start = :start , end = :end , lastupdate_date = :lastupdateDate
                    WHERE path_id = :pathID';
                $res = $this->db->prepare($sql);
                $res->bindParam(':svg_id', $input['svg_id'], PDO::PARAM_STR);
                $res->bindParam(':start', $input['start'], PDO::PARAM_INT);
                $res->bindValue(':end', $input['end'], PDO::PARAM_INT);
                $res->bindParam(':lastupdateDate', $now, PDO::PARAM_STR);
                $res->bindParam(':pathID',$input['pathID'],PDO::PARAM_INT);
                if($res->execute()){
                    $this->msg = '成功更新';
                    $this->smartyTemplate->assign('error', $this->error);
                    $this->smartyTemplate->assign('msg', $this->msg);
                    $this->listPath();
                }else{
                    $error = $res->errorInfo();
                    $this->error = $error[0];
                    $this->msg = '';
                    $this->listPath();
                }
                //$this->listPath();
            } catch (PDOException $e) {
                print "Error!: " . $e->getMessage();
                $this->smartyTemplate->assign('error', $e->getMessage());
            }
        } else {
            header('Location:../controller/userController.php?action=viewLogin');
        }
    }

    /**
     * choose_path刪除
     * @DateTime 2016-09-11
     * @param array $input[路徑ID]
     */
    public function deleteChoosePath($input){
        if ($_SESSION['isLogin'] == true) {
            try{
                $this->db->beginTransaction();
                $sql = 'DELETE FROM choose_path WHERE choose_path_id = :choosePathID';
                $res = $this->db->prepare($sql);
                $res->bindParam(':choosePathID', $input['choosePathID'], PDO::PARAM_INT);
                $res->execute();
                $this->db->commit();

                $this->msg = '刪除成功';
                $this->smartyTemplate->assign('error', $this->error);
                $this->smartyTemplate->assign('msg', $this->msg);
                $this->listChoosePath();
            } catch (PDOException $e) {
                print "Error!: " . $e->getMessage();
                $this->smartyTemplate->assign('error', $e->getMessage());
            }
        } else {
            header('Location:../controller/userController.php?action=viewLogin');
        }
    }  

    /**
     * path刪除
     * @DateTime 2016-09-11
     * @param array $input[路徑ID]
     */
    public function deletePath($input){
        if ($_SESSION['isLogin'] == true) {
            try{

                $sql = 'SELECT count(svg_id) FROM path WHERE svg_id = :svgID';
                $res = $this->db->prepare($sql);
                $res->bindParam(':svgID', $input['svgID'], PDO::PARAM_STR);
                $res->execute();
                $c = $res->fetch();
                if($c>0){
                    $this->error = '有走法用在使用這條路徑，請先把此種走法刪除';
                    $this->listPath(); 
                }else{
                    $this->db->beginTransaction();
                    $sql = 'DELETE FROM path WHERE path_id = :pathID';
                    $res = $this->db->prepare($sql);
                    $res->bindParam(':pathID', $input['pathID'], PDO::PARAM_INT);
                    $res->execute();
                    $this->db->commit();

                    $this->msg = '刪除成功';
                    $this->smartyTemplate->assign('error', $this->error);
                    $this->smartyTemplate->assign('msg', $this->msg);
                    $this->listPath();
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
                $this->listChoosePath();
            } catch (PDOException $e) {
                print "Error!: " . $e->getMessage();
                $this->smartyTemplate->assign('error', $e->getMessage());
            }
        } else {
           header('Location:../controller/userController.php?action=viewLogin');
        }
    }




}
