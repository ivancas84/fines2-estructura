<?php
require_once("class/model/entityOptions/FieldAlias.php");

class _DistribucionHorariaFieldAlias extends FieldAliasEntityOptions{

  public function id() { return $this->mapping->id() . " AS " . $this->_pf() . "id"; }
  public function horasCatedra() { return $this->mapping->horasCatedra() . " AS " . $this->_pf() . "horas_catedra"; }
  public function dia() { return $this->mapping->dia() . " AS " . $this->_pf() . "dia"; }
  public function asignatura() { return $this->mapping->asignatura() . " AS " . $this->_pf() . "asignatura"; }
  public function planificacion() { return $this->mapping->planificacion() . " AS " . $this->_pf() . "planificacion"; }

  public function minId() { return $this->mapping->minId() . " AS " . $this->_pf() . "min_id"; }
  public function maxId() { return $this->mapping->maxId() . " AS " . $this->_pf() . "max_id"; }
  public function countId() { return $this->mapping->countId() . " AS " . $this->_pf() . "count_id"; }

  public function sumHorasCatedra() { return $this->mapping->sumHorasCatedra() . " AS " . $this->_pf() . "sum_horas_catedra"; }
  public function avgHorasCatedra() { return $this->mapping->avgHorasCatedra() . " AS " . $this->_pf() . "avg_horas_catedra"; }
  public function minHorasCatedra() { return $this->mapping->minHorasCatedra() . " AS " . $this->_pf() . "min_horas_catedra"; }
  public function maxHorasCatedra() { return $this->mapping->maxHorasCatedra() . " AS " . $this->_pf() . "max_horas_catedra"; }
  public function countHorasCatedra() { return $this->mapping->countHorasCatedra() . " AS " . $this->_pf() . "count_horas_catedra"; }

  public function sumDia() { return $this->mapping->sumDia() . " AS " . $this->_pf() . "sum_dia"; }
  public function avgDia() { return $this->mapping->avgDia() . " AS " . $this->_pf() . "avg_dia"; }
  public function minDia() { return $this->mapping->minDia() . " AS " . $this->_pf() . "min_dia"; }
  public function maxDia() { return $this->mapping->maxDia() . " AS " . $this->_pf() . "max_dia"; }
  public function countDia() { return $this->mapping->countDia() . " AS " . $this->_pf() . "count_dia"; }

  public function minAsignatura() { return $this->mapping->minAsignatura() . " AS " . $this->_pf() . "min_asignatura"; }
  public function maxAsignatura() { return $this->mapping->maxAsignatura() . " AS " . $this->_pf() . "max_asignatura"; }
  public function countAsignatura() { return $this->mapping->countAsignatura() . " AS " . $this->_pf() . "count_asignatura"; }

  public function minPlanificacion() { return $this->mapping->minPlanificacion() . " AS " . $this->_pf() . "min_planificacion"; }
  public function maxPlanificacion() { return $this->mapping->maxPlanificacion() . " AS " . $this->_pf() . "max_planificacion"; }
  public function countPlanificacion() { return $this->mapping->countPlanificacion() . " AS " . $this->_pf() . "count_planificacion"; }

  public function label() { return $this->mapping->label() . " AS " . $this->_pf() . "label"; }



}
