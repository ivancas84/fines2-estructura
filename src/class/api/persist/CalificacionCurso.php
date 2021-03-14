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
    $idCurso = php_input();
    $curso = $this->container->getDb()->get("curso", $idCurso);

    $render = $this->container->getRender("alumno");
    $render->setCondition([
      ["comision","=",$curso["comision"]],
      ["activo","=","true"]
    ]);
    $render->setSize(0);
    $alumnos = $this->container->getDb()->all("alumno",$render);

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
    foreach($idPersonas as $id){
      $row = [
        "id"=>uniqid(),
        "curso"=>$row["curso"],
        "persona"=>$id,
      ];
      array_push($ids, $row["id"]);
      array_push($detail, "calificacion".$row["id"]);
      $sql .= $this->container->getSqlo("calificacion")->insert($row);
    }

    $this->container->getDb()->multi_query_transaction($sql);
    return ["ids"=>$ids,"detail"=>$detail];
  }
}