<?php
require_once("class/model/entityOptions/FieldAlias.php");

class _DesignacionFieldAlias extends FieldAliasEntityOptions{

  public function id() { return $this->mapping->id() . " AS " . $this->_pf() . "id"; }
  public function desde() { return $this->mapping->desde() . " AS " . $this->_pf() . "desde"; }
  public function hasta() { return $this->mapping->hasta() . " AS " . $this->_pf() . "hasta"; }
  public function alta() { return $this->mapping->alta() . " AS " . $this->_pf() . "alta"; }
  public function altaDate() { return $this->mapping->altaDate() . " AS " . $this->_pf() . "alta_date"; }
  public function altaYm() { return $this->mapping->altaYm() . " AS " . $this->_pf() . "alta_ym"; }
  public function altaY() { return $this->mapping->altaY() . " AS " . $this->_pf() . "alta_y"; }
  public function cargo() { return $this->mapping->cargo() . " AS " . $this->_pf() . "cargo"; }
  public function sede() { return $this->mapping->sede() . " AS " . $this->_pf() . "sede"; }
  public function persona() { return $this->mapping->persona() . " AS " . $this->_pf() . "persona"; }

  public function minId() { return $this->mapping->minId() . " AS " . $this->_pf() . "min_id"; }
  public function maxId() { return $this->mapping->maxId() . " AS " . $this->_pf() . "max_id"; }
  public function countId() { return $this->mapping->countId() . " AS " . $this->_pf() . "count_id"; }

  public function avgDesde() { return $this->mapping->avgDesde() . " AS " . $this->_pf() . "avg_desde"; }
  public function minDesde() { return $this->mapping->minDesde() . " AS " . $this->_pf() . "min_desde"; }
  public function maxDesde() { return $this->mapping->maxDesde() . " AS " . $this->_pf() . "max_desde"; }
  public function countDesde() { return $this->mapping->countDesde() . " AS " . $this->_pf() . "count_desde"; }

  public function avgHasta() { return $this->mapping->avgHasta() . " AS " . $this->_pf() . "avg_hasta"; }
  public function minHasta() { return $this->mapping->minHasta() . " AS " . $this->_pf() . "min_hasta"; }
  public function maxHasta() { return $this->mapping->maxHasta() . " AS " . $this->_pf() . "max_hasta"; }
  public function countHasta() { return $this->mapping->countHasta() . " AS " . $this->_pf() . "count_hasta"; }

  public function avgAlta() { return $this->mapping->avgAlta() . " AS " . $this->_pf() . "avg_alta"; }
  public function minAlta() { return $this->mapping->minAlta() . " AS " . $this->_pf() . "min_alta"; }
  public function maxAlta() { return $this->mapping->maxAlta() . " AS " . $this->_pf() . "max_alta"; }
  public function countAlta() { return $this->mapping->countAlta() . " AS " . $this->_pf() . "count_alta"; }

  public function minCargo() { return $this->mapping->minCargo() . " AS " . $this->_pf() . "min_cargo"; }
  public function maxCargo() { return $this->mapping->maxCargo() . " AS " . $this->_pf() . "max_cargo"; }
  public function countCargo() { return $this->mapping->countCargo() . " AS " . $this->_pf() . "count_cargo"; }

  public function minSede() { return $this->mapping->minSede() . " AS " . $this->_pf() . "min_sede"; }
  public function maxSede() { return $this->mapping->maxSede() . " AS " . $this->_pf() . "max_sede"; }
  public function countSede() { return $this->mapping->countSede() . " AS " . $this->_pf() . "count_sede"; }

  public function minPersona() { return $this->mapping->minPersona() . " AS " . $this->_pf() . "min_persona"; }
  public function maxPersona() { return $this->mapping->maxPersona() . " AS " . $this->_pf() . "max_persona"; }
  public function countPersona() { return $this->mapping->countPersona() . " AS " . $this->_pf() . "count_persona"; }

  public function label() { return $this->mapping->label() . " AS " . $this->_pf() . "label"; }



}
