<?php
require_once("class/model/entityOptions/Mapping.php");

class _PlanMapping extends MappingEntityOptions{

  public function id() { return $this->_pt() . ".id"; }
  public function orientacion() { return $this->_pt() . ".orientacion"; }
  public function resolucion() { return $this->_pt() . ".resolucion"; }
  public function distribucionHoraria() { return $this->_pt() . ".distribucion_horaria"; }

  public function minId() { return "MIN({$this->_pt()}.id)"; }
  public function maxId() { return "MAX({$this->_pt()}.id)"; }
  public function countId() { return "COUNT({$this->_pt()}.id)"; }

  public function minOrientacion() { return "MIN({$this->_pt()}.orientacion)"; }
  public function maxOrientacion() { return "MAX({$this->_pt()}.orientacion)"; }
  public function countOrientacion() { return "COUNT({$this->_pt()}.orientacion)"; }

  public function minResolucion() { return "MIN({$this->_pt()}.resolucion)"; }
  public function maxResolucion() { return "MAX({$this->_pt()}.resolucion)"; }
  public function countResolucion() { return "COUNT({$this->_pt()}.resolucion)"; }

  public function minDistribucionHoraria() { return "MIN({$this->_pt()}.distribucion_horaria)"; }
  public function maxDistribucionHoraria() { return "MAX({$this->_pt()}.distribucion_horaria)"; }
  public function countDistribucionHoraria() { return "COUNT({$this->_pt()}.distribucion_horaria)"; }

  public function label() {
    return "CONCAT_WS(' ', {$this->_pt()}.orientacion, 
{$this->_pt()}.distribucion_horaria)"; 
  }


}
