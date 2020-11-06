<?php

/**
 * @todo Implementar render en el getall
 */
require_once("../src/config/config.php");
require_once("class/controller/Dba.php");
require_once("class/model/Data.php");
require_once("class/model/Render.php");

require_once("config/structure.php");
require_once("config/modelClasses.php");
require_once("config/entityClasses.php");
require_once("config/valuesClasses.php");

$render = new Render();
$render->setCondition([
  ["cur_com_fecha_anio", "=", "2018"],
  ["cur_com_fecha_semestre", "=", "1"]
]);
$render->setAggregate(["suma_horas_catedra"]);
$render->setGroup(["pro_numero_documento"]);
$render->setOrder(["suma_horas_catedra" => "asc"]);
$render->setHaving([["suma_horas_catedra", ">", 6], ["suma_horas_catedra", "<", 20]]);

echo "<pre>";
$sql = TomaSqlo::getInstance()->advanced($render);
echo $sql;

$rows = Dba::fetchAll($sql);
print_r($rows);
//$render = new Render();
//$render->setGroup(["pro_numero_documento"]);
//$render->setSum(["suma_horas_catedra" => "cur_ch_horas_catedra"]);

//echo TomaSqlo::getInstance()->advanced($render);
