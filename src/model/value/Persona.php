<?php
require_once("model/entityOptions/Value.php");
require_once("function/nombres_parecidos.php");

class PersonaValue extends ValueEntityOptions{

  public function checkNombresParecidos($existente){
    $this->logs->resetLogs("nombres_parecidos");

    if(!nombres_parecidos($this->_get("nombre"), $existente->_get("nombre"))){
      $this->logs->addLog("nombres_parecidos","error", "Los nombres no son parecidos");
      return false;
    }
    
    return true;
  }

  public function getNombre(){
    $array = [];
    if(!Validation::is_undefined($this->_get("nombres"))) array_push($array, $this->_get("nombres"));
    if(!Validation::is_undefined($this->_get("apellidos"))) array_push($array, $this->_get("apellidos"));
    return empty($array) ? UNDEFINED : implode(" ", $array);
  }

  public function setNumeroDocumento($p){
    $this->value["numero_documento"] = ltrim((string)$p, "0"); 
    return $this->value["numero_documento"];
  }

}
