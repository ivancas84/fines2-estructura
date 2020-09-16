<?php
require_once("class/model/entityOptions/FieldAlias.php");

class _CalendarioFieldAlias extends FieldAliasEntityOptions{

  public function id() { return $this->mapping->id() . " AS " . $this->_pf() . "id"; }
  public function inicio() { return $this->mapping->inicio() . " AS " . $this->_pf() . "inicio"; }
  public function fin() { return $this->mapping->fin() . " AS " . $this->_pf() . "fin"; }
  public function anio() { return $this->mapping->anio() . " AS " . $this->_pf() . "anio"; }
  public function semestre() { return $this->mapping->semestre() . " AS " . $this->_pf() . "semestre"; }
  public function insertado() { return $this->mapping->insertado() . " AS " . $this->_pf() . "insertado"; }
  public function insertadoDate() { return $this->mapping->insertadoDate() . " AS " . $this->_pf() . "insertado_date"; }
  public function insertadoYm() { return $this->mapping->insertadoYm() . " AS " . $this->_pf() . "insertado_ym"; }
  public function insertadoY() { return $this->mapping->insertadoY() . " AS " . $this->_pf() . "insertado_y"; }

  public function minId() { return $this->mapping->minId() . " AS " . $this->_pf() . "min_id"; }
  public function maxId() { return $this->mapping->maxId() . " AS " . $this->_pf() . "max_id"; }
  public function countId() { return $this->mapping->countId() . " AS " . $this->_pf() . "count_id"; }

  public function avgInicio() { return $this->mapping->avgInicio() . " AS " . $this->_pf() . "avg_inicio"; }
  public function minInicio() { return $this->mapping->minInicio() . " AS " . $this->_pf() . "min_inicio"; }
  public function maxInicio() { return $this->mapping->maxInicio() . " AS " . $this->_pf() . "max_inicio"; }
  public function countInicio() { return $this->mapping->countInicio() . " AS " . $this->_pf() . "count_inicio"; }

  public function avgFin() { return $this->mapping->avgFin() . " AS " . $this->_pf() . "avg_fin"; }
  public function minFin() { return $this->mapping->minFin() . " AS " . $this->_pf() . "min_fin"; }
  public function maxFin() { return $this->mapping->maxFin() . " AS " . $this->_pf() . "max_fin"; }
  public function countFin() { return $this->mapping->countFin() . " AS " . $this->_pf() . "count_fin"; }

  public function minAnio() { return $this->mapping->minAnio() . " AS " . $this->_pf() . "min_anio"; }
  public function maxAnio() { return $this->mapping->maxAnio() . " AS " . $this->_pf() . "max_anio"; }
  public function countAnio() { return $this->mapping->countAnio() . " AS " . $this->_pf() . "count_anio"; }

  public function sumSemestre() { return $this->mapping->sumSemestre() . " AS " . $this->_pf() . "sum_semestre"; }
  public function avgSemestre() { return $this->mapping->avgSemestre() . " AS " . $this->_pf() . "avg_semestre"; }
  public function minSemestre() { return $this->mapping->minSemestre() . " AS " . $this->_pf() . "min_semestre"; }
  public function maxSemestre() { return $this->mapping->maxSemestre() . " AS " . $this->_pf() . "max_semestre"; }
  public function countSemestre() { return $this->mapping->countSemestre() . " AS " . $this->_pf() . "count_semestre"; }

  public function avgInsertado() { return $this->mapping->avgInsertado() . " AS " . $this->_pf() . "avg_insertado"; }
  public function minInsertado() { return $this->mapping->minInsertado() . " AS " . $this->_pf() . "min_insertado"; }
  public function maxInsertado() { return $this->mapping->maxInsertado() . " AS " . $this->_pf() . "max_insertado"; }
  public function countInsertado() { return $this->mapping->countInsertado() . " AS " . $this->_pf() . "count_insertado"; }

  public function label() { return $this->mapping->label() . " AS " . $this->_pf() . "label"; }



}
