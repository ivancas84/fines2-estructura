<?php

require_once("class/model/values/domicilio/Main.php");

//***** implementacion de Values para una determinada tabla *****
class DomicilioValues extends DomicilioValuesMain{

  public function label(){
    return $this->calle . " N° " . $this->numero . " entre " . $this->entre . " " . $this->barrio . " " . $this->localidad;
  }

  public function labelSinLocalidad(){
    return $this->calle . " N° " . $this->numero . " entre " . $this->entre . " " . $this->barrio;
  }

  public function localidad($modo = null) {
    switch($modo) {
        case "XX YY":
            return mb_strtoupper($this->localidad);

        default: return $this->localidad;
    }
  }
  
  public function barrio($modo = null) {
    switch($modo) {
        case "XX YY":
            return mb_strtoupper($this->barrio);

        default: return $this->barrio;
    }
  }
  
  public function barrioOLocalidad($modo = null){
    return (!empty($this->barrio($modo))) ? $this->barrio($modo) : $this->localidad($modo);
  }
  
}
