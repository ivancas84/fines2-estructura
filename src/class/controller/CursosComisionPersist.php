<?php

require_once("class/controller/ModelTools.php");

require_once("function/array_combine_keys.php");
require_once("function/array_combine_key.php");


class CursosComisionPersist  {
  /**
   * Definir horarios de todos los cursos de una comision
   * Los días y horarios se acomodan aleatoriamente
   */

  protected $id; //id de comision
  protected $comision; //datos de comision
  protected $mt; //ModelTools

  public function main($id) {
    $this->mt = new ModelTools;
    $this->mt->container = $this->container;
    /**
     * @param $id Id de la comision a la cual se definiran los cursos
     */
    if(empty($id)) throw new Exception("Dato no definido: id comision");

    $this->id = $id;
    $this->consultarComision();
    $this->verificarCursos();
    /**
     * si la comision tiene cursos, no seran definidos
     */

    $this->obtenerCargasHorarias();
    $this->definirCursos();
  }

  public function consultarComision(){
    $this->comision =  $this->container->getDb()->get("comision", $this->id);
  }

  public function verificarCursos(){
    $render = new Render("curso");
    $render->setCondition(["comision","=", $this->id]);
    if($this->container->getDb()->count("curso", $render)) throw new Exception("Ya existen cursos para la comision " . $this->id);
  }

  public function obtenerCargasHorarias(){
    $this->cargasHorarias = $this->mt->cargasHorariasDePlanificacion( $this->comision["planificacion"] );
    if(!count($this->cargasHorarias)) throw new Exception("No existen cargas horarias asociadas a la planificacion");
  }

  public function definirCursos(){
    $detail = [];
    foreach($this->cargasHorarias as $ch){
      $p = $this->container->getController("persist_sql");
      $curso = [
          "comision" => $this->id,
          "asignatura" => $ch["asignatura"],
          "horas_catedra" => $ch["horas_catedra_sum"],
      ];
      $persist = $p->id("curso",$curso);
      array_push($detail,"curso".$persist["id"]);
      $this->container->getDb()->multi_query_transaction($persist["sql"]);
    }

    return ["id" => $this->id, "detail" => $detail];
  }

  


  
    


}




