<?php
require_once("class/model/entityOptions/FieldAlias.php");

class _CentroEducativoFieldAlias extends FieldAliasEntityOptions{

  public function id() { return $this->mapping->id() . " AS " . $this->_pf() . "id"; }
  public function nombre() { return $this->mapping->nombre() . " AS " . $this->_pf() . "nombre"; }
  public function cue() { return $this->mapping->cue() . " AS " . $this->_pf() . "cue"; }
  public function domicilio() { return $this->mapping->domicilio() . " AS " . $this->_pf() . "domicilio"; }

  public function minId() { return $this->mapping->minId() . " AS " . $this->_pf() . "min_id"; }
  public function maxId() { return $this->mapping->maxId() . " AS " . $this->_pf() . "max_id"; }
  public function countId() { return $this->mapping->countId() . " AS " . $this->_pf() . "count_id"; }

  public function minNombre() { return $this->mapping->minNombre() . " AS " . $this->_pf() . "min_nombre"; }
  public function maxNombre() { return $this->mapping->maxNombre() . " AS " . $this->_pf() . "max_nombre"; }
  public function countNombre() { return $this->mapping->countNombre() . " AS " . $this->_pf() . "count_nombre"; }

  public function minCue() { return $this->mapping->minCue() . " AS " . $this->_pf() . "min_cue"; }
  public function maxCue() { return $this->mapping->maxCue() . " AS " . $this->_pf() . "max_cue"; }
  public function countCue() { return $this->mapping->countCue() . " AS " . $this->_pf() . "count_cue"; }

  public function minDomicilio() { return $this->mapping->minDomicilio() . " AS " . $this->_pf() . "min_domicilio"; }
  public function maxDomicilio() { return $this->mapping->maxDomicilio() . " AS " . $this->_pf() . "max_domicilio"; }
  public function countDomicilio() { return $this->mapping->countDomicilio() . " AS " . $this->_pf() . "count_domicilio"; }

  public function label() { return $this->mapping->label() . " AS " . $this->_pf() . "label"; }



}
