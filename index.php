<?php
use App\Autoloader;
use App\Core\Https;
use App\Controllers\FrontController;

require_once './Autoloader.php';
Autoloader::register();

$router = new FrontController;

if(isset($_GET['page'])):
            
    $method = $_GET['page'];
    
    method_exists(FrontController::class, $method) ? $router->$method() : $router->home();

else:
    Https::redirect('index.php?page=home');
endif;



