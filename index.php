<?php 

//Подключаем автозагрусчик классов
require '../app/classes/loader.php';
$loader = new Loader();
spl_autoload_register([$loader, 'loadClass']);

$router = new Router();
$router->start();



?>