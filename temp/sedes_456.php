<?php

require_once("../config/config.php");
require_once("class/controller/Model.php");
require_once("class/Container.php");

$container = new Container();

echo "<pre>";
print_r($container->getRel("comision")->fieldNames());
die();
$render = $container->getRender();
$render->addFields($container->getRel($entityName)->fieldNames());
$comisionSqlo = $container->getSqlo("comision");
$comisionSqlo->select($render);