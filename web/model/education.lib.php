<?php
// initialize
require_once HOME_DIR . 'configs/config.php';
/**
 * 風格類別
 */
class Education {
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
	public function educationAddPrepare() {
		if ($_SESSION['isLogin'] == true) {
			$this->smarty->assign('error', $this->error);
			$this->smarty->display('education/educationAdd.html');
		} else {
			$this->error = '請先登入!';
			$this->viewLogin();
		}
	}

	/**
	 * 新增風格
	 */
	public function educationAdd($input) {
		//
		if ($_SESSION['isLogin'] == false) {
			$this->error = '請先登入!';
			$this->viewLogin();
		}
		$idGen = new IdGenerator();
		$now = date('Y-m-d H:i:s');
		$educationId = $idGen->GetID('education');
		$sql = "INSERT INTO `shingnan`.`article` (`articleId`, `title`, `content`, `type`, `ctr`, `isDelete`, `lastUpdateTime`, `createTime`)
                        VALUES (:articleId, :title, :content, '1', '0', '0' ,:lastUpdateTime, :createTime);";
		$res = $this->db->prepare($sql);
		$res->bindParam(':articleId', $educationId, PDO::PARAM_STR);
		$res->bindParam(':title', $input['educationTitle'], PDO::PARAM_STR);
		$res->bindParam(':content', $input['educationEditor'], PDO::PARAM_STR);
		$res->bindParam(':lastUpdateTime', $now, PDO::PARAM_STR);
		$res->bindParam(':createTime', $now, PDO::PARAM_STR);
		$res->execute();
		$this->msg = '新增成功';
		if (!$res) {
			$error = $res->errorInfo();
			$this->error = $error[0];
			$this->educationList();
		}
		$this->educationList();
	}

	/**
	 * 編輯風格前置
	 */
	public function educationEditPrepare($input) {
		if ($_SESSION['isLogin'] == true) {
			$sql = 'SELECT * FROM education WHERE educationId = :educationId';
			$res = $this->db->prepare($sql);
			$res->bindParam(':educationId', $input['educationId'], PDO::PARAM_STR);
			$res->execute();
			$educationData = $res->fetchAll();

			$this->smarty->assign('educationData', $educationData);
			$this->smarty->assign('educationImg', $educationImg);
			$this->smarty->assign('error', $this->error);
			$this->display('education/educationEdit.html');
		} else {
			$this->error = '請先登入!';
			$this->viewLogin();
		}
	}

	/**
	 * 編輯風格
	 */
	public function educationEdit($input) {
		if ($_SESSION['isLogin'] == true) {
			$sql = 'SELECT * FROM education WHERE educationId = :educationId';
			$res = $this->db->prepare($sql);
			$res->bindParam(':educationId', $input['educationId'], PDO::PARAM_STR);
			$res->execute();
			$educationData = $res->fetchAll();

			//get image
			$sql = 'SELECT `path`
                    FROM image
                    WHERE type = 2 and itemId = :educationId';
			$res = $this->db->prepare($sql);
			$res->bindParam(':educationId', $input['educationId'], PDO::PARAM_STR);
			$res->execute();
			$educationImg = $res->fetchAll();

			$this->smarty->assign('educationData', $educationData);
			$this->smarty->assign('educationImg', $educationImg);
			$this->smarty->assign('error', $this->error);
			$this->display('education/educationEdit.html');
		} else {
			$this->error = '請先登入!';
			$this->viewLogin();
		}
	}

	/**
	 * 顯示所有風格列表
	 */
	public function educationList() {
		if ($_SESSION['isLogin'] == true) {
			// get all data from education
			$sql = 'SELECT `article`.`title`, `article`.`articleId` , `article`.`type`,`article`.`ctr` , `article`.`lastUpdateTime`
                FROM  `article`
                WHERE type = 1
                ORDER BY `article`.`articleId`';
			$res = $this->db->prepare($sql);
			$res->execute();
			$alleducationData = $res->fetchAll();

			$this->smarty->assign('alleducationData', $alleducationData);
			$this->smarty->assign('error', $this->error);
			$this->smarty->display('education/educationList.html');
		} else {
			$this->error = '請先登入!';
			$this->viewLogin();
		}
	}

	/**
	 * 刪除風格
	 */
	public function educationDelete($input) {
		if ($_SESSION['isLogin'] == true) {
			try {
				$this->db->beginTransaction();
				$sql = "DELETE FROM education
                           WHERE educationId = :educationId";
				$res->bindParam(':educationId', $input['educationId'], PDO::PARAM_STR);
				$this->db->exec($sql);
				$this->db->commit();
				//deal with img
				$this->error = '';
				$this->msg = '刪除成功';
				$this->smarty->display('education/educationList.html');
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
	 * 顯示登入畫面
	 * @DateTime 2016-09-03
	 */
	public function viewLogin() {
		$_SESSION['isLogin'] = false;
		$this->smarty->assign('error', $this->error);
		$this->smarty->assign('homePath', APP_ROOT_DIR);
		$this->smarty->display('login.html');
	}

}
