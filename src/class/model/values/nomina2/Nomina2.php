<?php

require_once("class/model/values/nomina2/_Nomina2.php");

//***** implementacion de Values para una determinada tabla *****
class Nomina2 extends _Nomina2{
  public function programaSiNo(){
    return $this->_isEmptyValue($this->programa) ? "NO" : "SI";
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
