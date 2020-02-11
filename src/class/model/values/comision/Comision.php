<?php

require_once("class/model/values/comision/_Comision.php");

class Comision extends _Comision{
  public function setTramoSiguiente(){
    /**
     * Definir anio, semestre, fecha_anio, fecha_semestre de la comision siguiente
     */

    $p = [
      "fecha_anio" => intval($this->fechaAnio("Y")),
      "fecha_semestre" => intval($data["fecha_semestre"]),
      "anio" => intval($data["anio"]),
      "semestre" => intval($data["semestre"]),
    ];

    if(empty($p["fecha_anio"])) return false;
    if(empty($p["anio"])) return false;
    
      
    switch($param["fecha_semestre"]){
      case 1:  
        $p["fecha_semestre"] = 2; 
      break;
      case 2: 
        $p["fecha_anio"]++;
        $p["fecha_semestre"] = 1; 
      break;
      
      default: 
        $p["fecha_anio"]++;
    }

    switch($p["semestre"]){
      case 1: case 2:  
        $p["semestre"]++; 
      break;
      case 3:
        if($p["anio"])  
        $p["anio"]++;
        $p["fecha_semestre"] = 2; 
      break;
      
      default: 
        $p["fecha_semestre"] = false;
        $p["fecha_anio"]--;
    }

    return $param;
  }

}

