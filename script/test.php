<?php

require_once($_SERVER["DOCUMENT_ROOT"]."/config/config.php");
require_once("class/controller/ModelTools.php");

require_once("class/model/Sqlo.php");


$field = Field::getInstanceRequire("curso","alta");
echo "<pre>";

print_r($field);
