<?php
require_once("class/model/entityOptions/Mapping.php");

class _TomaMapping extends MappingEntityOptions{

  public function id() { return $this->_pt() . ".id"; }
  public function fechaToma() { return $this->_pt() . ".fecha_toma"; }
  public function estado() { return $this->_pt() . ".estado"; }
  public function observaciones() { return $this->_pt() . ".observaciones"; }
  public function comentario() { return $this->_pt() . ".comentario"; }
  public function tipoMovimiento() { return $this->_pt() . ".tipo_movimiento"; }
  public function estadoContralor() { return $this->_pt() . ".estado_contralor"; }
  public function alta() { return $this->_pt() . ".alta"; }
  public function altaDate() { return "CAST({$this->_pt()}.alta AS DATE)"; }
  public function altaYm() { return "DATE_FORMAT({$this->_pt()}.alta, '%Y-%m')"; }
  public function altaY() { return "DATE_FORMAT({$this->_pt()}.alta, '%Y')"; }
  public function curso() { return $this->_pt() . ".curso"; }
  public function docente() { return $this->_pt() . ".docente"; }
  public function reemplazo() { return $this->_pt() . ".reemplazo"; }
  public function planillaDocente() { return $this->_pt() . ".planilla_docente"; }

  public function minId() { return "MIN({$this->_pt()}.id)"; }
  public function maxId() { return "MAX({$this->_pt()}.id)"; }
  public function countId() { return "COUNT({$this->_pt()}.id)"; }

  public function avgFechaToma() { return "AVG({$this->_pt()}.fecha_toma)"; }
  public function minFechaToma() { return "MIN({$this->_pt()}.fecha_toma)"; }
  public function maxFechaToma() { return "MAX({$this->_pt()}.fecha_toma)"; }
  public function countFechaToma() { return "COUNT({$this->_pt()}.fecha_toma)"; }

  public function minEstado() { return "MIN({$this->_pt()}.estado)"; }
  public function maxEstado() { return "MAX({$this->_pt()}.estado)"; }
  public function countEstado() { return "COUNT({$this->_pt()}.estado)"; }

  public function minObservaciones() { return "MIN({$this->_pt()}.observaciones)"; }
  public function maxObservaciones() { return "MAX({$this->_pt()}.observaciones)"; }
  public function countObservaciones() { return "COUNT({$this->_pt()}.observaciones)"; }

  public function minComentario() { return "MIN({$this->_pt()}.comentario)"; }
  public function maxComentario() { return "MAX({$this->_pt()}.comentario)"; }
  public function countComentario() { return "COUNT({$this->_pt()}.comentario)"; }

  public function minTipoMovimiento() { return "MIN({$this->_pt()}.tipo_movimiento)"; }
  public function maxTipoMovimiento() { return "MAX({$this->_pt()}.tipo_movimiento)"; }
  public function countTipoMovimiento() { return "COUNT({$this->_pt()}.tipo_movimiento)"; }

  public function minEstadoContralor() { return "MIN({$this->_pt()}.estado_contralor)"; }
  public function maxEstadoContralor() { return "MAX({$this->_pt()}.estado_contralor)"; }
  public function countEstadoContralor() { return "COUNT({$this->_pt()}.estado_contralor)"; }

  public function avgAlta() { return "AVG({$this->_pt()}.alta)"; }
  public function minAlta() { return "MIN({$this->_pt()}.alta)"; }
  public function maxAlta() { return "MAX({$this->_pt()}.alta)"; }
  public function countAlta() { return "COUNT({$this->_pt()}.alta)"; }

  public function minCurso() { return "MIN({$this->_pt()}.curso)"; }
  public function maxCurso() { return "MAX({$this->_pt()}.curso)"; }
  public function countCurso() { return "COUNT({$this->_pt()}.curso)"; }

  public function minDocente() { return "MIN({$this->_pt()}.docente)"; }
  public function maxDocente() { return "MAX({$this->_pt()}.docente)"; }
  public function countDocente() { return "COUNT({$this->_pt()}.docente)"; }

  public function minReemplazo() { return "MIN({$this->_pt()}.reemplazo)"; }
  public function maxReemplazo() { return "MAX({$this->_pt()}.reemplazo)"; }
  public function countReemplazo() { return "COUNT({$this->_pt()}.reemplazo)"; }

  public function minPlanillaDocente() { return "MIN({$this->_pt()}.planilla_docente)"; }
  public function maxPlanillaDocente() { return "MAX({$this->_pt()}.planilla_docente)"; }
  public function countPlanillaDocente() { return "COUNT({$this->_pt()}.planilla_docente)"; }

  public function label() {
    return "CONCAT_WS(' ', {$this->_pt()}.id)"; 
  }


}
