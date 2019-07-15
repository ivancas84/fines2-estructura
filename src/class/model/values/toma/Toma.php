<?php

require_once("class/model/values/toma/Main.php");

//***** implementacion de Values para una determinada tabla *****
class TomaValues extends TomaValuesMain{

  public function tipoMovimiento($format = null){
    return ($this->estado() == "Aprobada") ? "AI" : "CP";
  }

  public function background(){
    if($this->estadoContralor() == "Modificar") return "table-secondary";
    switch($this->estado()){
      case "Error": case "Renuncia": case "Observada": return "table-danger";
      case "Aprobada": return "table-success";
      case "Pendiente": return "table-warning";
      default: return "";
    }
  }

  public function observacionesNP(){
    if($this->estadoContralor() == "No pasar") return $this->observaciones() . " - No Pasar - ";
  }

  public function estados(){
    return $this->estado() . "/" . $this->estadoContralor();
  }

  public function estadosAbr(){
    return substr($this->estado(), 0, 1) . "/" . substr($this->estadoContralor(), 0, 1);
  }

  public function fechaDesde_($format){ //metodo auxiliar para imprimir fecha desde
    /**
     * Realiza una verificacion de la fecha de entrada contralor, en caso de que este completa, imprime la fecha desde vacia
     */
    if(empty($this->fecha_entrada_contralor)) return null;
    else return $this->fechaDesde($format);
  }

  public function fechaFin_($format) {//metodo auxiliar para imprimir fecha desde
    /**
     * Realiza una verificacion de la fecha de entrada contralor, en caso de que este completa, imprime la fecha desde vacia
     */
    if (empty($this->fechaDesde_()) || ($this->fechaToma() == $this->fechaFin()) || !empty($this->fecha_entrada_contralor)) return null;
    return $this->fechaDesde($format);
  }
}
