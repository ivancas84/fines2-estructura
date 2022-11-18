<?php
require_once("model/entityOptions/Mapping.php");

class DisposicionMapping extends MappingEntityOptions{

  public function label() {
    return "CONCAT_WS(' ',
      {$this->_pf()}asignatura.nombre, 
      {$this->_pf()}planificacion.anio,
      {$this->_pf()}planificacion.semestre,
      {$this->_pf()}plan.orientacion,
      {$this->_pf()}plan.resolucion,
      {$this->_pf()}plan.distribucion_horaria
    )";
  }

  public function tramo() {
    return "CONCAT(COALESCE({$this->_pf()}pla.anio,''), COALESCE({$this->_pf()}pla.semestre,''))";
  }


}
