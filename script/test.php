<?php

require_once("../config/config.php");
require_once("class/controller/ModelTools.php");

require_once("class/model/Sqlo.php");


echo "<pre>";
echo EntitySqlo::getInstanceRequire("curso")->all(["asi_nombre","=",'Matemática']);

