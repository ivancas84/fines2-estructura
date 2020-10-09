<?php
require_once("class/model/entityOptions/Mapping.php");

class _PlanificacionMapping extends MappingEntityOptions{

  public function id() { return $this->_pt() . ".id"; }
  public function anio() { return $this->_pt() . ".anio"; }
  public function semestre() { return $this->_pt() . ".semestre"; }
  public function plan() { return $this->_pt() . ".plan"; }

  public function minId() { return "MIN({$this->_pt()}.id)"; }
  public function maxId() { return "MAX({$this->_pt()}.id)"; }
  public function countId() { return "COUNT({$this->_pt()}.id)"; }

  public function minAnio() { return "MIN({$this->_pt()}.anio)"; }
  public function maxAnio() { return "MAX({$this->_pt()}.anio)"; }
  public function countAnio() { return "COUNT({$this->_pt()}.anio)"; }

  public function minSemestre() { return "MIN({$this->_pt()}.semestre)"; }
  public function maxSemestre() { return "MAX({$this->_pt()}.semestre)"; }
  public function countSemestre() { return "COUNT({$this->_pt()}.semestre)"; }

  public function minPlan() { return "MIN({$this->_pt()}.plan)"; }
  public function maxPlan() { return "MAX({$this->_pt()}.plan)"; }
  public function countPlan() { return "COUNT({$this->_pt()}.plan)"; }

  public function label() {
    return "CONCAT_WS(' ', {$this->_pt()}.id)"; 
  }


}
