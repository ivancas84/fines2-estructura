<?php

require_once("class/api/Persist.php");
require_once("class/controller/ModelTools.php");
require_once("function/php_input.php");

class CrearCursosComisionPersistApi extends PersistApi {
  /**
   * Crear cursos de comision
   */

  public function main(){
    $idComision = file_get_contents("php://input");
    $comision = $this->container->getDb()->get("comision", $idComision);

    $cargasHorarias = $this->container->getMt()->cargasHorariasDePlanificacion( $comision["planificacion"] );
    if(!count($cargasHorarias)) throw new Exception("No existen cargas horarias asociadas a la planificacion");

    $sql = "";
    $detail = [];
    foreach($cargasHorarias as $ch){
      $curso = $this->container->getValue("curso");
      $curso->_set("comision", $idComision);
      $curso->_set("asignatura", $ch["asignatura"]);
      $curso->_set("horas_catedra", $ch["horas_catedra_sum"]);
      $curso->_call("reset")->_call("check");
      if($curso->_getLogs()->isError()) throw new Exception($curso->_getLogs()->toString());
      $curso->_call("setDefault");
      $curso->_set("id", uniqid());
      $sql .= $this->container->getSqlo("curso")->insert($curso->_toArray("sql"));
      array_push($detail, "curso".$curso->_get("id"));
    }

    $this->container->getDb()->multi_query_transaction($sql);

    return ["id" => $idComision, "detail" => $detail];

  }
}