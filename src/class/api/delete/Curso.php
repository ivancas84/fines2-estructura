<?php

require_once("class/api/Delete.php");

class CursoDeleteApi extends DeleteApi {


  public function concatHorario($id) {
    return("horario" . $id);
  }  

  public function main(){
    $idsCursos = Filter::jsonPostRequired();
    $idsHorarios = $this->container->getDb()->ids("horario",["curso","=",$idsCursos]);
    
    $sql = "";
    $detail = [];
    if(!empty($idsHorarios)) {
      $sql .= $this->container->getSqlo("horario")->deleteAll($idsHorarios);
      $detail = array_map(array($this, 'concatHorario'), $idsHorarios);    
    }

    $sql .= $this->container->getSqlo("curso")->deleteAll($idsCursos);

    $this->container->getDb()->multi_query_transaction_log($sql);
    $detail = array_merge($detail, array_map(array($this, 'concat'), $idsCursos));    

    return ["ids" => $idsCursos, "detail" => $detail];
  }
}
