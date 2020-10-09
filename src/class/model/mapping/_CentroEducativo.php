<?php
require_once("class/model/entityOptions/Mapping.php");

class _CentroEducativoMapping extends MappingEntityOptions{

  public function id() { return $this->_pt() . ".id"; }
  public function nombre() { return $this->_pt() . ".nombre"; }
  public function cue() { return $this->_pt() . ".cue"; }
  public function domicilio() { return $this->_pt() . ".domicilio"; }

  public function minId() { return "MIN({$this->_pt()}.id)"; }
  public function maxId() { return "MAX({$this->_pt()}.id)"; }
  public function countId() { return "COUNT({$this->_pt()}.id)"; }

  public function minNombre() { return "MIN({$this->_pt()}.nombre)"; }
  public function maxNombre() { return "MAX({$this->_pt()}.nombre)"; }
  public function countNombre() { return "COUNT({$this->_pt()}.nombre)"; }

  public function minCue() { return "MIN({$this->_pt()}.cue)"; }
  public function maxCue() { return "MAX({$this->_pt()}.cue)"; }
  public function countCue() { return "COUNT({$this->_pt()}.cue)"; }

  public function minDomicilio() { return "MIN({$this->_pt()}.domicilio)"; }
  public function maxDomicilio() { return "MAX({$this->_pt()}.domicilio)"; }
  public function countDomicilio() { return "COUNT({$this->_pt()}.domicilio)"; }

  public function label() {
    return "CONCAT_WS(' ', {$this->_pt()}.nombre)"; 
  }


}
