<?php

/**
 * delete image file
 */

class deleteImgFile
{
    public function deleteFile($path) {
        if(file_exists($path)) {
            unlink($path);
        }
    }
}