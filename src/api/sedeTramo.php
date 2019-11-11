<?php

/**
 * @todo Implementar render en el getall
 */
require_once("class/tools/Filter.php");
require_once("class/controller/Dba.php");
require_once("config/structure.php");
require_once("config/modelClasses.php");
require_once("config/entityClasses.php");
require_once("config/valuesClasses.php");


try{
  $params = Filter::requestAll();
  //el uso de parametros es dinamico
  //se puede definir un parametro opcional "display" que posee un string en formato json para facilitar el uso de tipos basicos

  $display = Dba::displayParams($params, "data");

  $render = Dba::renderDisplay($display);
  $sqlo = EntitySqlo::getInstanceString(ENTITY);

  $idsPlanes = Dba::field("clasificacion_plan", "plan", [["clasificacion", "=", $display["aux"]["clasificacion"]]]);

  $advanced = [
    "_filtros",
    "=",
    [
      "fecha_anio" => $display["aux"]["fecha_anio"],
      "fecha_semestre" => $display["aux"]["fecha_semestre"],
      "dependencia" => $display["aux"]["dependencia"],
      "plan" => $idsPlanes,
      "autorizada" => true
    ]
  ];

  $rows = Dba::all("sede",$advanced);

  echo json_encode($rows);

} catch (Exception $ex) {
  error_log($ex->getTraceAsString());
  http_response_code(500);
  echo $ex->getMessage();
}
