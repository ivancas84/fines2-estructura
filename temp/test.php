<?php

require_once("../config/config.php");
require_once("class/Container.php");
require_once("class/model/Entity.php");

$container = new Container();
$a = $container->getEntity("alumno");
echo $a->getName();
$b = $container->getEntity("persona");
echo $b->getName();

//print_r($a);
//$a = $container->getStructure();

