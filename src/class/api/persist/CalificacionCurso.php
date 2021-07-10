<?php

require_once("class/api/Persist.php");
require_once("class/controller/ModelTools.php");
require_once("function/php_input.php");

class CalificacionCursoPersistApi extends PersistApi {
  /**
   * Obtiene la comision del curso y verifica los alumnos activos.
   * Si existe algún alumno activo que no se encuentre 
   * agregado como clasificacion lo inserta 
   */

  public function main(){
    $idCurso = file_get_contents("php://input");
    $curso = $this->container->getDb()->get("curso", $idCurso);

    $render = $this->container->getRender("alumno_comision");
    $render->setCondition([
      ["comision","=",$curso["comision"]],
      //["activo","=","true"]
    ]);
    $render->setSize(0);
    $alumnos = $this->container->getDb()->all("alumno_comision",$render);

    $render = $this->container->getRender("calificacion");
    $render->setCondition([
      ["curso","=",$idCurso],
    ]);
    $render->setSize(0);
    $calificaciones = $this->container->getDb()->all("calificacion",$render);

    $idPersonas = array_diff(
      array_column($alumnos,"persona"),
      array_column($calificaciones,"persona")
    );

    $sql = "";
    $ids = [];
    $detail = [];
    foreach($idPersonas as $idPersona){
      $calificacion = $this->container->getValue("calificacion");
      $calificacion->_set("id", uniqid());
      $calificacion->_set("curso", $idCurso);
      $calificacion->_set("persona", $idPersona);
      $calificacion->_call("reset")->_call("check");
      if($calificacion->_getLogs()->isError()) throw new Exception($calificacion->_getLogs()->toString());
      $calificacion->_call("setDefault");
      $sql .= $this->container->getSqlo("calificacion")->insert($calificacion->_toArray("sql"));
      array_push($ids, $calificacion->_get("id"));
      array_push($detail, "calificacion".$calificacion->_get("id"));
    }

    if(!empty($sql)) $this->container->getDb()->multi_query_transaction($sql);
    return ["ids"=>$ids,"detail"=>$detail];
  }
}