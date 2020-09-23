<?php

require_once("class/api/Persist.php");
require_once("class/controller/ModelTools.php");

class ComisionCursosPersistApi extends PersistApi {
  /**
   * Registro de cursos de una comision
   */

  public function main(){
    $idComision = Filter::jsonPostRequired("id");

    $comision = $this->container->getDb()->get("comision", $idComision);

    $cargasHorarias = $this->container->getMt()->cargasHorariasDePlanificacion( $comision["planificacion"] );
    if(!count($cargasHorarias)) throw new Exception("No existen cargas horarias asociadas a la planificacion");

    $sql = "";
    $detail = [];
    foreach($cargasHorarias as $ch){
      $curso = $this->container->getValue("curso");
      $curso->setComision($idComision);
      $curso->setAsignatura($ch["asignatura"]);
      $curso->setHorasCatedra($ch["sum_horas_catedra"]);
      $curso->_call("reset")->_call("_check");
      if($curso->_getLogs()->isError()) throw new Exception($curso->_getLogs()->toString());
      $curso->_call("setDefault");
      $curso->setId(uniqid());
      $sql .= $this->container->getSqlo("curso")->insert($curso->_toArray("sql"));
      array_push($detail, "curso".$curso->id());
    }

    return ["id" => $idComision, "detail" => $detail];

  }
}