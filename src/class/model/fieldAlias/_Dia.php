<?php
require_once("class/model/entityOptions/FieldAlias.php");

class _DiaFieldAlias extends FieldAliasEntityOptions{

  public function id() { return $this->mapping->id() . " AS " . $this->_pf() . "id"; }
  public function numero() { return $this->mapping->numero() . " AS " . $this->_pf() . "numero"; }
  public function dia() { return $this->mapping->dia() . " AS " . $this->_pf() . "dia"; }

  public function minId() { return $this->mapping->minId() . " AS " . $this->_pf() . "min_id"; }
  public function maxId() { return $this->mapping->maxId() . " AS " . $this->_pf() . "max_id"; }
  public function countId() { return $this->mapping->countId() . " AS " . $this->_pf() . "count_id"; }

  public function sumNumero() { return $this->mapping->sumNumero() . " AS " . $this->_pf() . "sum_numero"; }
  public function avgNumero() { return $this->mapping->avgNumero() . " AS " . $this->_pf() . "avg_numero"; }
  public function minNumero() { return $this->mapping->minNumero() . " AS " . $this->_pf() . "min_numero"; }
  public function maxNumero() { return $this->mapping->maxNumero() . " AS " . $this->_pf() . "max_numero"; }
  public function countNumero() { return $this->mapping->countNumero() . " AS " . $this->_pf() . "count_numero"; }

  public function minDia() { return $this->mapping->minDia() . " AS " . $this->_pf() . "min_dia"; }
  public function maxDia() { return $this->mapping->maxDia() . " AS " . $this->_pf() . "max_dia"; }
  public function countDia() { return $this->mapping->countDia() . " AS " . $this->_pf() . "count_dia"; }

  public function label() { return $this->mapping->label() . " AS " . $this->_pf() . "label"; }



}
