<?php

require_once("../config/config.php");
require_once("class/model/RenderPlus.php");
require_once("class/model/Sqlo.php");

$renderPlus = new RenderPlus();
$renderPlus->setAggregate(["cur_ch_sum_horas_catedra"]);
$renderPlus->setGroup(["profesor"]);

echo "<pre>";
echo EntitySqlo::getInstanceRequire("toma")->advanced($renderPlus);


?>