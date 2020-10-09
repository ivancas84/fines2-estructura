<?php
require_once("class/model/entityOptions/Mapping.php");

class _CalendarioMapping extends MappingEntityOptions{

  public function id() { return $this->_pt() . ".id"; }
  public function inicio() { return $this->_pt() . ".inicio"; }
  public function fin() { return $this->_pt() . ".fin"; }
  public function anio() { return $this->_pt() . ".anio"; }
  public function semestre() { return $this->_pt() . ".semestre"; }
  public function insertado() { return $this->_pt() . ".insertado"; }
  public function insertadoDate() { return "CAST({$this->_pt()}.insertado AS DATE)"; }
  public function insertadoYm() { return "DATE_FORMAT({$this->_pt()}.insertado, '%Y-%m')"; }
  public function insertadoY() { return "DATE_FORMAT({$this->_pt()}.insertado, '%Y')"; }

  public function minId() { return "MIN({$this->_pt()}.id)"; }
  public function maxId() { return "MAX({$this->_pt()}.id)"; }
  public function countId() { return "COUNT({$this->_pt()}.id)"; }

  public function avgInicio() { return "AVG({$this->_pt()}.inicio)"; }
  public function minInicio() { return "MIN({$this->_pt()}.inicio)"; }
  public function maxInicio() { return "MAX({$this->_pt()}.inicio)"; }
  public function countInicio() { return "COUNT({$this->_pt()}.inicio)"; }

  public function avgFin() { return "AVG({$this->_pt()}.fin)"; }
  public function minFin() { return "MIN({$this->_pt()}.fin)"; }
  public function maxFin() { return "MAX({$this->_pt()}.fin)"; }
  public function countFin() { return "COUNT({$this->_pt()}.fin)"; }

  public function minAnio() { return "MIN({$this->_pt()}.anio)"; }
  public function maxAnio() { return "MAX({$this->_pt()}.anio)"; }
  public function countAnio() { return "COUNT({$this->_pt()}.anio)"; }

  public function sumSemestre() { return "SUM({$this->_pt()}.semestre)"; }
  public function avgSemestre() { return "AVG({$this->_pt()}.semestre)"; }
  public function minSemestre() { return "MIN({$this->_pt()}.semestre)"; }
  public function maxSemestre() { return "MAX({$this->_pt()}.semestre)"; }
  public function countSemestre() { return "COUNT({$this->_pt()}.semestre)"; }

  public function avgInsertado() { return "AVG({$this->_pt()}.insertado)"; }
  public function minInsertado() { return "MIN({$this->_pt()}.insertado)"; }
  public function maxInsertado() { return "MAX({$this->_pt()}.insertado)"; }
  public function countInsertado() { return "COUNT({$this->_pt()}.insertado)"; }

  public function label() {
    return "CONCAT_WS(' ', {$this->_pt()}.inicio, 
{$this->_pt()}.fin, 
{$this->_pt()}.anio, 
{$this->_pt()}.semestre)"; 
  }


}
