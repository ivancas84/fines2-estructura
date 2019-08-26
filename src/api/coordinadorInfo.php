<?php

/**
 * @todo Implementar render en el getall
 */
require_once("class/Filter.php");
require_once("class/model/Dba.php");
require_once("class/model/Sqlo.php");

require_once("config/structure.php");
require_once("config/modelClasses.php");
require_once("config/entityClasses.php");
require_once("config/valuesClasses.php");


try{
  $params = Filter::postAll();
  //el uso de parametros es dinamico
  //se puede definir un parametro opcional "display" que posee un string en formato json para facilitar el uso de tipos basicos

  $display = Dba::displayParams($params, "data");
  $idsPlanes = Dba::field("clasificacion_plan", "plan", [["clasificacion", "=", $display["aux"]["clasificacion"]]]);
  $sqlo = EntitySqlo::getInstanceString(ENTITY);
  $sql = $sqlo->idInfoCoordinadoresFiltros($display["aux"]["fecha_anio"],$display["aux"]["fecha_semestre"],$display["aux"]["dependencia"],$idsPlanes);
  $datos = Dba::fetchAll($sql);

  function id($p){ return $p["id"]; }
  $ids = array_map("id", $datos);

  $rows = Dba::getAll(ENTITY, $ids);

  for($i = 0; $i < count($datos); $i++){
    for($j = 0; $j < count($rows); $j++){
      if($datos[$i]["id"] == $rows[$j]["id"]) {
        $rows[$j]["cantidad_sedes"] = $datos[$i]["cantidad_sedes"];
        $rows[$j]["cantidad_comisiones"] = $datos[$i]["cantidad_comisiones"];
        $rows[$j]["cantidad_comisiones_no_autorizadas"] = $datos[$i]["cantidad_comisiones_no_autorizadas"];
        $rows[$j]["cantidad_alumnos"] = $datos[$i]["cantidad_alumnos"];
        $rows[$j]["cantidad_sedes_no_autorizadas"] = $datos[$i]["cantidad_sedes_no_autorizadas"];
      }
    }
  }
  echo json_encode($rows);

} catch (Exception $ex) {
  error_log($ex->getTraceAsString());
  http_response_code(500);
  echo $ex->getMessage();
}
