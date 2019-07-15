<?php

require_once("../config/config.php");

require_once("class/Filter.php");
require_once("class/model/Dba.php");
require_once("class/model/Sql.php");

require_once("config/structure.php");

require_once("config/modelClasses.php");
require_once("config/valuesClasses.php");

$render = new Render();
$render->setCondition([
    //["horario","=~","martes"],
    //["tramo","=","21"]
    ["periodo","=","20191"]
]);
echo "<pre>";
echo EntitySqlo::getInstanceFromString("comision")->all($render);