<?php
//initialize
require_once '../configs/source.php';
require_once HOME_DIR . 'model/company.lib.php';

$company = new Company();

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'POST':
        $action = isset($_POST['action']) ? $_POST['action'] : '';
        switch ($action) {
            case 'addCompany':
                $company->addCompany($_POST);
                break;
            case 'updateCompany':
                $company->updateCompany($_POST);
                break;
        }
        break;
    case 'GET':
        $action = isset($_GET['action']) ? $_GET['action'] : 'view';
        switch ($action) {
            case 'viewAddForm':
                $company->viewAddForm();
                break;
            case 'viewEditForm':
                $company->viewEditForm($_GET);
                break;
            case 'viewCompanyList':
                $company->viewCompanyList();
                break;
            case 'deleteCompany':
                $company->deleteCompany($_GET);
                break;
            case 'logout':
                $company->logout();
                break;
            case 'view':
            default:
                $company->viewLogin();
        }
        break;
}
