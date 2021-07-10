<?php

require_once("class/api/Base.php");
require_once("function/php_input.php");
class ActualizarPlanAlumnosApi extends BaseApi {

  public function main() {
    /**
     * Actualizar plan de alumnos pertenecientes a una comision
     * Si el alumno tiene plan definido no sera actualizado
     */
    $this->container->getAuth()->authorize("alumno", "w");
    $idComision = php_input();

    $render = $this->container->getRender("alumno_comision");
    $render->setCondition([
      ["comision","=",$idComision],
      ["alu-plan","=",false],
    ]);
    $render->setFields(["alumno"]);
    
    $rows = $this->container->getDb()->select("alumno_comision",$render);

    if(empty($rows)) return ["ids"=>[],"detail"=>[]];
    $sql = "";
    $ids = [];
    $detail = [];
    foreach($rows as $row){
      $a = [
        "id" => $row["alumno"],
        "plan" => $row["com_pla_plan"]
      ];

      $persist = $this->container->getControllerEntity("persist_sql", "alumno")->id($a);
      $sql .= $persist["sql"];
      array_push($ids, $persist["id"]);
      array_push($detail, "alumno".$persist["id"]);
    }

    $this->container->getDb()->multi_query_transaction($sql);
    return ["ids"=>$ids, "detail"=>$detail];
  }

}
