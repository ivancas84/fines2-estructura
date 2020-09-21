<?php

require_once("../config/config.php");
require_once("class/Container.php");


$container = new Container();
$render = new Render();
$render->setCondition(["sed_ce_nombre", "=~", "456"]);
//$render->addGeneralCondition(["label","=~","25A11"]);
$sqlo = $container->getSqlo("comision");

echo "<pre>";
echo $sqlo->all($render);
/*
$comision = [
  "id" => "anId",
  "division" => "Z"
];
print_r($sqlo->update($comision));
*/
