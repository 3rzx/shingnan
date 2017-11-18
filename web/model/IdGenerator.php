<?php

/**
 * 產生id類別
 */
class IdGenerator
{
    
    private function GetUniqID() {
        $date = new DateTime();
        return $date->getTimestamp();
    }

    public function GetID($Header) {
        $id = $Header . "_" . $this.GetUniqID();
        return $id;
    }
    
}


?>