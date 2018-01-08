<?php

/**
 * 刪除圖片檔案
 */
class deleteImgFile
{

    public function deleteFile($path) {
    	if(file_exists($path))
        	unlink($path);
    }
    
}


?>