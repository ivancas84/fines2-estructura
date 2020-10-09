<?php

require_once("../config/config.php");
require_once("class/tools/Filter.php");
require_once("class/Container.php");

$container = new Container();
$render = new Render();
$render->setCondition([
  ["cur_com_cal_anio","=","2020"],
  ["cur_com_cal_semestre","=","2"],
  ["cur_com_moa_nombre","=","Fines 2"],
  ["estado","=","Aprobada"]
]);

$rows = $container->getDb()->all("toma",$render);



foreach($rows as $row) {
  
  echo "<br>INSERT INTO asignacion_planilla_docente(id, toma, planilla_docente) VALUES ('".uniqid()."', '".$row["id"]."','1');";
}
  
