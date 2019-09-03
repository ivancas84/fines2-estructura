<?php

require_once("class/model/values/idPersona/_IdPersona.php");

class IdPersona extends _IdPersona{

  public function cuilInicio(){
    if(empty($this->cuil)) return null;
    return substr($this->cuil, 0, 2);
  }

  public function cuilNumero(){
    if(empty($this->cuil)) return null;
    return substr($this->cuil, 2, 8);
  }

  public function cuilDigito(){
    if(empty($this->cuil)) return null;
    return substr($this->cuil, 10, 1);
  }

  public function nombreAANn(){ return mb_convert_case($this->apellidos, MB_CASE_UPPER, "UTF-8") . ", " . mb_convert_case($this->nombres, MB_CASE_TITLE, "UTF-8"); }

  public function nombre($format = "AA, Nn"){
    switch ($format){
      case "AA, Nn": return mb_convert_case($this->apellidos, MB_CASE_UPPER, "UTF-8") . ", " . mb_convert_case($this->nombres, MB_CASE_TITLE, "UTF-8"); break;
      case "AA Nn": return mb_convert_case($this->apellidos, MB_CASE_UPPER, "UTF-8") . " " . mb_convert_case($this->nombres, MB_CASE_TITLE, "UTF-8"); break;
      case "AA": return mb_convert_case($this->apellidos, MB_CASE_UPPER, "UTF-8"); break;
      case "Nn": return mb_convert_case($this->nombres, MB_CASE_TITLE, "UTF-8"); break;
    }
  }
  
  public function nombrePrincipal($format = "Xx Yy") {
    if (!$this->isEmpty($this->sobrenombre)) return $this->sobrenombre($format);
    elseif (!$this->isEmpty($this->nombres)) return explode(" ", $this->nombres($format))[0];
    else return null;    
  }

  function descripcion(){
    if(empty($this->nombrePrincipal("Xx Yy"))) return null;
    return $this->nombrePrincipal("Xx Yy") . " (DNI TERMINA: " . substr($this->numeroDocumento(), -3) . ")";
  }
}
