<?php

require_once("../config/config.php");
require_once("class/model/RenderAux.php");
require_once("class/model/Sqlo.php");

$renderAux = new RenderAux();
$renderAux->setAggregate(["cur_ch_sum_horas_catedra"]);
$renderAux->setGroup(["profesor"]);

echo "<pre>";
echo EntitySqlo::getInstanceRequire("toma")->advanced($renderAux);


?>