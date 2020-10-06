<?php
require_once("class/model/entityOptions/Mapping.php");

class _AsignacionPlanillaDocenteMapping extends MappingEntityOptions{

  public function id() { return $this->_pt() . ".id"; }
  public function insertado() { return $this->_pt() . ".insertado"; }
  public function insertadoDate() { return "CAST({$this->_pt()}.insertado AS DATE)"; }
  public function insertadoYm() { return "DATE_FORMAT({$this->_pt()}.insertado, '%Y-%m')"; }
  public function insertadoY() { return "DATE_FORMAT({$this->_pt()}.insertado, '%Y')"; }
  public function planillaDocente() { return $this->_pt() . ".planilla_docente"; }
  public function toma() { return $this->_pt() . ".toma"; }

  public function minId() { return "MIN({$this->_pt()}.id)"; }
  public function maxId() { return "MAX({$this->_pt()}.id)"; }
  public function countId() { return "COUNT({$this->_pt()}.id)"; }

  public function avgInsertado() { return "AVG({$this->_pt()}.insertado)"; }
  public function minInsertado() { return "MIN({$this->_pt()}.insertado)"; }
  public function maxInsertado() { return "MAX({$this->_pt()}.insertado)"; }
  public function countInsertado() { return "COUNT({$this->_pt()}.insertado)"; }

  public function minPlanillaDocente() { return "MIN({$this->_pt()}.planilla_docente)"; }
  public function maxPlanillaDocente() { return "MAX({$this->_pt()}.planilla_docente)"; }
  public function countPlanillaDocente() { return "COUNT({$this->_pt()}.planilla_docente)"; }

  public function minToma() { return "MIN({$this->_pt()}.toma)"; }
  public function maxToma() { return "MAX({$this->_pt()}.toma)"; }
  public function countToma() { return "COUNT({$this->_pt()}.toma)"; }

  public function label() {
    return "CONCAT_WS(' ', {$this->_pt()}.id)"; 
  }


}
