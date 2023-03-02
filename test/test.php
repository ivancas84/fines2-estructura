<?
require_once("../config/config.php");

require_once("Container.php");

$container = new Container();

echo "<pre>";
    $container->controller("toma_posesion","email")
        ->main("63fe13cd3051a");