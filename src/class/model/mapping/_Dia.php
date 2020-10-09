<?php
require_once("class/model/entityOptions/Mapping.php");

class _DiaMapping extends MappingEntityOptions{

  public function id() { return $this->_pt() . ".id"; }
  public function numero() { return $this->_pt() . ".numero"; }
  public function dia() { return $this->_pt() . ".dia"; }

  public function minId() { return "MIN({$this->_pt()}.id)"; }
  public function maxId() { return "MAX({$this->_pt()}.id)"; }
  public function countId() { return "COUNT({$this->_pt()}.id)"; }

  public function sumNumero() { return "SUM({$this->_pt()}.numero)"; }
  public function avgNumero() { return "AVG({$this->_pt()}.numero)"; }
  public function minNumero() { return "MIN({$this->_pt()}.numero)"; }
  public function maxNumero() { return "MAX({$this->_pt()}.numero)"; }
  public function countNumero() { return "COUNT({$this->_pt()}.numero)"; }

  public function minDia() { return "MIN({$this->_pt()}.dia)"; }
  public function maxDia() { return "MAX({$this->_pt()}.dia)"; }
  public function countDia() { return "COUNT({$this->_pt()}.dia)"; }

  public function label() {
    return "CONCAT_WS(' ', {$this->_pt()}.id)"; 
  }


}
