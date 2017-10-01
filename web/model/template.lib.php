<?php
// initialize
require_once HOME_DIR . 'configs/config.php';

/**
 * 使用者類別
 */
class Template
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
     * @DateTime 2016-09-03
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
     * @DateTime 2016-09-12
     */
    public function viewLogin()
    {
        $_SESSION['isLogin'] = false;
        $this->smarty->assign('error', $this->error);
        $this->smarty->assign('homePath', APP_ROOT_DIR);
        $this->smarty->display('login.html');
    }

    /**
     * 顯示文青樣板清單
     * @DateTime 2016-09-12
     */
    public function viewTemplateList()
    {
        if ($_SESSION['isLogin'] == true) {
            try {
                $sql = 'SELECT *
                        FROM hipster_template
                        ORDER BY hipster_template_id';
                $res = $this->db->prepare($sql);
                $res->execute();
                $templateData = $res->fetchAll();

                $this->smarty->assign('templateData', $templateData);
                $this->smarty->assign('msg', $this->msg);
                $this->smarty->assign('error', $this->error);
                $this->smarty->assign('homePath', APP_ROOT_DIR);
                $this->smarty->display('template/templateList.html');
            } catch (PDOException $e) {
                print "Error!: " . $e->getMessage();
            }
        } else {
            $this->error = '請先登入!';
            $this->viewLogin();
        }
    }

    /**
     * 顯示主畫面
     * @DateTime 2016-09-13
     */
    public function viewMain()
    {
        if ($_SESSION['isLogin'] == true) {
            $this->smarty->assign('error', $this->error);
            $this->smarty->assign('homePath', APP_ROOT_DIR);
            $this->smarty->display('main.html');
        } else {
            $this->error = '請先登入!';
            $this->viewLogin();
        }
    }

    /**
     * 顯示增加文青樣板畫面
     * @DateTime 2016-09-12
     * @param    array     $input [未知]
     */
    public function viewAddForm()
    {
        if ($_SESSION['isLogin'] == true) {
            $this->smarty->assign('error', $this->error);
            $this->smarty->assign('homePath', APP_ROOT_DIR);
            $this->smarty->display('template/templateAdd.html');
        } else {
            $this->error = '請先登入!';
            $this->viewLogin();
        }
    }

    /**
     * 顯示編輯文青樣板畫面
     * @DateTime 2016-09-12
     */
    public function viewEditForm($input)
    {
        if ($_SESSION['isLogin'] == true) {
            $sql = 'SELECT *
                    FROM hipster_template
                    WHERE hipster_template_id = :id';
            $res = $this->db->prepare($sql);
            $res->bindParam(':id', $input['id'], PDO::PARAM_INT);
            $res->execute();
            $templateData = $res->fetchAll();

            $this->smarty->assign('templateData', $templateData[0]);
            $this->smarty->assign('error', $this->error);
            $this->smarty->assign('homePath', APP_ROOT_DIR);
            $this->smarty->display('template/templateEdit.html');
        } else {
            $this->error = '請先登入!';
            $this->viewLogin();
        }
    }

    /**
     * 顯示增加罐頭文字畫面
     * @DateTime 2016-09-14
     * @param    array     $input [未知]
     */
    public function viewAddText()
    {
        if ($_SESSION['isLogin'] == true) {
            $this->smarty->assign('error', $this->error);
            $this->smarty->assign('homePath', APP_ROOT_DIR);
            $this->smarty->display('template/templateAddText.html');
        } else {
            $this->error = '請先登入!';
            $this->viewLogin();
        }
    }

    /**
     * 顯示罐頭文字清單
     * @DateTime 2016-09-14
     */
    public function viewTextList()
    {
        if ($_SESSION['isLogin'] == true) {
            try {
                $sql = 'SELECT *
                        FROM hipster_text
                        ORDER BY hipster_text_id';
                $res = $this->db->prepare($sql);
                $res->execute();
                $templateData = $res->fetchAll();

                $this->smarty->assign('templateData', $templateData);
                $this->smarty->assign('msg', $this->msg);
                $this->smarty->assign('error', $this->error);
                $this->smarty->assign('homePath', APP_ROOT_DIR);
                $this->smarty->display('template/templateTextList.html');
            } catch (PDOException $e) {
                print "Error!: " . $e->getMessage();
            }
        } else {
            $this->error = '請先登入!';
            $this->viewLogin();
        }
    }

    /**
     * 顯示編輯罐頭文字清單
     * @DateTime 2016-09-14
     */
    public function viewEditText($input)
    {
        if ($_SESSION['isLogin'] == true) {
            try {
                $sql = 'SELECT *
                        FROM hipster_text
                        WHERE hipster_text_id = :id';
                $res = $this->db->prepare($sql);
                $res->bindParam(':id', $input['id'], PDO::PARAM_INT);
                $res->execute();
                $templateData = $res->fetchAll();

                $this->smarty->assign('templateData', $templateData[0]);
                $this->smarty->assign('msg', $this->msg);
                $this->smarty->assign('error', $this->error);
                $this->smarty->assign('homePath', APP_ROOT_DIR);
                $this->smarty->display('template/templateEditText.html');
            } catch (PDOException $e) {
                print "Error!: " . $e->getMessage();
            }
        } else {
            $this->error = '請先登入!';
            $this->viewLogin();
        }
    }

    /**
     * 新增文青樣板
     * @DateTime 2016-09-12
     * @param    array     $input [樣板資料]
     */
    public function addTemplate($input)
    {
        if ($_SESSION['isLogin'] == true) {
            if ((isset($_FILES["template"])) && ($_FILES["template"]["size"] > 0)) {
                if ($_FILES["template"]["error"] > 0) {
                    $this->error = '檔案上傳錯誤!';
                } else {
                    $file_tmp = explode(".", $_FILES['template']['name']);

                    $uploadPath = '../media/template';
                    if (!file_exists($uploadPath) && !is_dir($uploadPath)) {
                        // create project folder with 777 permissions
                        mkdir($uploadPath);
                        chmod($uploadPath, 0777);
                    }

                    $newFilePath = $uploadPath . '/' . uniqid($file_tmp[0], true);

                    move_uploaded_file($_FILES['template']['tmp_name'], $newFilePath); //複製檔案
                    try {
                        $sql = "INSERT INTO hipster_template (name, template, create_date, lastupdate_date)
                                VALUES (:name, :template, :create_date, :lastupdate_date)";
                        $res = $this->db->prepare($sql);
                        $now = date('Y-m-d H:i:s');
                        $res->bindParam(':name', $input['name'], PDO::PARAM_STR);
                        $res->bindParam(':template', $newFilePath, PDO::PARAM_STR);
                        $res->bindParam(':create_date', $now, PDO::PARAM_STR);
                        $res->bindParam(':lastupdate_date', $now, PDO::PARAM_STR);
                        if ($res->execute()) {
                            $this->error = '';
                            header('Location:../controller/templateController.php?action=viewTemplateList');
                        } else {
                            $error = $res->errorInfo();

                            $this->error = $error[0];
                            $this->viewTemplateList();
                        }
                    } catch (PDOException $e) {
                        print "Error!: " . $e->getMessage();
                    }
                }
            } else {
                $this->error = "請選擇檔案!";
            }
        } else {
            $this->error = '請先登入!';
            $this->viewLogin();
        }
    }

    /**
     * 編輯文青樣板
     * @DateTime 2016-09-13
     * @param    array     $input [樣板資料]
     */
    public function editTemplate($input)
    {
        if ($_SESSION['isLogin'] == true) {
            try {
                //update name from hipster_template
                $sql = 'UPDATE hipster_template
                        SET name = :name
                        WHERE hipster_template_id = :id';
                $res = $this->db->prepare($sql);
                $res->bindParam(':id', $input['id'], PDO::PARAM_INT);
                $res->bindParam(':name', $input['name'], PDO::PARAM_STR);
                $res->execute();

                if ((isset($_FILES["template"])) && ($_FILES["template"]["size"] > 0)) {
                    //delete old template
                    $sql = 'SELECT template
                        FROM hipster_template
                        WHERE hipster_template_id = :id';
                    $res = $this->db->prepare($sql);
                    $res->bindParam(':id', $input['id'], PDO::PARAM_INT);
                    $res->execute();
                    $file = $res->fetchAll();
                    unlink($file[0]['template']);

                    if ($_FILES["template"]["error"] > 0) {
                        $this->error = '檔案上傳錯誤!';
                    } else {
                        $file_tmp = explode(".", $_FILES['template']['name']);

                        $newFilePath = '../media/template/' . uniqid($file_tmp[0], true);
                        move_uploaded_file($_FILES['template']['tmp_name'], $newFilePath); //複製檔案

                        $sql = 'UPDATE hipster_template
                                SET template = :template
                                WHERE hipster_template_id = :id';
                        $res = $this->db->prepare($sql);
                        $res->bindParam(':id', $input['id'], PDO::PARAM_INT);
                        $res->bindParam(':template', $newFilePath, PDO::PARAM_STR);
                        $res->execute();
                    }
                }
                // 更新最後修改時間
                $sql = 'UPDATE hipster_template
                        SET lastupdate_date = :lastupdate_date
                        WHERE hipster_template_id = :id';
                $res = $this->db->prepare($sql);
                $now = date('Y-m-d H:i:s');
                $res->bindParam(':id', $input['id'], PDO::PARAM_INT);
                $res->bindParam(':lastupdate_date', $now, PDO::PARAM_STR);

                $this->error = '';
                $this->msg   = '更新成功';
                $this->viewTemplateList();
            } catch (PDOException $e) {
                print_r("Error!: " . $e->getMessage());
            }
        } else {
            $this->error = '請先登入!';
            $this->viewLogin();
        }
    }

    /**
     * 刪除樣板
     * @DateTime 2016-09-13
     * @param    array     $input [樣板id]
     */
    public function deleteTemplate($input)
    {
        if ($_SESSION['isLogin'] == true) {
            try {
                $sql = 'SELECT template
                    FROM hipster_template
                    WHERE hipster_template_id = :id';
                $res = $this->db->prepare($sql);
                $res->bindParam(':id', $input['id'], PDO::PARAM_INT);
                $res->execute();
                $file = $res->fetchAll();

                $this->db->beginTransaction();
                $id  = $input['id'];
                $sql = "DELETE FROM hipster_template
                           WHERE hipster_template_id = $id";
                $this->db->exec($sql);
                $this->db->commit();

                unlink($file[0]['template']);

                $this->error = '';
                $this->msg   = '刪除成功';
                $this->viewTemplateList();
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
     * 新增罐頭文字
     * @DateTime 2016-09-14
     * @param    array     $input [罐頭文字資料]
     */
    public function addText($input)
    {
        if ($_SESSION['isLogin'] == true) {
            try {
                $now = date('Y-m-d H:i:s');

                $sql = "INSERT INTO hipster_text (content, content_en, create_date, lastupdate_date)
                        VALUES (:content, :contentEn, :createDate, :lastupdateDate)";
                $res = $this->db->prepare($sql);
                $res->bindParam(':content', $input['content'], PDO::PARAM_STR);
                $res->bindParam(':contentEn', $input['contentEn'], PDO::PARAM_STR);
                $res->bindParam(':createDate', $now, PDO::PARAM_STR);
                $res->bindParam(':lastupdateDate', $now, PDO::PARAM_STR);

                if ($res->execute()) {
                    $this->error = '';
                    header('Location:../controller/templateController.php?action=viewTextList');
                } else {
                    $error = $res->errorInfo();

                    $this->error = $error[0];
                    $this->viewAddForm();
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
     * 編輯罐頭文字
     * @DateTime 2016-09-14
     * @param    array     $input [罐頭文字資料]
     */
    public function EditText($input)
    {
        if ($_SESSION['isLogin'] == true) {
            $sql = 'UPDATE hipster_text
                SET content = :content, content_en = :contentEn
                WHERE hipster_text_id = :id';
            $res = $this->db->prepare($sql);
            $res->bindParam(':id', $input['id'], PDO::PARAM_INT);
            $res->bindParam(':content', $input['content'], PDO::PARAM_STR);
            $res->bindParam(':contentEn', $input['contentEn'], PDO::PARAM_STR);
            $res->execute();
            $this->error = '';
            $this->msg   = '編輯成功';
            $this->viewTextList();
        } else {
            $this->error = '請先登入!';
            $this->viewLogin();
        }
    }

    /**
     * 刪除罐頭文字
     * @DateTime 2016-09-14
     * @param    array     $input [罐頭文字id]
     */
    public function deleteText($input)
    {
        if ($_SESSION['isLogin'] == true) {
            try {
                $this->db->beginTransaction();
                $id  = $input['id'];
                $sql = "DELETE FROM hipster_text
                           WHERE hipster_text_id = $id";
                $this->db->exec($sql);
                $this->db->commit();

                $this->error = '';
                $this->msg   = '刪除成功';
                $this->viewTextList();
            } catch (PDOException $e) {
                $this->db->rollBack();
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
