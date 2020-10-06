<?php
require_once("class/model/entityOptions/FieldAlias.php");

class _AsignacionPlanillaDocenteFieldAlias extends FieldAliasEntityOptions{

  public function id() { return $this->mapping->id() . " AS " . $this->_pf() . "id"; }
  public function insertado() { return $this->mapping->insertado() . " AS " . $this->_pf() . "insertado"; }
  public function insertadoDate() { return $this->mapping->insertadoDate() . " AS " . $this->_pf() . "insertado_date"; }
  public function insertadoYm() { return $this->mapping->insertadoYm() . " AS " . $this->_pf() . "insertado_ym"; }
  public function insertadoY() { return $this->mapping->insertadoY() . " AS " . $this->_pf() . "insertado_y"; }
  public function planillaDocente() { return $this->mapping->planillaDocente() . " AS " . $this->_pf() . "planilla_docente"; }
  public function toma() { return $this->mapping->toma() . " AS " . $this->_pf() . "toma"; }

  public function minId() { return $this->mapping->minId() . " AS " . $this->_pf() . "min_id"; }
  public function maxId() { return $this->mapping->maxId() . " AS " . $this->_pf() . "max_id"; }
  public function countId() { return $this->mapping->countId() . " AS " . $this->_pf() . "count_id"; }

  public function avgInsertado() { return $this->mapping->avgInsertado() . " AS " . $this->_pf() . "avg_insertado"; }
  public function minInsertado() { return $this->mapping->minInsertado() . " AS " . $this->_pf() . "min_insertado"; }
  public function maxInsertado() { return $this->mapping->maxInsertado() . " AS " . $this->_pf() . "max_insertado"; }
  public function countInsertado() { return $this->mapping->countInsertado() . " AS " . $this->_pf() . "count_insertado"; }

  public function minPlanillaDocente() { return $this->mapping->minPlanillaDocente() . " AS " . $this->_pf() . "min_planilla_docente"; }
  public function maxPlanillaDocente() { return $this->mapping->maxPlanillaDocente() . " AS " . $this->_pf() . "max_planilla_docente"; }
  public function countPlanillaDocente() { return $this->mapping->countPlanillaDocente() . " AS " . $this->_pf() . "count_planilla_docente"; }

  public function minToma() { return $this->mapping->minToma() . " AS " . $this->_pf() . "min_toma"; }
  public function maxToma() { return $this->mapping->maxToma() . " AS " . $this->_pf() . "max_toma"; }
  public function countToma() { return $this->mapping->countToma() . " AS " . $this->_pf() . "count_toma"; }

  public function label() { return $this->mapping->label() . " AS " . $this->_pf() . "label"; }



}
