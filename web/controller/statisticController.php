<?php
//initialize
require_once '../configs/source.php';
require_once HOME_DIR . 'model/statistic.lib.php';

$statistic = new Statistic();

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'POST':
        $action = isset($_POST['action']) ? $_POST['action'] : '';
        switch ($action) {
            case 'login':
                break;
        }
        break;
    case 'GET':
        $action = isset($_GET['action']) ? $_GET['action'] : 'view';
        switch ($action) {
            case 'articleClick':
                $statistic->viewArticleClick();
                break;
            case 'goodsClick':
                $statistic->viewGoodsClick();
                break;
            case 'orderHistory':
                $statistic->viewOrderHistory();
                break;
            case 'getQueryResult':
                $statistic->queryOrderHistoryByDate($_GET);
                break;
            case 'articleQueryByDate':
                $statistic->articleQueryByDate($_GET);
                break;
            case 'goodsQueryByDate':
                $statistic->goodsQueryByDate($_GET);
                break;
            default:
                $statistic->viewLogin();
        }
        break;
}
