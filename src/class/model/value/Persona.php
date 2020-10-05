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

  public function preCuil(){
    if(Validation::is_empty($this->cuil)) return $this->cuil;
    return substr($this->cuil, 0, 2);  
  }

  public function suCuil(){
    if(Validation::is_empty($this->cuil)) return $this->cuil;
    return substr($this->cuil, 10, 1);  
  }
}
