<?php

require_once($_SERVER["DOCUMENT_ROOT"]."/config/config.php");
require_once("class/controller/ModelTools.php");

require_once("class/model/Sqlo.php");


$sqlo = EntitySqlo::getInstanceRequire("planificacion");
echo "<pre>";

echo $sqlo->all();

print_r($field);
