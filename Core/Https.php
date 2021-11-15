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

    /**
     * FONCTION DD (SYMFONY)
     */
    public static function dd($var) {
        echo '<pre>';
        var_dump($var);
        echo '</pre>';
        die();
    }
    
}