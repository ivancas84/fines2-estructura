<?php
require_once("class/model/entityOptions/Mapping.php");

class _HorarioMapping extends MappingEntityOptions{

  public function id() { return $this->_pt() . ".id"; }
  public function horaInicio() { return $this->_pt() . ".hora_inicio"; }
  public function horaFin() { return $this->_pt() . ".hora_fin"; }
  public function curso() { return $this->_pt() . ".curso"; }
  public function dia() { return $this->_pt() . ".dia"; }

  public function minId() { return "MIN({$this->_pt()}.id)"; }
  public function maxId() { return "MAX({$this->_pt()}.id)"; }
  public function countId() { return "COUNT({$this->_pt()}.id)"; }

  public function minHoraInicio() { return "MIN({$this->_pt()}.hora_inicio)"; }
  public function maxHoraInicio() { return "MAX({$this->_pt()}.hora_inicio)"; }
  public function countHoraInicio() { return "COUNT({$this->_pt()}.hora_inicio)"; }

  public function minHoraFin() { return "MIN({$this->_pt()}.hora_fin)"; }
  public function maxHoraFin() { return "MAX({$this->_pt()}.hora_fin)"; }
  public function countHoraFin() { return "COUNT({$this->_pt()}.hora_fin)"; }

  public function minCurso() { return "MIN({$this->_pt()}.curso)"; }
  public function maxCurso() { return "MAX({$this->_pt()}.curso)"; }
  public function countCurso() { return "COUNT({$this->_pt()}.curso)"; }

  public function minDia() { return "MIN({$this->_pt()}.dia)"; }
  public function maxDia() { return "MAX({$this->_pt()}.dia)"; }
  public function countDia() { return "COUNT({$this->_pt()}.dia)"; }

  public function label() {
    return "CONCAT_WS(' ', {$this->_pt()}.id)"; 
  }


}
