<?php
require_once("class/model/entityOptions/Mapping.php");

class _DesignacionMapping extends MappingEntityOptions{

  public function id() { return $this->_pt() . ".id"; }
  public function desde() { return $this->_pt() . ".desde"; }
  public function hasta() { return $this->_pt() . ".hasta"; }
  public function alta() { return $this->_pt() . ".alta"; }
  public function altaDate() { return "CAST({$this->_pt()}.alta AS DATE)"; }
  public function altaYm() { return "DATE_FORMAT({$this->_pt()}.alta, '%Y-%m')"; }
  public function altaY() { return "DATE_FORMAT({$this->_pt()}.alta, '%Y')"; }
  public function cargo() { return $this->_pt() . ".cargo"; }
  public function sede() { return $this->_pt() . ".sede"; }
  public function persona() { return $this->_pt() . ".persona"; }

  public function minId() { return "MIN({$this->_pt()}.id)"; }
  public function maxId() { return "MAX({$this->_pt()}.id)"; }
  public function countId() { return "COUNT({$this->_pt()}.id)"; }

  public function avgDesde() { return "AVG({$this->_pt()}.desde)"; }
  public function minDesde() { return "MIN({$this->_pt()}.desde)"; }
  public function maxDesde() { return "MAX({$this->_pt()}.desde)"; }
  public function countDesde() { return "COUNT({$this->_pt()}.desde)"; }

  public function avgHasta() { return "AVG({$this->_pt()}.hasta)"; }
  public function minHasta() { return "MIN({$this->_pt()}.hasta)"; }
  public function maxHasta() { return "MAX({$this->_pt()}.hasta)"; }
  public function countHasta() { return "COUNT({$this->_pt()}.hasta)"; }

  public function avgAlta() { return "AVG({$this->_pt()}.alta)"; }
  public function minAlta() { return "MIN({$this->_pt()}.alta)"; }
  public function maxAlta() { return "MAX({$this->_pt()}.alta)"; }
  public function countAlta() { return "COUNT({$this->_pt()}.alta)"; }

  public function minCargo() { return "MIN({$this->_pt()}.cargo)"; }
  public function maxCargo() { return "MAX({$this->_pt()}.cargo)"; }
  public function countCargo() { return "COUNT({$this->_pt()}.cargo)"; }

  public function minSede() { return "MIN({$this->_pt()}.sede)"; }
  public function maxSede() { return "MAX({$this->_pt()}.sede)"; }
  public function countSede() { return "COUNT({$this->_pt()}.sede)"; }

  public function minPersona() { return "MIN({$this->_pt()}.persona)"; }
  public function maxPersona() { return "MAX({$this->_pt()}.persona)"; }
  public function countPersona() { return "COUNT({$this->_pt()}.persona)"; }

  public function label() {
    return "CONCAT_WS(' ', {$this->_pt()}.id)"; 
  }


}
