<?php

require_once($_SERVER["DOCUMENT_ROOT"]."/config/config.php");
require_once("class/controller/ModelTools.php");

require_once("class/model/Sqlo.php");


$render = new Render();
$render->addGeneralCondition(["label","=~","25A11"]);
$sqlo = EntitySqlo::getInstanceRequire("comision");
echo "<pre>";

echo $sqlo->all( $render);

