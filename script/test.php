<?php

require_once("../config/config.php");
require_once("class/Container.php");


$container = new Container();
$render = new Render();
$render->setOrder(["numero_pad" => "ASC"]);
//$render->addGeneralCondition(["label","=~","25A11"]);
$sqlo = $container->getSqlo("sede");

echo "<pre>";
echo $sqlo->all($render);
/*
$comision = [
  "id" => "anId",
  "division" => "Z"
];
print_r($sqlo->update($comision));
*/
