<?php
namespace App\Core;

class Https {
    
    /**
     *  Redirection
     */
    public static function redirect(string $path):void {

        header('Location: '.$path);
        exit;
        
    }
    
}