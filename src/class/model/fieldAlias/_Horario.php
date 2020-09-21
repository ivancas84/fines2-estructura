<?php
require_once("class/model/entityOptions/FieldAlias.php");

class _HorarioFieldAlias extends FieldAliasEntityOptions{

  public function id() { return $this->mapping->id() . " AS " . $this->_pf() . "id"; }
  public function horaInicio() { return $this->mapping->horaInicio() . " AS " . $this->_pf() . "hora_inicio"; }
  public function horaFin() { return $this->mapping->horaFin() . " AS " . $this->_pf() . "hora_fin"; }
  public function curso() { return $this->mapping->curso() . " AS " . $this->_pf() . "curso"; }
  public function dia() { return $this->mapping->dia() . " AS " . $this->_pf() . "dia"; }

  public function minId() { return $this->mapping->minId() . " AS " . $this->_pf() . "min_id"; }
  public function maxId() { return $this->mapping->maxId() . " AS " . $this->_pf() . "max_id"; }
  public function countId() { return $this->mapping->countId() . " AS " . $this->_pf() . "count_id"; }

  public function minHoraInicio() { return $this->mapping->minHoraInicio() . " AS " . $this->_pf() . "min_hora_inicio"; }
  public function maxHoraInicio() { return $this->mapping->maxHoraInicio() . " AS " . $this->_pf() . "max_hora_inicio"; }
  public function countHoraInicio() { return $this->mapping->countHoraInicio() . " AS " . $this->_pf() . "count_hora_inicio"; }

  public function minHoraFin() { return $this->mapping->minHoraFin() . " AS " . $this->_pf() . "min_hora_fin"; }
  public function maxHoraFin() { return $this->mapping->maxHoraFin() . " AS " . $this->_pf() . "max_hora_fin"; }
  public function countHoraFin() { return $this->mapping->countHoraFin() . " AS " . $this->_pf() . "count_hora_fin"; }

  public function minCurso() { return $this->mapping->minCurso() . " AS " . $this->_pf() . "min_curso"; }
  public function maxCurso() { return $this->mapping->maxCurso() . " AS " . $this->_pf() . "max_curso"; }
  public function countCurso() { return $this->mapping->countCurso() . " AS " . $this->_pf() . "count_curso"; }

  public function minDia() { return $this->mapping->minDia() . " AS " . $this->_pf() . "min_dia"; }
  public function maxDia() { return $this->mapping->maxDia() . " AS " . $this->_pf() . "max_dia"; }
  public function countDia() { return $this->mapping->countDia() . " AS " . $this->_pf() . "count_dia"; }

  public function label() { return $this->mapping->label() . " AS " . $this->_pf() . "label"; }



}
