<?php
require_once("class/model/entityOptions/Mapping.php");

class _DistribucionHorariaMapping extends MappingEntityOptions{

  public function id() { return $this->_pt() . ".id"; }
  public function horasCatedra() { return $this->_pt() . ".horas_catedra"; }
  public function dia() { return $this->_pt() . ".dia"; }
  public function asignatura() { return $this->_pt() . ".asignatura"; }
  public function planificacion() { return $this->_pt() . ".planificacion"; }

  public function minId() { return "MIN({$this->_pt()}.id)"; }
  public function maxId() { return "MAX({$this->_pt()}.id)"; }
  public function countId() { return "COUNT({$this->_pt()}.id)"; }

  public function sumHorasCatedra() { return "SUM({$this->_pt()}.horas_catedra)"; }
  public function avgHorasCatedra() { return "AVG({$this->_pt()}.horas_catedra)"; }
  public function minHorasCatedra() { return "MIN({$this->_pt()}.horas_catedra)"; }
  public function maxHorasCatedra() { return "MAX({$this->_pt()}.horas_catedra)"; }
  public function countHorasCatedra() { return "COUNT({$this->_pt()}.horas_catedra)"; }

  public function sumDia() { return "SUM({$this->_pt()}.dia)"; }
  public function avgDia() { return "AVG({$this->_pt()}.dia)"; }
  public function minDia() { return "MIN({$this->_pt()}.dia)"; }
  public function maxDia() { return "MAX({$this->_pt()}.dia)"; }
  public function countDia() { return "COUNT({$this->_pt()}.dia)"; }

  public function minAsignatura() { return "MIN({$this->_pt()}.asignatura)"; }
  public function maxAsignatura() { return "MAX({$this->_pt()}.asignatura)"; }
  public function countAsignatura() { return "COUNT({$this->_pt()}.asignatura)"; }

  public function minPlanificacion() { return "MIN({$this->_pt()}.planificacion)"; }
  public function maxPlanificacion() { return "MAX({$this->_pt()}.planificacion)"; }
  public function countPlanificacion() { return "COUNT({$this->_pt()}.planificacion)"; }

  public function label() {
    return "CONCAT_WS(' ', {$this->_pt()}.id)"; 
  }


}
