<?php
require_once("class/model/entityOptions/FieldAlias.php");

class _SedeFieldAlias extends FieldAliasEntityOptions{

  public function id() { return $this->mapping->id() . " AS " . $this->_pf() . "id"; }
  public function numero() { return $this->mapping->numero() . " AS " . $this->_pf() . "numero"; }
  public function nombre() { return $this->mapping->nombre() . " AS " . $this->_pf() . "nombre"; }
  public function observaciones() { return $this->mapping->observaciones() . " AS " . $this->_pf() . "observaciones"; }
  public function alta() { return $this->mapping->alta() . " AS " . $this->_pf() . "alta"; }
  public function altaDate() { return $this->mapping->altaDate() . " AS " . $this->_pf() . "alta_date"; }
  public function altaYm() { return $this->mapping->altaYm() . " AS " . $this->_pf() . "alta_ym"; }
  public function altaY() { return $this->mapping->altaY() . " AS " . $this->_pf() . "alta_y"; }
  public function baja() { return $this->mapping->baja() . " AS " . $this->_pf() . "baja"; }
  public function bajaDate() { return $this->mapping->bajaDate() . " AS " . $this->_pf() . "baja_date"; }
  public function bajaYm() { return $this->mapping->bajaYm() . " AS " . $this->_pf() . "baja_ym"; }
  public function bajaY() { return $this->mapping->bajaY() . " AS " . $this->_pf() . "baja_y"; }
  public function domicilio() { return $this->mapping->domicilio() . " AS " . $this->_pf() . "domicilio"; }
  public function tipoSede() { return $this->mapping->tipoSede() . " AS " . $this->_pf() . "tipo_sede"; }
  public function centroEducativo() { return $this->mapping->centroEducativo() . " AS " . $this->_pf() . "centro_educativo"; }

  public function minId() { return $this->mapping->minId() . " AS " . $this->_pf() . "min_id"; }
  public function maxId() { return $this->mapping->maxId() . " AS " . $this->_pf() . "max_id"; }
  public function countId() { return $this->mapping->countId() . " AS " . $this->_pf() . "count_id"; }

  public function minNumero() { return $this->mapping->minNumero() . " AS " . $this->_pf() . "min_numero"; }
  public function maxNumero() { return $this->mapping->maxNumero() . " AS " . $this->_pf() . "max_numero"; }
  public function countNumero() { return $this->mapping->countNumero() . " AS " . $this->_pf() . "count_numero"; }

  public function minNombre() { return $this->mapping->minNombre() . " AS " . $this->_pf() . "min_nombre"; }
  public function maxNombre() { return $this->mapping->maxNombre() . " AS " . $this->_pf() . "max_nombre"; }
  public function countNombre() { return $this->mapping->countNombre() . " AS " . $this->_pf() . "count_nombre"; }

  public function minObservaciones() { return $this->mapping->minObservaciones() . " AS " . $this->_pf() . "min_observaciones"; }
  public function maxObservaciones() { return $this->mapping->maxObservaciones() . " AS " . $this->_pf() . "max_observaciones"; }
  public function countObservaciones() { return $this->mapping->countObservaciones() . " AS " . $this->_pf() . "count_observaciones"; }

  public function avgAlta() { return $this->mapping->avgAlta() . " AS " . $this->_pf() . "avg_alta"; }
  public function minAlta() { return $this->mapping->minAlta() . " AS " . $this->_pf() . "min_alta"; }
  public function maxAlta() { return $this->mapping->maxAlta() . " AS " . $this->_pf() . "max_alta"; }
  public function countAlta() { return $this->mapping->countAlta() . " AS " . $this->_pf() . "count_alta"; }

  public function avgBaja() { return $this->mapping->avgBaja() . " AS " . $this->_pf() . "avg_baja"; }
  public function minBaja() { return $this->mapping->minBaja() . " AS " . $this->_pf() . "min_baja"; }
  public function maxBaja() { return $this->mapping->maxBaja() . " AS " . $this->_pf() . "max_baja"; }
  public function countBaja() { return $this->mapping->countBaja() . " AS " . $this->_pf() . "count_baja"; }

  public function minDomicilio() { return $this->mapping->minDomicilio() . " AS " . $this->_pf() . "min_domicilio"; }
  public function maxDomicilio() { return $this->mapping->maxDomicilio() . " AS " . $this->_pf() . "max_domicilio"; }
  public function countDomicilio() { return $this->mapping->countDomicilio() . " AS " . $this->_pf() . "count_domicilio"; }

  public function minTipoSede() { return $this->mapping->minTipoSede() . " AS " . $this->_pf() . "min_tipo_sede"; }
  public function maxTipoSede() { return $this->mapping->maxTipoSede() . " AS " . $this->_pf() . "max_tipo_sede"; }
  public function countTipoSede() { return $this->mapping->countTipoSede() . " AS " . $this->_pf() . "count_tipo_sede"; }

  public function minCentroEducativo() { return $this->mapping->minCentroEducativo() . " AS " . $this->_pf() . "min_centro_educativo"; }
  public function maxCentroEducativo() { return $this->mapping->maxCentroEducativo() . " AS " . $this->_pf() . "max_centro_educativo"; }
  public function countCentroEducativo() { return $this->mapping->countCentroEducativo() . " AS " . $this->_pf() . "count_centro_educativo"; }

  public function label() { return $this->mapping->label() . " AS " . $this->_pf() . "label"; }



}
