<?php
// initialize
require_once HOME_DIR . 'configs/config.php';
require_once 'upload.func.php';
require_once 'IdGenerator.php';
/**
 * 風格類別
 */
class Course
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
     * User constructor
     * @DateTime 2016-09-03
     */
    public function __construct() {
        session_start();
        // instantiate the pdo object
        $this->db = dbSetup::getDbConn();
        // instantiate the template object
        $this->smarty = new SmartyConfig();
        // php version is less than 5.4.0
        if (PHP_VERSION_ID < 50400) {
            // 登記 Session 變數名稱
            session_register('isLogin');
            session_register('user');
            session_register('error');
            session_register('msg');
        }
    }
   

    /**
     * 新增風格格式
     */
    public function courseAddPrepare() {
        if ($_SESSION['isLogin'] == true) {
            $this->smarty->assign('error', $this->error);
            $this->smarty->display('course/courseAdd.html');
        } else {
            $this->error = '請先登入!';
            $this->viewLogin();
        }
    }

    /**
     * 新增風格
     */
    public function courseAdd($input) {
        if ($_SESSION['isLogin'] == true) {
            $idGen = new IdGenerator();
            $now = date('Y-m-d H:i:s');
            $courseId = $idGen->GetID('course');
            $sql = "INSERT INTO `shingnan`.`course` (`courseId`, `courseName`, `isDelete`, `lastUpdateTime`, `createTime`) 
                    VALUES (:courseId, :courseName, '0', :lastUpdateTime, :createTime);";
            $res = $this->db->prepare($sql);
            $res->bindParam(':courseId', $courseId, PDO::PARAM_STR);
            $res->bindParam(':courseName', $input['courseName'], PDO::PARAM_STR);
            $res->bindParam(':lastUpdateTime', $now, PDO::PARAM_STR);
            $res->bindParam(':createTime', $now, PDO::PARAM_STR);
            if ($res->execute()) {
                //deal with insert image
                $this->msg = '新增成功';
                $uploadPath = '../media/picture';
                if ($_FILES['courseImage']['error'] == 0) {
                    $imgId = $idGen->GetID('image');
                    $imgName = 'course_'.$input['courseName'];
                    $fileInfo = $_FILES['courseImage'];
                    $courseImage = uploadFile($fileInfo, $uploadPath);
                    $sql = "INSERT INTO `shingnan`.`image` (`imageId`, `imageName`, `type`, 
                                                            `itemId`, `ctr`, `path`, `link`, `crateTime`) 
                            VALUES (:imgId, :imgName, 2, 
                                    :courseId, 0, :filePath, '', :createTime);";
                    $res = $this->db->prepare($sql);
                    $res->bindParam(':imgId', $imgId, PDO::PARAM_STR);
                    $res->bindParam(':imgName', $imgName, PDO::PARAM_STR);
                    $res->bindParam(':courseId', $courseId, PDO::PARAM_STR);
                    $res->bindParam(':filePath', $courseImage, PDO::PARAM_STR);
                    $res->bindParam(':createTime', $now, PDO::PARAM_STR);
                    $res->execute();
                    if (!$res) { 
                        $error = $res->errorInfo();
                        $this->error = $error[0];
                        $this->courseList();
                    }
                }
            }
            $this->courseList();
        } else {
            $this->error = '請先登入!';
            $this->viewLogin();
        }
    }

    /**
     * 編輯風格前置
     */
    public function courseEditPrepare($input) {
        if ($_SESSION['isLogin'] == true) {
            $sql = "SELECT `course`.`courseName`, `course`.`courseId` , `image`.`imageId` ,`image`.`path` 
                    FROM  `course` 
                    LEFT JOIN  `image` ON course.`courseId` = image.`itemId` 
                    WHERE  `course`.`isDelete` = 0 AND  `course`.`courseId` = :courseId " ;
            $res = $this->db->prepare($sql);
            $res->bindParam(':courseId', $input['courseId'], PDO::PARAM_STR);
            $res->execute();
            $courseData = $res->fetch();
            $this->smarty->assign('courseData', $courseData);
            $this->smarty->assign('error', $this->error);
            //echo $courseData['path'];
            $this->smarty->display('course/courseEdit.html');
        } else {
            $this->error = '請先登入!';
            $this->viewLogin();
        }
    }

    /**
     * 編輯風格
     */
    public function courseEdit($input) {
        if ($_SESSION['isLogin'] == true) {
            $now = date('Y-m-d H:i:s');
            $sql = "UPDATE  `shingnan`.`course` SET  `courseName` =  :courseName,
                    `lastUpdateTime` =  :lastUpdateTime WHERE  `course`.`courseId` = :courseId;" ;
            $res = $this->db->prepare($sql);
            $res->bindParam(':courseId', $input['courseId'], PDO::PARAM_STR);
            $res->bindParam(':courseName',$input['courseName'], PDO::PARAM_STR);
            $res->bindParam(':lastUpdateTime',$now, PDO::PARAM_STR);
            $res->execute();

            if ($res->execute()) {
                //update image 
                $this->msg = '更新成功';
                if ($_FILES['courseImage']['error'] == 0) {
                    if( isset($input['imageId']) ){
                        
                        $fileInfo = $_FILES['courseImage'];
                        $courseImage = uploadFile($fileInfo, '../media/picture');
                        $sql = "UPDATE  `shingnan`.`image` SET  `path` = :pathinfo WHERE `image`.`imageId` = :imageId;";
                        $res = $this->db->prepare($sql);
                        $res->bindParam(':imageId', $input['imageId'], PDO::PARAM_STR);
                        $res->bindParam(':pathinfo', $courseImage, PDO::PARAM_STR);
                        $res->execute();
                        if (!$res) { 
                            $error = $res->errorInfo();
                            $this->error = $error[0];
                            $this->courseList();
                        }
                    }else{
                        $idGen = new IdGenerator();
                        $imgId = $idGen->GetID('image');
                        $imgName = 'course_'.$input['courseName'];
                        $fileInfo = $_FILES['courseImage'];
                        $courseImage = uploadFile($fileInfo, '../media/picture');
                        $sql = "INSERT INTO `shingnan`.`image` (`imageId`, `imageName`, `type`, 
                                                            `itemId`, `ctr`, `path`, `link`, `crateTime`) 
                                VALUES (:imgId, :imgName, 2, 
                                        :courseId, 0, :filePath, '', :createTime);";
                        $res = $this->db->prepare($sql);
                        $res->bindParam(':imgId', $imgId, PDO::PARAM_STR);
                        $res->bindParam(':imgName', $imgName, PDO::PARAM_STR);
                        $res->bindParam(':courseId', $input['courseId'], PDO::PARAM_STR);
                        $res->bindParam(':filePath', $courseImage, PDO::PARAM_STR);
                        $res->bindParam(':createTime', $now, PDO::PARAM_STR);
                        $res->execute();
                        if (!$res) { 
                            $error = $res->errorInfo();
                            $this->error = $error[0];
                            $this->courseList();
                        }
                    }
                }
            }
            $this->courseList();
        } else {
            $this->error = '請先登入!';
            $this->viewLogin();
        }
    }

    /**
     * 顯示所有風格列表
     */
    public function courseList() {
        if ($_SESSION['isLogin'] == true) {
            // get all data from course
            $sql = 'SELECT `course`.`courseName`, `course`.`courseId` , `course`.`lastUpdateTime`, `image`.`imageId` ,`image`.`path` 
                    FROM  `course` 
                    LEFT JOIN  `image` ON `course`.`courseId` = `image`.`itemId` 
                    WHERE  `course`.`isDelete` = 0
                    ORDER BY `course`.`courseId`';
            $res = $this->db->prepare($sql);
            $res->execute();
            $allStyleData = $res->fetchAll();

            $this->smarty->assign('allStyleData', $allStyleData);
            $this->smarty->assign('error', $this->error);
            $this->smarty->assign('msg', $this->msg);
            $this->smarty->display('course/courseList.html');
        } else {
            $this->error = '請先登入!';
            $this->viewLogin();
        }
    }
    

    /**
     * 刪除風格
     */
    public function courseDelete($input) {
        if ($_SESSION['isLogin'] == true) {
            if(isset($input['imageId'])){
                //deal with img
                $this->db->beginTransaction();
                $sql    = "DELETE FROM `image` WHERE `imageId` = :imgId;";
                $res = $this->db->prepare($sql);
                $res->bindParam(':imgId', $input['imageId'], PDO::PARAM_STR);
                $res->execute();
                $this->db->commit();
            }
            $this->db->beginTransaction();
            $sql = "DELETE FROM `course` WHERE `courseId` = :courseId;";
            $res = $this->db->prepare($sql);
            $res->bindParam(':courseId', $input['courseId'], PDO::PARAM_STR);
            $res->execute();
            $this->db->commit();
            $this->courseList();
        } else {
            $this->error = '請先登入!';
            $this->viewLogin();
        }
    }

    
    public function courseImageDelete($input){
        if ($_SESSION['isLogin'] == true) {
            $this->db->beginTransaction();
            $sql = "DELETE FROM `image` WHERE `image`.`imageId` = :imgId;";
            $res = $this->db->prepare($sql);
            $res->bindParam(':imgId', $input['imageId'], PDO::PARAM_STR);
            $res->execute();
            $this->db->commit();
            $this->courseList();
        } else {
            $this->error = '請先登入!';
            $this->viewLogin();
        }
    }

    /**
     * 顯示登入畫面
     * @DateTime 2016-09-03
     */
    public function viewLogin()
    {
        $_SESSION['isLogin'] = false;
        $this->smarty->assign('error', $this->error);
        $this->smarty->assign('homePath', APP_ROOT_DIR);
        $this->smarty->display('login.html');
    }

}
