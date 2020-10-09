<?php
require_once("class/model/entityOptions/FieldAlias.php");

class _CursoFieldAlias extends FieldAliasEntityOptions{

  public function id() { return $this->mapping->id() . " AS " . $this->_pf() . "id"; }
  public function horasCatedra() { return $this->mapping->horasCatedra() . " AS " . $this->_pf() . "horas_catedra"; }
  public function ige() { return $this->mapping->ige() . " AS " . $this->_pf() . "ige"; }
  public function numeroDocumentoDesignado() { return $this->mapping->numeroDocumentoDesignado() . " AS " . $this->_pf() . "numero_documento_designado"; }
  public function alta() { return $this->mapping->alta() . " AS " . $this->_pf() . "alta"; }
  public function altaDate() { return $this->mapping->altaDate() . " AS " . $this->_pf() . "alta_date"; }
  public function altaYm() { return $this->mapping->altaYm() . " AS " . $this->_pf() . "alta_ym"; }
  public function altaY() { return $this->mapping->altaY() . " AS " . $this->_pf() . "alta_y"; }
  public function comision() { return $this->mapping->comision() . " AS " . $this->_pf() . "comision"; }
  public function asignatura() { return $this->mapping->asignatura() . " AS " . $this->_pf() . "asignatura"; }

  public function minId() { return $this->mapping->minId() . " AS " . $this->_pf() . "min_id"; }
  public function maxId() { return $this->mapping->maxId() . " AS " . $this->_pf() . "max_id"; }
  public function countId() { return $this->mapping->countId() . " AS " . $this->_pf() . "count_id"; }

  public function sumHorasCatedra() { return $this->mapping->sumHorasCatedra() . " AS " . $this->_pf() . "sum_horas_catedra"; }
  public function avgHorasCatedra() { return $this->mapping->avgHorasCatedra() . " AS " . $this->_pf() . "avg_horas_catedra"; }
  public function minHorasCatedra() { return $this->mapping->minHorasCatedra() . " AS " . $this->_pf() . "min_horas_catedra"; }
  public function maxHorasCatedra() { return $this->mapping->maxHorasCatedra() . " AS " . $this->_pf() . "max_horas_catedra"; }
  public function countHorasCatedra() { return $this->mapping->countHorasCatedra() . " AS " . $this->_pf() . "count_horas_catedra"; }

  public function minIge() { return $this->mapping->minIge() . " AS " . $this->_pf() . "min_ige"; }
  public function maxIge() { return $this->mapping->maxIge() . " AS " . $this->_pf() . "max_ige"; }
  public function countIge() { return $this->mapping->countIge() . " AS " . $this->_pf() . "count_ige"; }

  public function minNumeroDocumentoDesignado() { return $this->mapping->minNumeroDocumentoDesignado() . " AS " . $this->_pf() . "min_numero_documento_designado"; }
  public function maxNumeroDocumentoDesignado() { return $this->mapping->maxNumeroDocumentoDesignado() . " AS " . $this->_pf() . "max_numero_documento_designado"; }
  public function countNumeroDocumentoDesignado() { return $this->mapping->countNumeroDocumentoDesignado() . " AS " . $this->_pf() . "count_numero_documento_designado"; }

  public function avgAlta() { return $this->mapping->avgAlta() . " AS " . $this->_pf() . "avg_alta"; }
  public function minAlta() { return $this->mapping->minAlta() . " AS " . $this->_pf() . "min_alta"; }
  public function maxAlta() { return $this->mapping->maxAlta() . " AS " . $this->_pf() . "max_alta"; }
  public function countAlta() { return $this->mapping->countAlta() . " AS " . $this->_pf() . "count_alta"; }

  public function minComision() { return $this->mapping->minComision() . " AS " . $this->_pf() . "min_comision"; }
  public function maxComision() { return $this->mapping->maxComision() . " AS " . $this->_pf() . "max_comision"; }
  public function countComision() { return $this->mapping->countComision() . " AS " . $this->_pf() . "count_comision"; }

  public function minAsignatura() { return $this->mapping->minAsignatura() . " AS " . $this->_pf() . "min_asignatura"; }
  public function maxAsignatura() { return $this->mapping->maxAsignatura() . " AS " . $this->_pf() . "max_asignatura"; }
  public function countAsignatura() { return $this->mapping->countAsignatura() . " AS " . $this->_pf() . "count_asignatura"; }

  public function label() { return $this->mapping->label() . " AS " . $this->_pf() . "label"; }



}
