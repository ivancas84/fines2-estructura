<?php
require_once("class/model/entityOptions/FieldAlias.php");

class _TomaFieldAlias extends FieldAliasEntityOptions{

  public function id() { return $this->mapping->id() . " AS " . $this->_pf() . "id"; }
  public function fechaToma() { return $this->mapping->fechaToma() . " AS " . $this->_pf() . "fecha_toma"; }
  public function estado() { return $this->mapping->estado() . " AS " . $this->_pf() . "estado"; }
  public function observaciones() { return $this->mapping->observaciones() . " AS " . $this->_pf() . "observaciones"; }
  public function comentario() { return $this->mapping->comentario() . " AS " . $this->_pf() . "comentario"; }
  public function tipoMovimiento() { return $this->mapping->tipoMovimiento() . " AS " . $this->_pf() . "tipo_movimiento"; }
  public function estadoContralor() { return $this->mapping->estadoContralor() . " AS " . $this->_pf() . "estado_contralor"; }
  public function alta() { return $this->mapping->alta() . " AS " . $this->_pf() . "alta"; }
  public function altaDate() { return $this->mapping->altaDate() . " AS " . $this->_pf() . "alta_date"; }
  public function altaYm() { return $this->mapping->altaYm() . " AS " . $this->_pf() . "alta_ym"; }
  public function altaY() { return $this->mapping->altaY() . " AS " . $this->_pf() . "alta_y"; }
  public function curso() { return $this->mapping->curso() . " AS " . $this->_pf() . "curso"; }
  public function docente() { return $this->mapping->docente() . " AS " . $this->_pf() . "docente"; }
  public function reemplazo() { return $this->mapping->reemplazo() . " AS " . $this->_pf() . "reemplazo"; }

  public function minId() { return $this->mapping->minId() . " AS " . $this->_pf() . "min_id"; }
  public function maxId() { return $this->mapping->maxId() . " AS " . $this->_pf() . "max_id"; }
  public function countId() { return $this->mapping->countId() . " AS " . $this->_pf() . "count_id"; }

  public function avgFechaToma() { return $this->mapping->avgFechaToma() . " AS " . $this->_pf() . "avg_fecha_toma"; }
  public function minFechaToma() { return $this->mapping->minFechaToma() . " AS " . $this->_pf() . "min_fecha_toma"; }
  public function maxFechaToma() { return $this->mapping->maxFechaToma() . " AS " . $this->_pf() . "max_fecha_toma"; }
  public function countFechaToma() { return $this->mapping->countFechaToma() . " AS " . $this->_pf() . "count_fecha_toma"; }

  public function minEstado() { return $this->mapping->minEstado() . " AS " . $this->_pf() . "min_estado"; }
  public function maxEstado() { return $this->mapping->maxEstado() . " AS " . $this->_pf() . "max_estado"; }
  public function countEstado() { return $this->mapping->countEstado() . " AS " . $this->_pf() . "count_estado"; }

  public function minObservaciones() { return $this->mapping->minObservaciones() . " AS " . $this->_pf() . "min_observaciones"; }
  public function maxObservaciones() { return $this->mapping->maxObservaciones() . " AS " . $this->_pf() . "max_observaciones"; }
  public function countObservaciones() { return $this->mapping->countObservaciones() . " AS " . $this->_pf() . "count_observaciones"; }

  public function minComentario() { return $this->mapping->minComentario() . " AS " . $this->_pf() . "min_comentario"; }
  public function maxComentario() { return $this->mapping->maxComentario() . " AS " . $this->_pf() . "max_comentario"; }
  public function countComentario() { return $this->mapping->countComentario() . " AS " . $this->_pf() . "count_comentario"; }

  public function minTipoMovimiento() { return $this->mapping->minTipoMovimiento() . " AS " . $this->_pf() . "min_tipo_movimiento"; }
  public function maxTipoMovimiento() { return $this->mapping->maxTipoMovimiento() . " AS " . $this->_pf() . "max_tipo_movimiento"; }
  public function countTipoMovimiento() { return $this->mapping->countTipoMovimiento() . " AS " . $this->_pf() . "count_tipo_movimiento"; }

  public function minEstadoContralor() { return $this->mapping->minEstadoContralor() . " AS " . $this->_pf() . "min_estado_contralor"; }
  public function maxEstadoContralor() { return $this->mapping->maxEstadoContralor() . " AS " . $this->_pf() . "max_estado_contralor"; }
  public function countEstadoContralor() { return $this->mapping->countEstadoContralor() . " AS " . $this->_pf() . "count_estado_contralor"; }

  public function avgAlta() { return $this->mapping->avgAlta() . " AS " . $this->_pf() . "avg_alta"; }
  public function minAlta() { return $this->mapping->minAlta() . " AS " . $this->_pf() . "min_alta"; }
  public function maxAlta() { return $this->mapping->maxAlta() . " AS " . $this->_pf() . "max_alta"; }
  public function countAlta() { return $this->mapping->countAlta() . " AS " . $this->_pf() . "count_alta"; }

  public function minCurso() { return $this->mapping->minCurso() . " AS " . $this->_pf() . "min_curso"; }
  public function maxCurso() { return $this->mapping->maxCurso() . " AS " . $this->_pf() . "max_curso"; }
  public function countCurso() { return $this->mapping->countCurso() . " AS " . $this->_pf() . "count_curso"; }

  public function minDocente() { return $this->mapping->minDocente() . " AS " . $this->_pf() . "min_docente"; }
  public function maxDocente() { return $this->mapping->maxDocente() . " AS " . $this->_pf() . "max_docente"; }
  public function countDocente() { return $this->mapping->countDocente() . " AS " . $this->_pf() . "count_docente"; }

  public function minReemplazo() { return $this->mapping->minReemplazo() . " AS " . $this->_pf() . "min_reemplazo"; }
  public function maxReemplazo() { return $this->mapping->maxReemplazo() . " AS " . $this->_pf() . "max_reemplazo"; }
  public function countReemplazo() { return $this->mapping->countReemplazo() . " AS " . $this->_pf() . "count_reemplazo"; }

  public function label() { return $this->mapping->label() . " AS " . $this->_pf() . "label"; }



}
