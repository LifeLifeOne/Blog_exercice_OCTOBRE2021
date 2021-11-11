<?php
namespace App\Core;

class Render {

    /**
     * FONCTION RENDER 
     */
    public function render(string $path, $array = []) {

        extract($array);
        $path = $path.".phtml";
        require './Template/template.php';
    }
    
}