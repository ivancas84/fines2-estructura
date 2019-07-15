<?php

require_once("class/model/values/nomina2/Main.php");

//***** implementacion de Values para una determinada tabla *****
class Nomina2Values extends Nomina2ValuesMain{
  public function programaSiNo(){
    return $this->programa ? "SI" : "NO";
  }

  public function background(){
    if(!$this->activo) return "table-danger";
    if((!$this->fotocopiaDocumento)
    || (!$this->partidaNacimiento)
    || (!$this->constanciaCuil)
    || (!$this->certificadoEstudios)) return "table-warning";
    return "table-success";
  }
}
