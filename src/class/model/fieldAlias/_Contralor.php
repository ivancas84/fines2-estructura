<?php
require_once("class/model/entityOptions/FieldAlias.php");

class _ContralorFieldAlias extends FieldAliasEntityOptions{

  public function id() { return $this->mapping->id() . " AS " . $this->_pf() . "id"; }
  public function fechaContralor() { return $this->mapping->fechaContralor() . " AS " . $this->_pf() . "fecha_contralor"; }
  public function fechaConsejo() { return $this->mapping->fechaConsejo() . " AS " . $this->_pf() . "fecha_consejo"; }
  public function insertado() { return $this->mapping->insertado() . " AS " . $this->_pf() . "insertado"; }
  public function insertadoDate() { return $this->mapping->insertadoDate() . " AS " . $this->_pf() . "insertado_date"; }
  public function insertadoYm() { return $this->mapping->insertadoYm() . " AS " . $this->_pf() . "insertado_ym"; }
  public function insertadoY() { return $this->mapping->insertadoY() . " AS " . $this->_pf() . "insertado_y"; }
  public function planillaDocente() { return $this->mapping->planillaDocente() . " AS " . $this->_pf() . "planilla_docente"; }

  public function minId() { return $this->mapping->minId() . " AS " . $this->_pf() . "min_id"; }
  public function maxId() { return $this->mapping->maxId() . " AS " . $this->_pf() . "max_id"; }
  public function countId() { return $this->mapping->countId() . " AS " . $this->_pf() . "count_id"; }

  public function avgFechaContralor() { return $this->mapping->avgFechaContralor() . " AS " . $this->_pf() . "avg_fecha_contralor"; }
  public function minFechaContralor() { return $this->mapping->minFechaContralor() . " AS " . $this->_pf() . "min_fecha_contralor"; }
  public function maxFechaContralor() { return $this->mapping->maxFechaContralor() . " AS " . $this->_pf() . "max_fecha_contralor"; }
  public function countFechaContralor() { return $this->mapping->countFechaContralor() . " AS " . $this->_pf() . "count_fecha_contralor"; }

  public function avgFechaConsejo() { return $this->mapping->avgFechaConsejo() . " AS " . $this->_pf() . "avg_fecha_consejo"; }
  public function minFechaConsejo() { return $this->mapping->minFechaConsejo() . " AS " . $this->_pf() . "min_fecha_consejo"; }
  public function maxFechaConsejo() { return $this->mapping->maxFechaConsejo() . " AS " . $this->_pf() . "max_fecha_consejo"; }
  public function countFechaConsejo() { return $this->mapping->countFechaConsejo() . " AS " . $this->_pf() . "count_fecha_consejo"; }

  public function avgInsertado() { return $this->mapping->avgInsertado() . " AS " . $this->_pf() . "avg_insertado"; }
  public function minInsertado() { return $this->mapping->minInsertado() . " AS " . $this->_pf() . "min_insertado"; }
  public function maxInsertado() { return $this->mapping->maxInsertado() . " AS " . $this->_pf() . "max_insertado"; }
  public function countInsertado() { return $this->mapping->countInsertado() . " AS " . $this->_pf() . "count_insertado"; }

  public function minPlanillaDocente() { return $this->mapping->minPlanillaDocente() . " AS " . $this->_pf() . "min_planilla_docente"; }
  public function maxPlanillaDocente() { return $this->mapping->maxPlanillaDocente() . " AS " . $this->_pf() . "max_planilla_docente"; }
  public function countPlanillaDocente() { return $this->mapping->countPlanillaDocente() . " AS " . $this->_pf() . "count_planilla_docente"; }

  public function label() { return $this->mapping->label() . " AS " . $this->_pf() . "label"; }



}
