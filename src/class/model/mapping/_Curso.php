<?php
require_once("class/model/entityOptions/Mapping.php");

class _CursoMapping extends MappingEntityOptions{

  public function id() { return $this->_pt() . ".id"; }
  public function horasCatedra() { return $this->_pt() . ".horas_catedra"; }
  public function ige() { return $this->_pt() . ".ige"; }
  public function numeroDocumentoDesignado() { return $this->_pt() . ".numero_documento_designado"; }
  public function alta() { return $this->_pt() . ".alta"; }
  public function altaDate() { return "CAST({$this->_pt()}.alta AS DATE)"; }
  public function altaYm() { return "DATE_FORMAT({$this->_pt()}.alta, '%Y-%m')"; }
  public function altaY() { return "DATE_FORMAT({$this->_pt()}.alta, '%Y')"; }
  public function comision() { return $this->_pt() . ".comision"; }
  public function asignatura() { return $this->_pt() . ".asignatura"; }

  public function minId() { return "MIN({$this->_pt()}.id)"; }
  public function maxId() { return "MAX({$this->_pt()}.id)"; }
  public function countId() { return "COUNT({$this->_pt()}.id)"; }

  public function sumHorasCatedra() { return "SUM({$this->_pt()}.horas_catedra)"; }
  public function avgHorasCatedra() { return "AVG({$this->_pt()}.horas_catedra)"; }
  public function minHorasCatedra() { return "MIN({$this->_pt()}.horas_catedra)"; }
  public function maxHorasCatedra() { return "MAX({$this->_pt()}.horas_catedra)"; }
  public function countHorasCatedra() { return "COUNT({$this->_pt()}.horas_catedra)"; }

  public function minIge() { return "MIN({$this->_pt()}.ige)"; }
  public function maxIge() { return "MAX({$this->_pt()}.ige)"; }
  public function countIge() { return "COUNT({$this->_pt()}.ige)"; }

  public function minNumeroDocumentoDesignado() { return "MIN({$this->_pt()}.numero_documento_designado)"; }
  public function maxNumeroDocumentoDesignado() { return "MAX({$this->_pt()}.numero_documento_designado)"; }
  public function countNumeroDocumentoDesignado() { return "COUNT({$this->_pt()}.numero_documento_designado)"; }

  public function avgAlta() { return "AVG({$this->_pt()}.alta)"; }
  public function minAlta() { return "MIN({$this->_pt()}.alta)"; }
  public function maxAlta() { return "MAX({$this->_pt()}.alta)"; }
  public function countAlta() { return "COUNT({$this->_pt()}.alta)"; }

  public function minComision() { return "MIN({$this->_pt()}.comision)"; }
  public function maxComision() { return "MAX({$this->_pt()}.comision)"; }
  public function countComision() { return "COUNT({$this->_pt()}.comision)"; }

  public function minAsignatura() { return "MIN({$this->_pt()}.asignatura)"; }
  public function maxAsignatura() { return "MAX({$this->_pt()}.asignatura)"; }
  public function countAsignatura() { return "COUNT({$this->_pt()}.asignatura)"; }

  public function label() {
    return "CONCAT_WS(' ', {$this->_pf()}com.division, 
{$this->_pf()}com_sed.numero, 
{$this->_pf()}com_sed.nombre, 
{$this->_pf()}com_pla.anio, 
{$this->_pf()}com_pla.semestre, 
{$this->_pf()}com_pla_plb.id, 
{$this->_pf()}com_cal.inicio, 
{$this->_pf()}com_cal.fin, 
{$this->_pf()}com_cal.anio, 
{$this->_pf()}com_cal.semestre, 
{$this->_pf()}asi.nombre)"; 
  }


}
