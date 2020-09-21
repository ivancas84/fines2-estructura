<?php
require_once("class/model/entityOptions/Mapping.php");

class _ContralorMapping extends MappingEntityOptions{

  public function id() { return $this->_pt() . ".id"; }
  public function fechaContralor() { return $this->_pt() . ".fecha_contralor"; }
  public function fechaConsejo() { return $this->_pt() . ".fecha_consejo"; }
  public function insertado() { return $this->_pt() . ".insertado"; }
  public function insertadoDate() { return "CAST({$this->_pt()}.insertado AS DATE)"; }
  public function insertadoYm() { return "DATE_FORMAT({$this->_pt()}.insertado, '%Y-%m')"; }
  public function insertadoY() { return "DATE_FORMAT({$this->_pt()}.insertado, '%Y')"; }
  public function planillaDocente() { return $this->_pt() . ".planilla_docente"; }

  public function minId() { return "MIN({$this->_pt()}.id)"; }
  public function maxId() { return "MAX({$this->_pt()}.id)"; }
  public function countId() { return "COUNT({$this->_pt()}.id)"; }

  public function avgFechaContralor() { return "AVG({$this->_pt()}.fecha_contralor)"; }
  public function minFechaContralor() { return "MIN({$this->_pt()}.fecha_contralor)"; }
  public function maxFechaContralor() { return "MAX({$this->_pt()}.fecha_contralor)"; }
  public function countFechaContralor() { return "COUNT({$this->_pt()}.fecha_contralor)"; }

  public function avgFechaConsejo() { return "AVG({$this->_pt()}.fecha_consejo)"; }
  public function minFechaConsejo() { return "MIN({$this->_pt()}.fecha_consejo)"; }
  public function maxFechaConsejo() { return "MAX({$this->_pt()}.fecha_consejo)"; }
  public function countFechaConsejo() { return "COUNT({$this->_pt()}.fecha_consejo)"; }

  public function avgInsertado() { return "AVG({$this->_pt()}.insertado)"; }
  public function minInsertado() { return "MIN({$this->_pt()}.insertado)"; }
  public function maxInsertado() { return "MAX({$this->_pt()}.insertado)"; }
  public function countInsertado() { return "COUNT({$this->_pt()}.insertado)"; }

  public function minPlanillaDocente() { return "MIN({$this->_pt()}.planilla_docente)"; }
  public function maxPlanillaDocente() { return "MAX({$this->_pt()}.planilla_docente)"; }
  public function countPlanillaDocente() { return "COUNT({$this->_pt()}.planilla_docente)"; }

  public function label() {
    return "CONCAT_WS(' ', {$this->_pt()}.id)"; 
  }


}
