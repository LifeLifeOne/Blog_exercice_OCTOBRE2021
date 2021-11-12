<?php
namespace App\Core;

class Form
{
    
    /**
     * VALIDATION SIMPLE FORMULAIRE
     */
    public static function validate($POST = [], $keys = []) {

        foreach($keys as $key) {

            if(!isset($POST[$key]) || empty($POST[$key])) { 
                return false;
            } 
            
        }
        return true;

    }

    /**
     * SECURISATION DES DONNEES
     */
    public static function secure($data) {
        
        $data = trim($data);
        $data = htmlspecialchars($data);
        $data = strip_tags($data);

        return $data;
    }
}
