<?php

require_once("../config/config.php");
require_once("class/tools/Filter.php");
require_once("class/Container.php");
require_once("class/model/Render.php");

$container = new Container();
$render = new Render();
$render->setCondition([
  ["com_cal_anio","=","2020"],
  ["com_cal_semestre","=","2"],
  ["com_moa_nombre","=","Fines 2"],
  ["com_autorizada","=",true],
]);
$render->setAggregate(["count"]);
$rows = $container->getDb()->advanced("curso",$render);
$aCubrir = $rows[0]["count"];
echo "Cargos a cubrir: " . $aCubrir."<br>";


$render = new Render();
$render->setCondition([
  ["cur_com_cal_anio","=","2020"],
  ["cur_com_cal_semestre","=","2"],
  ["cur_com_moa_nombre","=","Fines 2"],
  ["cur_com_autorizada","=",true],
  ["estado","=","Aprobada"],
]);
$render->setAggregate(["count"]);
$rows = $container->getDb()->advanced("toma",$render);
$tomasAprobadas = $rows[0]["count"];
echo "Cargos cubiertos: " . $tomasAprobadas . "<br>";

$render = new Render();
$render->setCondition([
  ["cur_com_cal_anio","=","2020"],
  ["cur_com_cal_semestre","=","2"],
  ["cur_com_moa_nombre","=","Fines 2"],
  ["cur_com_autorizada","=",true],
  ["estado","=","Renuncia"],
]);
$render->setAggregate(["count"]);
$rows = $container->getDb()->advanced("toma",$render);
$renuncias = $rows[0]["count"];
echo "Renuncias: " . $renuncias . "<br>";


$render = new Render();
$render->setCondition([
  ["cur_com_cal_anio","=","2020"],
  ["cur_com_cal_semestre","=","2"],
  ["cur_com_moa_nombre","=","Fines 2"],
  ["cur_com_autorizada","=",true],
  ["estado","=","Pendiente"],
]);
$render->setAggregate(["count"]);
$rows = $container->getDb()->advanced("toma",$render);
echo "Falta revisar documentación: " . $rows[0]["count"];
