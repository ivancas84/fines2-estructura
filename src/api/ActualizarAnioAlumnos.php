<?php

require_once("api/Base.php");
require_once("function/php_input.php");
class ActualizarAnioAlumnosApi extends BaseApi {

  /**
   * Actualizar año de alumnos pertenecientes a una comision
   * Si el alumno tiene año definido no sera actualizado
   */
  public function main() {
    
    $this->container->getAuth()->authorize("alumno", "w");
    $idComision = file_get_contents("php://input");

    if(!$idComision) throw new Exception("No esta definido el id de comision");

    $render = $this->container->getEntityRender("alumno_comision");
    $render->setCondition([
      ["comision","=",$idComision],
      ["alu-anio_ingreso","=",false],
    ]);
    
    $rows = $this->container->db()->all("alumno_comision",$render);

    if(empty($rows)) return ["ids"=>[],"detail"=>[]];
    $sql = "";
    $ids = [];
    $detail = [];
    foreach($rows as $row){
      $a = [
        "id" => $row["alumno"],
        "anio_ingreso" => $row["com_pla_anio"]
      ];

      $persist = $this->container->controller("persist_sql", "alumno")->id($a);
      $sql .= $persist["sql"];
      array_push($ids, $persist["id"]);
      array_push($detail, "alumno".$persist["id"]);
    }

    $this->container->db()->multi_query_transaction($sql);
    return ["ids"=>$ids, "detail"=>$detail];
  }

}
