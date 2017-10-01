<?php
// initialize
require_once HOME_DIR . 'configs/config.php';

/**
 * 專案圖資類別
 */
class Project
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
     * Project constructor
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
     * 顯示增加專案畫面
     * @DateTime 2016-09-07
     * @return   void     [description]
     */
    public function viewAddForm()
    {
        if ($_SESSION['isLogin'] == true) {
            $this->smarty->assign('homePath', APP_ROOT_DIR);
            $this->smarty->assign('error', $this->error);
            $this->smarty->display('project/projectAdd.html');
        } else {
            header('Location:../controller/userController.php?action=viewLogin');
        }
    }
    /**
     * 驗證輸入
     * @DateTime 2016-09-07
     * @param    array     $input [專案資料]
     * @return   boolean          [是否為有效輸入]
     */
    public function isValidAddForm($input)
    {
        // 清除空格
        $input['projectName']         = trim($input['projectName']);
        $input['projectVersion']      = trim($input['projectVersion']);
        $input['projectIntroduction'] = trim($input['projectIntroduction']);

        // 測試是否為空值
        if (strlen($input['projectName']) == 0) {
            $this->error = '專案名稱不得為空值';
            return false;
        } else if (strlen($input['projectIntroduction']) == 0) {
            $this->error = '專案介紹不得為空值';
            return false;
        } else if (strlen($input['projectVersion']) == 0) {
            $this->error = '專案版本不得為空值';
            return false;
        }
        return true;
    }
    /**
     * 新增專案
     * @DateTime 2016-09-08
     * @param    array     $input [專案資料]
     */
    public function addProject($input)
    {
        if ($_SESSION['isLogin'] == true) {
            try {
                $now = date('Y-m-d H:i:s');
                $sql = "INSERT INTO project (version, name, introduction, active, create_date, lastupdate_date)
                            VALUES (:version, :name, :introduction, 1, :createDate, :lastupdateDate)";
                $res = $this->db->prepare($sql);
                $res->bindParam(':version', $input['projectVersion'], PDO::PARAM_STR);
                $res->bindParam(':name', $input['projectName'], PDO::PARAM_STR);
                $res->bindParam(':introduction', $input['projectIntroduction'], PDO::PARAM_STR);
                $res->bindParam(':createDate', $now, PDO::PARAM_STR);
                $res->bindParam(':lastupdateDate', $now, PDO::PARAM_STR);

                if ($res->execute()) {
                    $this->error = '';
                    $this->msg   = '新增成功';
                    $projectId   = $this->db->lastInsertId();
                    //偵測資料夾是否存在
                    $dir = HOME_DIR . 'media/project/project' . $projectId;
                    if (!file_exists($dir) && !is_dir($dir)) {
                        // create project folder with 777 permissions
                        mkdir($dir);
                        chmod($dir, 0777);
                    }

                    $this->viewProjectList();
                } else {
                    $error = $res->errorInfo();

                    $this->error = $error[0];
                    $this->viewAddForm();
                }

            } catch (PDOException $e) {
                print "Error!: " . $e->getMessage();
            }
        } else {
            header('Location:../controller/userController.php?action=viewLogin');
        }
    }
    /**
     * 顯示編輯專案畫面
     * @DateTime 2016-09-08
     * @param    array     $input [專案ID]
     */
    public function viewEditForm($input)
    {
        if ($_SESSION['isLogin'] == true) {
            $sql = 'SELECT *
                    FROM project
                    WHERE project_id = :projectId';
            $res = $this->db->prepare($sql);
            $res->bindParam(':projectId', $input['projectId'], PDO::PARAM_INT);
            $res->execute();
            $projectData = $res->fetchAll();

            $this->smarty->assign('project', $projectData[0]);
            $this->smarty->assign('homePath', APP_ROOT_DIR);
            $this->smarty->assign('error', $this->error);
            $this->smarty->display('project/projectEdit.html');
        } else {
            header('Location:../controller/userController.php?action=viewLogin');
        }
    }
    /**
     * 顯示專案列表
     * @DateTime 2016-09-08
     */
    public function viewProjectList()
    {
        if ($_SESSION['isLogin'] == true) {
            try {
                $sql = 'SELECT *
            			FROM project
            			ORDER BY project_id';
                $res = $this->db->prepare($sql);
                $res->execute();
                $projectData = $res->fetchAll();

                $this->smarty->assign('data', $projectData);
                $this->smarty->assign('msg', $this->msg);
                $this->smarty->assign('error', $this->error);
                $this->smarty->assign('homePath', APP_ROOT_DIR);
                $this->smarty->display('project/projectList.html');
            } catch (PDOException $e) {
                print "Error!: " . $e->getMessage();
            }
        } else {
            header('Location:../controller/userController.php?action=viewLogin');
        }
    }
    /**
     * 刪除專案
     * @DateTime 2016-09-08
     * @param    array     $input [專案ID]
     */
    public function deleteProject($input)
    {
        if ($_SESSION['isLogin'] == true) {
            try {
                $projectId = $input['projectId'];
                $sql       = "SELECT *
                              FROM field_map
                              WHERE project_id = $projectId";
                $res = $this->db->prepare($sql);
                $res->execute();
                $res = $res->fetchAll();

                if (count($res) != 0) {
                    $this->error = '專案中還有其他資料，請先刪除資料';
                    $this->msg   = '';
                } else {
                    $this->db->beginTransaction();
                    $projectId = $input['projectId'];
                    $sql       = "DELETE FROM project
                                  WHERE project_id = $projectId";
                    $this->db->exec($sql);
                    $this->db->commit();

                    $this->error = '';
                    $this->msg   = '刪除成功';
                    rmdir(HOME_DIR . 'media/project/project' . $projectId);
                }
                $this->viewProjectList();
            } catch (PDOException $e) {
                $this->db->rollBack();
                print "Error!: " . $e->getMessage();
            }
        } else {
            header('Location:../controller/userController.php?action=viewLogin');
        }
    }
    /**
     * 更新專案資料
     * @DateTime 2016-09-08
     * @param    array     $input [專案資料]
     */
    public function updateProject($input)
    {
        if ($_SESSION['isLogin'] == true) {
            try {
                // update data from project
                if (isset($input['projectActive'])) {
                    $isActive = 1;
                } else {
                    $isActive = 0;
                }
                $now = date('Y-m-d H:i:s');
                $sql = 'UPDATE project
                    SET name = :name, introduction = :introduction, version = :version, active = :active, lastupdate_date = :lastupdateDate
                    WHERE project_id = :projectId';
                $res = $this->db->prepare($sql);
                $res->bindParam(':name', $input['projectName'], PDO::PARAM_STR);
                $res->bindParam(':introduction', $input['projectIntroduction'], PDO::PARAM_STR);
                $res->bindParam(':version', $input['projectVersion'], PDO::PARAM_STR);
                $res->bindParam(':active', $isActive, PDO::PARAM_STR);
                $res->bindParam(':lastupdateDate', $now, PDO::PARAM_STR);
                $res->bindParam(':projectId', $input['projectId'], PDO::PARAM_INT);
                $res->execute();

                $this->error = '';
                $this->msg   = '更新成功';
                $this->viewProjectList();
            } catch (PDOException $e) {
                print_r("Error!: " . $e->getMessage());
            }
        } else {
            header('Location:../controller/userController.php?action=viewLogin');
        }
    }
    /**
     * 顯示專案詳細資料
     * @DateTime 2016-09-08
     * @param    array     $input [場域與專案ID]
     */
    public function viewProjectDetail($input)
    {
        if ($_SESSION['isLogin'] == true) {
            try {
                $sql = 'SELECT *
                        FROM project
                        WHERE project_id = :projectId';
                $res = $this->db->prepare($sql);
                $res->bindParam(':projectId', $input['projectId'], PDO::PARAM_INT);
                $res->execute();
                $projectData = $res->fetchAll();

                $sql = 'SELECT *
                        FROM field_map
                        WHERE project_id = :projectId';
                $res = $this->db->prepare($sql);
                $res->bindParam(':projectId', $input['projectId'], PDO::PARAM_INT);
                $res->execute();
                $fieldData = $res->fetchAll();

                $this->smarty->assign('project', $projectData[0]);
                if (isset($input['error'])) {
                    $this->error = $input['error'];
                }
                if (isset($input['msg'])) {
                    $this->msg = $input['msg'];
                }
                $this->smarty->assign('field', $fieldData);
                $this->smarty->assign('msg', $this->msg);
                $this->smarty->assign('error', $this->error);
                $this->smarty->assign('homePath', APP_ROOT_DIR);
                $this->smarty->display('project/projectDetail.html');
            } catch (PDOException $e) {
                print "Error!: " . $e->getMessage();
            }
        } else {
            header('Location:../controller/userController.php?action=viewLogin');
        }
    }
}
