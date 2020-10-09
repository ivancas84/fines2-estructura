<?php
require_once("class/model/entityOptions/Mapping.php");

class _ModalidadMapping extends MappingEntityOptions{

  public function id() { return $this->_pt() . ".id"; }
  public function nombre() { return $this->_pt() . ".nombre"; }

  public function minId() { return "MIN({$this->_pt()}.id)"; }
  public function maxId() { return "MAX({$this->_pt()}.id)"; }
  public function countId() { return "COUNT({$this->_pt()}.id)"; }

  public function minNombre() { return "MIN({$this->_pt()}.nombre)"; }
  public function maxNombre() { return "MAX({$this->_pt()}.nombre)"; }
  public function countNombre() { return "COUNT({$this->_pt()}.nombre)"; }

  public function label() {
    return "CONCAT_WS(' ', {$this->_pt()}.id)"; 
  }


}
