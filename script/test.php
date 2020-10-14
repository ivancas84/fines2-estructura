<?php

require_once("../config/config.php");
require_once("class/Container.php");
require_once("class/model/Render.php");
require_once("function/get_entity_relations.php");

$container = new Container();
$render = new Render();
$render->setCondition([
  ["cur_com_cal_anio","=","2020"],
  ["cur_com_cal_semestre","=","2"],
  ["cur_com_moa_nombre","=","Fines 2"],
  ["estado","=","Aprobada"]
]);

$sql = $container->getSqlo("toma")->all($render);

echo "<pre>".$sql;