<?php

require_once("class/model/values/comision/_Comision.php");

class Comision extends _Comision {
  public function tramo($separator = "") { return $this->anio . $separator . $this->semestre; }

  public function aperturaText() { return ($this->apertura)? "APERTURA" : ""; }

  public function background() {
    if(!$this->autorizada) return "table-danger";
    return ($this->_isEmptyValue($this->comentario)) ? "table-success" : "table-warning";
  }

  public function anioSiguiente(){
    if(intval($this->semestre()) == 1) return $this->anio();
    if(intval($this->anio()) == 3) throw new Exception("No existe año siguiente");
    return (intval($this->anio())+1);  
  }

  public function semestreSiguiente(){
    if(intval($this->semestre()) == 1) return 2;
    if(intval($this->anio()) == 3) throw new Exception("No existe semestre siguiente");
    return 1;    
  }

  public function fechaAnioSiguiente(){
    if(intval($this->fechaSemestre()) == 1) return $this->fechaAnio();
    return (intval($this->fechaAnio())+1);  
  }

  public function fechaSemestreSiguiente(){
    return (intval($this->fechaSemestre()) == 1) ?  2 : 1;
  }
}
