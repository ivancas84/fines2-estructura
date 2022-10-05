<?php

require_once("../config/config.php");
require_once("class/Container.php");
require_once("class/model/Render.php");

$render = new Render();
$container = new Container();

echo "<pre>";
print_r($container->getDb()->all("comision", $render));
