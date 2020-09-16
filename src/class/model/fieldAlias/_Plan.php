<?php
require_once("class/model/entityOptions/FieldAlias.php");

class _PlanFieldAlias extends FieldAliasEntityOptions{

  public function id() { return $this->mapping->id() . " AS " . $this->_pf() . "id"; }
  public function orientacion() { return $this->mapping->orientacion() . " AS " . $this->_pf() . "orientacion"; }
  public function resolucion() { return $this->mapping->resolucion() . " AS " . $this->_pf() . "resolucion"; }
  public function distribucionHoraria() { return $this->mapping->distribucionHoraria() . " AS " . $this->_pf() . "distribucion_horaria"; }

  public function minId() { return $this->mapping->minId() . " AS " . $this->_pf() . "min_id"; }
  public function maxId() { return $this->mapping->maxId() . " AS " . $this->_pf() . "max_id"; }
  public function countId() { return $this->mapping->countId() . " AS " . $this->_pf() . "count_id"; }

  public function minOrientacion() { return $this->mapping->minOrientacion() . " AS " . $this->_pf() . "min_orientacion"; }
  public function maxOrientacion() { return $this->mapping->maxOrientacion() . " AS " . $this->_pf() . "max_orientacion"; }
  public function countOrientacion() { return $this->mapping->countOrientacion() . " AS " . $this->_pf() . "count_orientacion"; }

  public function minResolucion() { return $this->mapping->minResolucion() . " AS " . $this->_pf() . "min_resolucion"; }
  public function maxResolucion() { return $this->mapping->maxResolucion() . " AS " . $this->_pf() . "max_resolucion"; }
  public function countResolucion() { return $this->mapping->countResolucion() . " AS " . $this->_pf() . "count_resolucion"; }

  public function minDistribucionHoraria() { return $this->mapping->minDistribucionHoraria() . " AS " . $this->_pf() . "min_distribucion_horaria"; }
  public function maxDistribucionHoraria() { return $this->mapping->maxDistribucionHoraria() . " AS " . $this->_pf() . "max_distribucion_horaria"; }
  public function countDistribucionHoraria() { return $this->mapping->countDistribucionHoraria() . " AS " . $this->_pf() . "count_distribucion_horaria"; }

  public function label() { return $this->mapping->label() . " AS " . $this->_pf() . "label"; }



}
