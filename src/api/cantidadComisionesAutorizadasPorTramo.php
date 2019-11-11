<?php

/**
 * @todo Implementar render en el getall
 */
require_once("class/tools/Filter.php");
require_once("class/controller/Dba.php");
require_once("class/model/Sqlo.php");

require_once("config/structure.php");
require_once("config/modelClasses.php");


try{
  $params = Filter::postAllRequired();
  $display = Dba::displayParams($params, "data");
  $idsPlanes = Dba::field("clasificacion_plan", "plan", [["clasificacion", "=", $display["aux"]["clasificacion"]]]);
  $sqlo = EntitySqlo::getInstanceString(ENTITY);
  $sql = $sqlo->cantidadAnioSemestreAutorizadasFiltros($display["aux"]["fecha_anio"],$display["aux"]["fecha_semestre"],$display["aux"]["dependencia"],$idsPlanes);
  $rows = Dba::fetchAll($sql);
  echo json_encode($rows);

} catch (Exception $ex) {
  error_log($ex->getTraceAsString());
  http_response_code(500);
  echo $ex->getMessage();
}
