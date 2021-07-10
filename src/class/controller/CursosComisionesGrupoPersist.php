<?php


require_once("class/controller/ModelTools.php");
require_once("function/array_combine_key.php");


class CursosComisionesGrupoPersist {
  /**
   * Definir horarios de todos los cursos de un grupo basandose en la comision anterior
   * 
   * si una comision es siguiente de mas de una comision, no se define el horario
   * si una comision ya tiene el horario definido, no se define el horario
   * si el horario de al menos un curso está definido, se ignora toda la comision
   */
  public $comisiones;
  public $mt;

  public function main($grupo){
    $this->mt = new ModelTools();
    $this->mt->container = $this->container;

    if(empty($grupo["cal-anio"])) throw new Exception("Dato no definido: fecha anio");
    if(empty($grupo["cal-semestre"])) throw new Exception("Dato no definido: fecha semestre");
    if(empty($grupo["modalidad"])) throw new Exception("Dato no definido: modalidad");
    //if(empty($grupo["sed-centro_educativo"])) throw new Exception("Dato no definido: centro educativo (sed_centro_educativo)");
       
    $this->consultarComisiones($grupo);
    /**
     * Consultar comisiones del grupo, que tengan el campo siguiente definido
     */

    $this->quitarComisionesConCursos();

    /**
     * quitar comisiones con cursos
     */
    $this->definirCursos();
    /**
     * definir cursos para las comisiones del grupo
     */
  }
  
  protected function consultarComisiones($grupo){
    $render = $this->container->getRender("comision");
    $render->setParams($grupo);
    $render->setSize(0);  
    $this->comisiones = array_combine_key($this->container->getDb()->all("comision",$render),"id");
  }

  protected  function quitarComisionesConCursos(){
    $ids = array_column($this->comisiones, "id");
    $render = $this->container->getRender("curso");
    $render->addCondition(["comision","=",$ids]);
    $render->setSize(0);
    $cursos = $this->container->getDb()->all("curso",$render);
    $idsConCursos = array_values(array_unique(array_column($cursos, "comision")));
    
    foreach($idsConCursos as $id) unset($this->comisiones[$id]);
  }

  protected function definirCursos(){
    $controller = $this->container->getController("cursos_comision_persist");
    $ids = [];
    $detail = [];
    foreach($this->comisiones as $id => $comision){
      $persist = $controller->main($id);
      array_push($ids, $persist["id"]);
      $detail = array_merge($detail,$persist["detail"]);
    }

    return ["ids"=>$ids, "detail"=>$detail];
    //array_push($this->logs, ["sql"=>$controller->getSql(), "detail"=>$controller->getDetail()]);
  }


}




