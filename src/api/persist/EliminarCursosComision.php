<?php

require_once("api/Persist.php");
require_once("controller/ModelTools.php");
require_once("function/php_input.php");

class EliminarCursosComisionPersistApi extends PersistApi {
  /**
   * Crear cursos de comision
   */

  public function main(){
    $idComision = file_get_contents("php://input");

    $comision = $this->container->query("comision")->fieldsTree()->param("id",$idComision)->one();

    $idCursos = $this->container->query("curso")->field("id")->param("comision",$idComision)->column();

    $cantidadHorarios = $this->container->query("horario")->field("count")->param("curso",$idCursos)->columnOne();
    if(intval($cantidadHorarios)) throw new Exception("No se pueden eliminar los cursos, tienen horarios asociados.");

    $cantidadTomas = $this->container->query("toma")->field("count")->param("curso",$idCursos)->columnOne();
    if(intval($cantidadTomas)) throw new Exception("No se pueden eliminar los cursos, tienen tomas asociadas.");
    
    $sql = $this->container->persist("curso")->delete($idCursos);
    $detail = [];
    for($i = 0; $i < count($idCursos); $i++){
      array_push($detail, "curso".$idCursos[$i]);
    }

    $this->container->db()->multi_query_transaction($sql);
    return ["id" => $idComision, "detail" => $detail];

  }
}