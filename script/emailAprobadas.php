<?php

require_once("../config/config.php");
require_once("class/tools/Filter.php");
require_once("class/Container.php");
require_once("class/model/Render.php");

$container = new Container();
$render = new Render();

$render->setCondition([
  ["cur_com_cal_anio","=","2020"],
  ["cur_com_cal_semestre","=","2"],
  ["cur_com_moa_nombre","=","Fines 2"],
  ["cur_com_autorizada","=",true],
  ["estado","=","Aprobada"],
]);
$render->setAggregate(["doc_email_abc", "doc_email"]);
$rows = $container->getDb()->advanced("toma",$render);
$emails = array_column($rows, "doc_email_abc");
$emails2 = array_column($rows, "doc_email");  
echo implode(", ", array_filter(array_merge($emails, $emails2)));  