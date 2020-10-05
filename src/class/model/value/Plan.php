<?php
require_once("class/model/value/_Plan.php");
require_once("function/acronym.php");

class PlanValue extends _PlanValue{

  protected $id = UNDEFINED;
  protected $orientacion = UNDEFINED;
  protected $resolucion = UNDEFINED;
  protected $distribucionHoraria = UNDEFINED;

  public function acronimoOrientacion($format = null) { 
    if(Validation::is_empty($this->orientacion)) return $this->orientacion;


    return Format::convertCase(acronym($this->orientacion), $format); 
  }

}
