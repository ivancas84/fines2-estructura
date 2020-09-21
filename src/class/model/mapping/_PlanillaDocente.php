<?php
require_once("class/model/entityOptions/Mapping.php");

class _PlanillaDocenteMapping extends MappingEntityOptions{

  public function id() { return $this->_pt() . ".id"; }
  public function numero() { return $this->_pt() . ".numero"; }
  public function insertado() { return $this->_pt() . ".insertado"; }
  public function insertadoDate() { return "CAST({$this->_pt()}.insertado AS DATE)"; }
  public function insertadoYm() { return "DATE_FORMAT({$this->_pt()}.insertado, '%Y-%m')"; }
  public function insertadoY() { return "DATE_FORMAT({$this->_pt()}.insertado, '%Y')"; }

  public function minId() { return "MIN({$this->_pt()}.id)"; }
  public function maxId() { return "MAX({$this->_pt()}.id)"; }
  public function countId() { return "COUNT({$this->_pt()}.id)"; }

  public function minNumero() { return "MIN({$this->_pt()}.numero)"; }
  public function maxNumero() { return "MAX({$this->_pt()}.numero)"; }
  public function countNumero() { return "COUNT({$this->_pt()}.numero)"; }

  public function avgInsertado() { return "AVG({$this->_pt()}.insertado)"; }
  public function minInsertado() { return "MIN({$this->_pt()}.insertado)"; }
  public function maxInsertado() { return "MAX({$this->_pt()}.insertado)"; }
  public function countInsertado() { return "COUNT({$this->_pt()}.insertado)"; }

  public function label() {
    return "CONCAT_WS(' ', {$this->_pt()}.numero)"; 
  }


}
