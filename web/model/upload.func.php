<?php
/**
 * string uploadFile(array $files, array $allowExt, number $maxSize, boolean $flag, string $uploadPath) 單一 PHP 檔案上傳
 *
 * @param files 透過 $_FILES 取得的 HTTP 檔案上傳的項目陣列
 * @param allowExt 允許上傳檔案的擴展名，預設 'jpeg', 'jpg', 'gif', 'png'
 * @param maxsize 上傳檔案容量大小限制，預設 2097152（200M * 1024 * 1024 = 209715200byte）
 * @param flag 檢查是否為真實的圖片類型（只允許上傳圖片的話），true（預設）檢查；false 不檢查
 * @param uploadPath 存放檔案的目錄，預設 uploads
 *
 * @return 回傳存放目錄 + md5 產生的檔案名稱 + 擴展名
 */
function uploadFile($fileInfo, $uploadPath = 'uploads', $uniName = '', $allowExt = array('jpeg', 'jpg', 'gif', 'png', 'svg', 'mp3', 'm4a', 'mp4', 'rmvb'), $maxSize = 209715200, $flag = true)
{
    // 存放錯誤訊息
    $mes = '';

    // 取得上傳檔案的擴展名
    $ext = pathinfo($fileInfo['name'], PATHINFO_EXTENSION);

    //使用原檔名
    $uniName     = $fileInfo['name'];
    $destination = $uploadPath . '/' . $uniName;
    // 確保檔案名稱唯一，防止重覆名稱產生覆蓋
    $uniName     = md5(uniqid(microtime(true), true)) . '.' . $ext;
    $destination = $uploadPath . '/' . $uniName;
    /* if ($uniName == '') {
         $uniName     = md5(uniqid(microtime(true), true)) . '.' . $ext;
         $destination = $uploadPath . '/' . $uniName;
     } else {
         $destination = $uploadPath . '/' . $uniName;
     }*/

    // 判斷是否有錯誤
    if ($fileInfo['error'] > 0) {
        // 匹配的錯誤代碼
        switch ($fileInfo['error']) {
            case 1:
                $mes = '上傳的檔案超過了 php.ini 中 upload_max_filesize 允許上傳檔案容量的最大值';
                break;
            case 2:
                $mes = '上傳檔案的大小超過了 HTML 表單中 MAX_FILE_SIZE 選項指定的值';
                break;
            case 3:
                $mes = '檔案只有部分被上傳';
                break;
            case 4:
                $mes = '沒有檔案被上傳（沒有選擇上傳檔案就送出表單）';
                break;
            case 6:
                $mes = '找不到臨時目錄';
                break;
            case 7:
                $mes = '檔案寫入失敗';
                break;
            case 8:
                $mes = '上傳的文件被 PHP 擴展程式中斷';
                break;
        }

        exit($mes);
    }

    // 檢查檔案是否是通過 HTTP POST 上傳的
    if (!is_uploaded_file($fileInfo['tmp_name'])) {
        exit('檔案不是通過 HTTP POST 方式上傳的');
    }

    // 檢查上傳檔案是否為允許的擴展名
    if (!is_array($allowExt)) // 判斷參數是否為陣列
    {
        exit('檔案類型型態必須為 array');
    } else {
        if (!in_array($ext, $allowExt)) // 檢查陣列中是否有允許的擴展名
        {
            exit('非法檔案類型');
        }

    }

    // 檢查上傳檔案的容量大小是否符合規範
    if ($fileInfo['size'] > $maxSize) {
        exit('上傳檔案容量超過限制');
    }

    // 檢查是否為真實的圖片類型
    //if ($flag && !@getimagesize($fileInfo['tmp_name'])) {
    //    exit('不是真正的圖片類型');
    //}

    // 檢查指定目錄是否存在，不存在就建立目錄
    if (!file_exists($uploadPath)) {
        mkdir($uploadPath, 0777, true);
    }
    // 建立目錄

    // 將檔案從臨時目錄移至指定目錄
    if (!@move_uploaded_file($fileInfo['tmp_name'], $destination)) // 如果移動檔案失敗
    {
        exit('檔案移動失敗');
    }

    return $destination;
}
