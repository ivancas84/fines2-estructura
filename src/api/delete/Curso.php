<?php

require_once("api/Delete.php");
require_once("function/php_input.php");

class CursoDeleteApi extends DeleteApi {

  public function concatHorario($id) {
    return("horario" . $id);
  }  

  public function main(){
    $idsCursos = php_input();
    $idsHorarios = $this->container->db()->ids("horario",["curso","=",$idsCursos]);
    
    $sql = "";
    $detail = [];
    if(!empty($idsHorarios)) {
      $sql .= $this->container->getEntitySqlo("horario")->deleteAll($idsHorarios);
      $detail = array_map(array($this, 'concatHorario'), $idsHorarios);    
    }

    $sql .= $this->container->getEntitySqlo("curso")->deleteAll($idsCursos);

    $this->container->db()->multi_query_transaction_log($sql);
    $detail = array_merge($detail, array_map(array($this, 'concat'), $idsCursos));    

    return ["ids" => $idsCursos, "detail" => $detail];
  }
}
