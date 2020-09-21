<?php
require_once("class/model/entityOptions/FieldAlias.php");

class _DetallePersonaFieldAlias extends FieldAliasEntityOptions{

  public function id() { return $this->mapping->id() . " AS " . $this->_pf() . "id"; }
  public function descripcion() { return $this->mapping->descripcion() . " AS " . $this->_pf() . "descripcion"; }
  public function creado() { return $this->mapping->creado() . " AS " . $this->_pf() . "creado"; }
  public function creadoDate() { return $this->mapping->creadoDate() . " AS " . $this->_pf() . "creado_date"; }
  public function creadoYm() { return $this->mapping->creadoYm() . " AS " . $this->_pf() . "creado_ym"; }
  public function creadoY() { return $this->mapping->creadoY() . " AS " . $this->_pf() . "creado_y"; }
  public function archivo() { return $this->mapping->archivo() . " AS " . $this->_pf() . "archivo"; }
  public function persona() { return $this->mapping->persona() . " AS " . $this->_pf() . "persona"; }

  public function minId() { return $this->mapping->minId() . " AS " . $this->_pf() . "min_id"; }
  public function maxId() { return $this->mapping->maxId() . " AS " . $this->_pf() . "max_id"; }
  public function countId() { return $this->mapping->countId() . " AS " . $this->_pf() . "count_id"; }

  public function minDescripcion() { return $this->mapping->minDescripcion() . " AS " . $this->_pf() . "min_descripcion"; }
  public function maxDescripcion() { return $this->mapping->maxDescripcion() . " AS " . $this->_pf() . "max_descripcion"; }
  public function countDescripcion() { return $this->mapping->countDescripcion() . " AS " . $this->_pf() . "count_descripcion"; }

  public function avgCreado() { return $this->mapping->avgCreado() . " AS " . $this->_pf() . "avg_creado"; }
  public function minCreado() { return $this->mapping->minCreado() . " AS " . $this->_pf() . "min_creado"; }
  public function maxCreado() { return $this->mapping->maxCreado() . " AS " . $this->_pf() . "max_creado"; }
  public function countCreado() { return $this->mapping->countCreado() . " AS " . $this->_pf() . "count_creado"; }

  public function minArchivo() { return $this->mapping->minArchivo() . " AS " . $this->_pf() . "min_archivo"; }
  public function maxArchivo() { return $this->mapping->maxArchivo() . " AS " . $this->_pf() . "max_archivo"; }
  public function countArchivo() { return $this->mapping->countArchivo() . " AS " . $this->_pf() . "count_archivo"; }

  public function minPersona() { return $this->mapping->minPersona() . " AS " . $this->_pf() . "min_persona"; }
  public function maxPersona() { return $this->mapping->maxPersona() . " AS " . $this->_pf() . "max_persona"; }
  public function countPersona() { return $this->mapping->countPersona() . " AS " . $this->_pf() . "count_persona"; }

  public function label() { return $this->mapping->label() . " AS " . $this->_pf() . "label"; }



}
