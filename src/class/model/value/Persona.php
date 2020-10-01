<?php
require_once("class/model/value/_Persona.php");

class PersonaValue extends _PersonaValue{

  public function nombre(){
    $ret = [];
    if(!Validation::is_empty($this->nombres)) array_push($ret, $this->nombres);
    if(!Validation::is_empty($this->apellidos)) array_push($ret, $this->apellidos);
    if(empty($ret)) return UNDEFINED;
    return implode(" ", $ret);
  }

}
