<?php
require_once("class/model/entityOptions/Mapping.php");

class _DomicilioMapping extends MappingEntityOptions{

  public function id() { return $this->_pt() . ".id"; }
  public function calle() { return $this->_pt() . ".calle"; }
  public function entre() { return $this->_pt() . ".entre"; }
  public function numero() { return $this->_pt() . ".numero"; }
  public function piso() { return $this->_pt() . ".piso"; }
  public function departamento() { return $this->_pt() . ".departamento"; }
  public function barrio() { return $this->_pt() . ".barrio"; }
  public function localidad() { return $this->_pt() . ".localidad"; }

  public function minId() { return "MIN({$this->_pt()}.id)"; }
  public function maxId() { return "MAX({$this->_pt()}.id)"; }
  public function countId() { return "COUNT({$this->_pt()}.id)"; }

  public function minCalle() { return "MIN({$this->_pt()}.calle)"; }
  public function maxCalle() { return "MAX({$this->_pt()}.calle)"; }
  public function countCalle() { return "COUNT({$this->_pt()}.calle)"; }

  public function minEntre() { return "MIN({$this->_pt()}.entre)"; }
  public function maxEntre() { return "MAX({$this->_pt()}.entre)"; }
  public function countEntre() { return "COUNT({$this->_pt()}.entre)"; }

  public function minNumero() { return "MIN({$this->_pt()}.numero)"; }
  public function maxNumero() { return "MAX({$this->_pt()}.numero)"; }
  public function countNumero() { return "COUNT({$this->_pt()}.numero)"; }

  public function minPiso() { return "MIN({$this->_pt()}.piso)"; }
  public function maxPiso() { return "MAX({$this->_pt()}.piso)"; }
  public function countPiso() { return "COUNT({$this->_pt()}.piso)"; }

  public function minDepartamento() { return "MIN({$this->_pt()}.departamento)"; }
  public function maxDepartamento() { return "MAX({$this->_pt()}.departamento)"; }
  public function countDepartamento() { return "COUNT({$this->_pt()}.departamento)"; }

  public function minBarrio() { return "MIN({$this->_pt()}.barrio)"; }
  public function maxBarrio() { return "MAX({$this->_pt()}.barrio)"; }
  public function countBarrio() { return "COUNT({$this->_pt()}.barrio)"; }

  public function minLocalidad() { return "MIN({$this->_pt()}.localidad)"; }
  public function maxLocalidad() { return "MAX({$this->_pt()}.localidad)"; }
  public function countLocalidad() { return "COUNT({$this->_pt()}.localidad)"; }

  public function label() {
    return "CONCAT_WS(' ', {$this->_pt()}.calle, 
{$this->_pt()}.numero, 
{$this->_pt()}.barrio)"; 
  }


}
