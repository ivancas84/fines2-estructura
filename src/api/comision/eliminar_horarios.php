<?php

require_once("api/persist.php");
require_once("controller/ModelTools.php");
require_once("function/php_input.php");

class ComisionEliminarHorariosApi extends PersistApi {
  /**
   * Eliminar los horarios de los cursos de la comision
   */

  public function main(){
    $idComision = file_get_contents("php://input");

    $comision = $this->container->query("comision")->fieldsTree()->param("id",$idComision)->one();

    $idCursos = $this->container->query("curso")->field("id")->param("comision",$idComision)->column();
    if(empty($idCursos)) throw new Exception("La comisión no poseen cursos cargados.");


    $idHorarios = $this->container->query("horario")->field("id")->param("curso",$idCursos)->column();
    if(empty($idHorarios)) throw new Exception("Los cursos de la comisión no poseen horarios cargados.");

    $sql = $this->container->persist("horario")->delete($idHorarios);
    $detail = [];
    for($i = 0; $i < count($idHorarios); $i++){
      array_push($detail, "horario".$idHorarios[$i]);
    }

    $this->container->db()->multi_query_transaction($sql);
    return ["id" => $idComision, "detail" => $detail];

  }
}