<?php

require_once("class/model/value/_Comision.php");

class ComisionValue extends _ComisionValue{

  public function acronimoTurno($format = null) { 
    if(Validation::is_empty($this->turno)) return $this->turno;
  
    $turno = Format::convertCase(acronym($this->turno), $format); 
    if($turno == "N") return "V";
  }

  public function resetTramoSiguiente(){
    /**
     * Definir anio, semestre de la comision siguiente
     */

    $p = [
      "anio" => intval($this->anio()),
      "semestre" => intval($this->semestre()),
    ];

    switch($p["semestre"]){
      case 2:
        if($p["anio"] == 3) {
          $this->_logs->addLog("tramo_siguiente", "error", "Es un 3/2, no puede definirse la comision siguiente");
          return false;
        }
        $p["semestre"] = 1;
        $p["anio"]++;
      break;
        
      case 1:
        $p["semestre"] = 2;
      break;

      default:
        $p["anio"]++;
    }

    $a = $this->setAnio($p["anio"]);
    $s = $this->setSemestre($p["semestre"]);

    return (!$a || !$s) ? false : true; 
  }

}

