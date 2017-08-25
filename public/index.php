<?php 
session_start();
//Подключаем автозагрусчик классов
require '../app/classes/Loader.php';
$loader = new Loader();
spl_autoload_register([$loader, 'loadClass']);

$router = new Router();
$router->start();

?>