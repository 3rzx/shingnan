<?php

/**
 * 產生id類別
 */
class IdGenerator
{
    
    private string GetUniqID() {
            $date = new DateTime();
            return $date->getTimestamp();;
    }

    public string GetID(string Header) {
            string id = Header . "_" . this.GetUniqID();
            return id;
    }
    
}
