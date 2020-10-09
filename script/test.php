<?php

require_once("../config/config.php");
require_once("class/Container.php");


$container = new Container();
$render = new Render();
$render->setAggregate(["count"]);
$render->addCondition(["cal_anio","=","2019"]);
//$render->addGeneralCondition(["label","=~","25A11"]);
$sqlo = $container->getSqlo("comision");

echo "<pre>";
echo $sqlo->advanced($render);
/*
$comision = [
  "id" => "anId",
  "division" => "Z"
];
print_r($sqlo->update($comision));
*/
