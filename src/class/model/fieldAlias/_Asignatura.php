<?php
require_once("class/model/entityOptions/FieldAlias.php");

class _AsignaturaFieldAlias extends FieldAliasEntityOptions{

  public function id() { return $this->mapping->id() . " AS " . $this->_pf() . "id"; }
  public function nombre() { return $this->mapping->nombre() . " AS " . $this->_pf() . "nombre"; }
  public function formacion() { return $this->mapping->formacion() . " AS " . $this->_pf() . "formacion"; }
  public function clasificacion() { return $this->mapping->clasificacion() . " AS " . $this->_pf() . "clasificacion"; }
  public function codigo() { return $this->mapping->codigo() . " AS " . $this->_pf() . "codigo"; }
  public function perfil() { return $this->mapping->perfil() . " AS " . $this->_pf() . "perfil"; }

  public function minId() { return $this->mapping->minId() . " AS " . $this->_pf() . "min_id"; }
  public function maxId() { return $this->mapping->maxId() . " AS " . $this->_pf() . "max_id"; }
  public function countId() { return $this->mapping->countId() . " AS " . $this->_pf() . "count_id"; }

  public function minNombre() { return $this->mapping->minNombre() . " AS " . $this->_pf() . "min_nombre"; }
  public function maxNombre() { return $this->mapping->maxNombre() . " AS " . $this->_pf() . "max_nombre"; }
  public function countNombre() { return $this->mapping->countNombre() . " AS " . $this->_pf() . "count_nombre"; }

  public function minFormacion() { return $this->mapping->minFormacion() . " AS " . $this->_pf() . "min_formacion"; }
  public function maxFormacion() { return $this->mapping->maxFormacion() . " AS " . $this->_pf() . "max_formacion"; }
  public function countFormacion() { return $this->mapping->countFormacion() . " AS " . $this->_pf() . "count_formacion"; }

  public function minClasificacion() { return $this->mapping->minClasificacion() . " AS " . $this->_pf() . "min_clasificacion"; }
  public function maxClasificacion() { return $this->mapping->maxClasificacion() . " AS " . $this->_pf() . "max_clasificacion"; }
  public function countClasificacion() { return $this->mapping->countClasificacion() . " AS " . $this->_pf() . "count_clasificacion"; }

  public function minCodigo() { return $this->mapping->minCodigo() . " AS " . $this->_pf() . "min_codigo"; }
  public function maxCodigo() { return $this->mapping->maxCodigo() . " AS " . $this->_pf() . "max_codigo"; }
  public function countCodigo() { return $this->mapping->countCodigo() . " AS " . $this->_pf() . "count_codigo"; }

  public function minPerfil() { return $this->mapping->minPerfil() . " AS " . $this->_pf() . "min_perfil"; }
  public function maxPerfil() { return $this->mapping->maxPerfil() . " AS " . $this->_pf() . "max_perfil"; }
  public function countPerfil() { return $this->mapping->countPerfil() . " AS " . $this->_pf() . "count_perfil"; }

  public function label() { return $this->mapping->label() . " AS " . $this->_pf() . "label"; }



}
