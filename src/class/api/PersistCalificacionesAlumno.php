<?php

require_once("class/model/Rel.php");
require_once("function/php_input.php");
require_once("function/array_combine_key2.php");

class PersistCalificacionesAlumnoApi {
  /**
   * Persistencia de una entidad y sus relaciones
   * Recibe como parametro un array multiple
   */

  public $entityName; //entidad principal
  public $container;
  public $permission = "w";

  public function main(){
    $sql = "";
    $detail = [];

    $this->container->getAuth()->authorize("calificacion", $this->permission);

    $params = php_input();
    if(!$params["alumno"]["plan"]) throw new Exception("No se encuentra definido el plan del alumno");


    $render = $this->container->getRender("disposicion");
    $render->setCondition(["plan-id","=",$params["alumno"]["plan"]]);
    $disposicion_ = array_combine_key2(
      $this->container->getDb()->all("disposicion", $render),
      ["asignatura","planificacion_anio","planificacion_semestre"]
    );

    $controlDisposiciones = [];

    foreach($params["calificacion/alumno"] as $k => $row){
      $identifierDisposicion = $row["disposicion-asignatura"].UNDEFINED. $row["planificacion-anio"].UNDEFINED.$row["planificacion-semestre"];

      if(in_array($identifierDisposicion, $controlDisposiciones)) throw new Exception("Disposicion repetida");
      if(!array_key_exists($identifierDisposicion, $disposicion_)) throw new Exception("Disposicion inexistente");
      array_push( $controlDisposiciones, $identifierDisposicion);

      $row["alumno"] = $params["alumno"]["id"];
      $row["disposicion"] = $disposicion_[$identifierDisposicion]["id"];

      $persistSql = $this->container->getControllerEntity("persist_sql", "calificacion");
      $p = $persistSql->id($row);

      array_push($detail, "calificacion".$p["id"]);
      $sql .= $p["sql"];
    }

    $this->container->getDb()->multi_query_transaction($sql);
    return ["id" => $params["alumno"]["id"], "detail" => $detail];
  }
}
