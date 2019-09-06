<?php

require_once("class/model/values/idPersona/_IdPersona.php");
require_once("function/dni_to_cuil.php");

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
    if (!$this->_isEmptyValue($this->sobrenombre)) return $this->sobrenombre($format);
    elseif (!$this->_isEmptyValue($this->nombres)) return explode(" ", $this->nombres($format))[0];
    else return null;    
  }

  function descripcion(){
    if(empty($this->nombrePrincipal("Xx Yy"))) return null;
    return $this->nombrePrincipal("Xx Yy") . " (DNI TERMINA: " . substr($this->numeroDocumento(), -3) . ")";
  }

  public function _check(){ //true | "error"
    if(
      $this->_isEmptyValue($this->numeroDocumento())
      || $this->_isEmptyValue($this->genero())
      || (strlen($this->numeroDocumento()) < 7)
      || (strlen($this->numeroDocumento()) < 11)
      || ((strpos($this->genero("x"), 'f') !== false) 
         && (strpos($this->genero("x"), 'm') !== false))
    ) {
      $this->_addError("Datos incorrectos");
      return false;
    }

    return true;
  }

  public function _calcularCuil(){
    if(!$this->_check()) return false;
    $g = (strpos($this->genero("x"), 'f') !== false) ? "2" : "1";
    return dni_to_cuil($this->numeroDocumento(), $g);
  }
}
