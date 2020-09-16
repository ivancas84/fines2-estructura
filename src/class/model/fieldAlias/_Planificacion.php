<?php
require_once("class/model/entityOptions/FieldAlias.php");

class _PlanificacionFieldAlias extends FieldAliasEntityOptions{

  public function id() { return $this->mapping->id() . " AS " . $this->_pf() . "id"; }
  public function anio() { return $this->mapping->anio() . " AS " . $this->_pf() . "anio"; }
  public function semestre() { return $this->mapping->semestre() . " AS " . $this->_pf() . "semestre"; }
  public function plan() { return $this->mapping->plan() . " AS " . $this->_pf() . "plan"; }

  public function minId() { return $this->mapping->minId() . " AS " . $this->_pf() . "min_id"; }
  public function maxId() { return $this->mapping->maxId() . " AS " . $this->_pf() . "max_id"; }
  public function countId() { return $this->mapping->countId() . " AS " . $this->_pf() . "count_id"; }

  public function minAnio() { return $this->mapping->minAnio() . " AS " . $this->_pf() . "min_anio"; }
  public function maxAnio() { return $this->mapping->maxAnio() . " AS " . $this->_pf() . "max_anio"; }
  public function countAnio() { return $this->mapping->countAnio() . " AS " . $this->_pf() . "count_anio"; }

  public function minSemestre() { return $this->mapping->minSemestre() . " AS " . $this->_pf() . "min_semestre"; }
  public function maxSemestre() { return $this->mapping->maxSemestre() . " AS " . $this->_pf() . "max_semestre"; }
  public function countSemestre() { return $this->mapping->countSemestre() . " AS " . $this->_pf() . "count_semestre"; }

  public function minPlan() { return $this->mapping->minPlan() . " AS " . $this->_pf() . "min_plan"; }
  public function maxPlan() { return $this->mapping->maxPlan() . " AS " . $this->_pf() . "max_plan"; }
  public function countPlan() { return $this->mapping->countPlan() . " AS " . $this->_pf() . "count_plan"; }

  public function label() { return $this->mapping->label() . " AS " . $this->_pf() . "label"; }



}
