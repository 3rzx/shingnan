<?php

/**
 * 讀寫點數匯率
 */
class pointFile {
    
    public function GetRate() {
        $file = '../rate.txt';
        if (file_exists($file)) {
            return file_get_contents($file);
        }else{
            file_put_contents ($file,'100');
            return '100';
        }
    }

    public function SetRate($rate) {
        $file = '../rate.txt';
        file_put_contents ($file,$rate); 
    }
    
}


?>