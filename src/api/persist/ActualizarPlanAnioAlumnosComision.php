<?php

require_once("api/Base.php");
require_once("function/php_input.php");
class ActualizarPlanAnioAlumnosComisionApi extends BaseApi {

  /**
   * Actualizar plan de alumnos pertenecientes a una comision
   * Si el alumno tiene plan definido no sera actualizado
   */
  public function main() {
    
    $this->container->getAuth()->authorize("alumno", "w");
    $idComision = file_get_contents("php://input");

    if(!$idComision) throw new Exception("No esta definido el id de comision");

    $rows = $this->container->query("alumno_comision")
      ->cond([
        ["comision","=",$idComision],
        [
          ["alumno-plan","=",false],
          ["alumno-anio_ingreso","=",false,OR_],
        ]
      ])
      ->fields()
      ->all();

    if(empty($rows)) return ["ids"=>[],"detail"=>[]];
    $sql = "";
    $ids = [];
    $detail = [];
    foreach($rows as $row){
      $a = [
        "id" => $row["alumno"],
      ];
      if(!$row["alumno-plan"]) $a["plan"] = $row["plan-id"];
      if(!$row["alumno-anio_ingreso"]) $a["anio_ingreso"] = $row["planificacion-anio"];  

      $persist = $this->container->controller("persist_sql", "alumno")->id($a);
      $sql .= $persist["sql"];
      array_push($ids, $persist["id"]);
      array_push($detail, "alumno".$persist["id"]);
    }

    $this->container->db()->multi_query_transaction($sql);
    return ["ids"=>$ids, "detail"=>$detail];
  }

}
