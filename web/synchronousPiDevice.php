<?php
require_once 'ssh.lib.php';

header("Content-Type:text/html; charset=utf-8");
// ini_set("display_errors", "On");
// server ip
if (isset($_GET['ip']) && isset($_GET['mac']) && isset($_GET['music']) && isset($_GET['action']) && isset($_GET['rssi'])) {
    $ip     = $_GET['ip'];
    $mac    = $_GET['mac'];
    $music  = $_GET['music'];
    $action = $_GET['action'];
    $rssi   = $_GET['rssi'];
}

switch ($action) {
    case "1":
        $cmd = "java -jar ssh.jar " . $ip . " " . $action . " " . $music . " " . $mac . " " . $rssi . " 2>&1";
        exec($cmd, $arr, $rv);
        if ($rv == 0) {
            echo "音樂 " . $music . " 開始播放";
        } else {
            echo var_dump($rv);
        }
        break;
    case "2":
        $cmd = "java -jar ssh.jar " . $ip . " " . $action . " " . $music . " " . $mac . " " . $rssi . " 2>&1";
        exec($cmd, $arr, $rv);
        if ($rv == 0) {
            echo "音樂播放已停止";
        } else {
            echo var_dump($rv);
        }
        break;
    case "3":
        // file name
        $url = $music;
        // $abspath  = $_SERVER['DOCUMENT_ROOT'];
        $begin    = strpos($url, '../') + 3;
        $fileName = substr($url, $begin);
        $file     = $fileName; // $abspath . '/web/' .
        $fp       = fopen($file, 'r');

        if ($fp == false) {
            echo '無法開啟檔案';
            exit;
        }

        $fileName = substr(strrchr($music, '/'), 1);
        // upload path
        $cdir = '/home/pi/music/';
        // connect FTP Server and login
        $conn_id      = ftp_connect($ip);
        $login_result = ftp_login($conn_id, 'pi', 'raspberry');

        if ($login_result) {
            // cd path
            ftp_chdir($conn_id, $cdir);

            if (ftp_fput($conn_id, $cdir . $fileName, $fp, FTP_BINARY)) {
                // 執行更新資料庫指令
                $cmd = "java -jar ssh.jar " . $ip . " " . $action . " " . $fileName . " " . $mac . " " . $rssi . " 2>&1";
                exec($cmd, $arr, $rv);
                if ($rv == 0) {
                    echo "上傳檔案 '$file' 成功";
                } else {
                    echo var_dump($rv);
                }
            } else {
                echo "上傳檔案 '$file' 失敗\n";
            }

            ftp_close($conn_id);
            fclose($fp);
        }
        break;
    case "4":
        $fileName = substr(strrchr($music, '/'), 1);
        $cmd      = "java -jar ssh.jar " . $ip . " " . $action . " " . $music . " " . $mac . " " . $rssi . " 2>&1";
        exec($cmd, $arr, $rv);
        if ($rv == 0) {
            echo "刪除檔案 " . $fileName . " 成功";
        } else {
            echo var_dump($rv);
        }
        break;
}
