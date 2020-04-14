<?php

require_once("../config/config.php");
require_once("class/model/Render.php");
require_once("class/model/Sqlo.php");

$render = new Render();
$render->setAggregate(["cur_ch_sum_horas_catedra"]);
$render->setGroup(["profesor"]);

echo "<pre>";
echo EntitySqlo::getInstanceRequire("toma")->advanced($render);


?>