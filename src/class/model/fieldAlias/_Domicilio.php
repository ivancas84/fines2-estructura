<?php
require_once("class/model/entityOptions/FieldAlias.php");

class _DomicilioFieldAlias extends FieldAliasEntityOptions{

  public function id() { return $this->mapping->id() . " AS " . $this->_pf() . "id"; }
  public function calle() { return $this->mapping->calle() . " AS " . $this->_pf() . "calle"; }
  public function entre() { return $this->mapping->entre() . " AS " . $this->_pf() . "entre"; }
  public function numero() { return $this->mapping->numero() . " AS " . $this->_pf() . "numero"; }
  public function piso() { return $this->mapping->piso() . " AS " . $this->_pf() . "piso"; }
  public function departamento() { return $this->mapping->departamento() . " AS " . $this->_pf() . "departamento"; }
  public function barrio() { return $this->mapping->barrio() . " AS " . $this->_pf() . "barrio"; }
  public function localidad() { return $this->mapping->localidad() . " AS " . $this->_pf() . "localidad"; }

  public function minId() { return $this->mapping->minId() . " AS " . $this->_pf() . "min_id"; }
  public function maxId() { return $this->mapping->maxId() . " AS " . $this->_pf() . "max_id"; }
  public function countId() { return $this->mapping->countId() . " AS " . $this->_pf() . "count_id"; }

  public function minCalle() { return $this->mapping->minCalle() . " AS " . $this->_pf() . "min_calle"; }
  public function maxCalle() { return $this->mapping->maxCalle() . " AS " . $this->_pf() . "max_calle"; }
  public function countCalle() { return $this->mapping->countCalle() . " AS " . $this->_pf() . "count_calle"; }

  public function minEntre() { return $this->mapping->minEntre() . " AS " . $this->_pf() . "min_entre"; }
  public function maxEntre() { return $this->mapping->maxEntre() . " AS " . $this->_pf() . "max_entre"; }
  public function countEntre() { return $this->mapping->countEntre() . " AS " . $this->_pf() . "count_entre"; }

  public function minNumero() { return $this->mapping->minNumero() . " AS " . $this->_pf() . "min_numero"; }
  public function maxNumero() { return $this->mapping->maxNumero() . " AS " . $this->_pf() . "max_numero"; }
  public function countNumero() { return $this->mapping->countNumero() . " AS " . $this->_pf() . "count_numero"; }

  public function minPiso() { return $this->mapping->minPiso() . " AS " . $this->_pf() . "min_piso"; }
  public function maxPiso() { return $this->mapping->maxPiso() . " AS " . $this->_pf() . "max_piso"; }
  public function countPiso() { return $this->mapping->countPiso() . " AS " . $this->_pf() . "count_piso"; }

  public function minDepartamento() { return $this->mapping->minDepartamento() . " AS " . $this->_pf() . "min_departamento"; }
  public function maxDepartamento() { return $this->mapping->maxDepartamento() . " AS " . $this->_pf() . "max_departamento"; }
  public function countDepartamento() { return $this->mapping->countDepartamento() . " AS " . $this->_pf() . "count_departamento"; }

  public function minBarrio() { return $this->mapping->minBarrio() . " AS " . $this->_pf() . "min_barrio"; }
  public function maxBarrio() { return $this->mapping->maxBarrio() . " AS " . $this->_pf() . "max_barrio"; }
  public function countBarrio() { return $this->mapping->countBarrio() . " AS " . $this->_pf() . "count_barrio"; }

  public function minLocalidad() { return $this->mapping->minLocalidad() . " AS " . $this->_pf() . "min_localidad"; }
  public function maxLocalidad() { return $this->mapping->maxLocalidad() . " AS " . $this->_pf() . "max_localidad"; }
  public function countLocalidad() { return $this->mapping->countLocalidad() . " AS " . $this->_pf() . "count_localidad"; }

  public function label() { return $this->mapping->label() . " AS " . $this->_pf() . "label"; }



}
