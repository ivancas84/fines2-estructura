<?php

require_once("../config/config.php");
require_once("class/Container.php");


$container = new Container();
echo "<pre>";
print_r($container->getEntity("curso")->getFieldsNf());

//$render = new Render();
//$render->setAggregate(["count"]);
//$render->addCondition(["cal_anio","=","2019"]);
//$render->setOrder(["sed_numero"=>"ASC"]);
//$render->addGeneralCondition(["label","=~","25A11"]);
//$sqlo = $container->getSqlo("comision");
//echo "<pre>";
//echo $sqlo->all($render);
/*
$comision = [
  "id" => "anId",
  "division" => "Z"
];
print_r($sqlo->update($comision));
*/
