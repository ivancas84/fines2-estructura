<?php
require_once("class/model/entityOptions/Mapping.php");

class _TelefonoMapping extends MappingEntityOptions{

  public function id() { return $this->_pt() . ".id"; }
  public function tipo() { return $this->_pt() . ".tipo"; }
  public function prefijo() { return $this->_pt() . ".prefijo"; }
  public function numero() { return $this->_pt() . ".numero"; }
  public function insertado() { return $this->_pt() . ".insertado"; }
  public function insertadoDate() { return "CAST({$this->_pt()}.insertado AS DATE)"; }
  public function insertadoYm() { return "DATE_FORMAT({$this->_pt()}.insertado, '%Y-%m')"; }
  public function insertadoY() { return "DATE_FORMAT({$this->_pt()}.insertado, '%Y')"; }
  public function eliminado() { return $this->_pt() . ".eliminado"; }
  public function eliminadoDate() { return "CAST({$this->_pt()}.eliminado AS DATE)"; }
  public function eliminadoYm() { return "DATE_FORMAT({$this->_pt()}.eliminado, '%Y-%m')"; }
  public function eliminadoY() { return "DATE_FORMAT({$this->_pt()}.eliminado, '%Y')"; }
  public function persona() { return $this->_pt() . ".persona"; }

  public function minId() { return "MIN({$this->_pt()}.id)"; }
  public function maxId() { return "MAX({$this->_pt()}.id)"; }
  public function countId() { return "COUNT({$this->_pt()}.id)"; }

  public function minTipo() { return "MIN({$this->_pt()}.tipo)"; }
  public function maxTipo() { return "MAX({$this->_pt()}.tipo)"; }
  public function countTipo() { return "COUNT({$this->_pt()}.tipo)"; }

  public function minPrefijo() { return "MIN({$this->_pt()}.prefijo)"; }
  public function maxPrefijo() { return "MAX({$this->_pt()}.prefijo)"; }
  public function countPrefijo() { return "COUNT({$this->_pt()}.prefijo)"; }

  public function minNumero() { return "MIN({$this->_pt()}.numero)"; }
  public function maxNumero() { return "MAX({$this->_pt()}.numero)"; }
  public function countNumero() { return "COUNT({$this->_pt()}.numero)"; }

  public function avgInsertado() { return "AVG({$this->_pt()}.insertado)"; }
  public function minInsertado() { return "MIN({$this->_pt()}.insertado)"; }
  public function maxInsertado() { return "MAX({$this->_pt()}.insertado)"; }
  public function countInsertado() { return "COUNT({$this->_pt()}.insertado)"; }

  public function avgEliminado() { return "AVG({$this->_pt()}.eliminado)"; }
  public function minEliminado() { return "MIN({$this->_pt()}.eliminado)"; }
  public function maxEliminado() { return "MAX({$this->_pt()}.eliminado)"; }
  public function countEliminado() { return "COUNT({$this->_pt()}.eliminado)"; }

  public function minPersona() { return "MIN({$this->_pt()}.persona)"; }
  public function maxPersona() { return "MAX({$this->_pt()}.persona)"; }
  public function countPersona() { return "COUNT({$this->_pt()}.persona)"; }

  public function label() {
    return "CONCAT_WS(' ', {$this->_pt()}.id)"; 
  }


}
