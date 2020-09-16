<?php
require_once("class/model/entityOptions/Mapping.php");

class _DetallePersonaMapping extends MappingEntityOptions{

  public function id() { return $this->_pt() . ".id"; }
  public function descripcion() { return $this->_pt() . ".descripcion"; }
  public function creado() { return $this->_pt() . ".creado"; }
  public function creadoDate() { return "CAST({$this->_pt()}.creado AS DATE)"; }
  public function creadoYm() { return "DATE_FORMAT({$this->_pt()}.creado, '%Y-%m')"; }
  public function creadoY() { return "DATE_FORMAT({$this->_pt()}.creado, '%Y')"; }
  public function archivo() { return $this->_pt() . ".archivo"; }
  public function persona() { return $this->_pt() . ".persona"; }

  public function minId() { return "MIN({$this->_pt()}.id)"; }
  public function maxId() { return "MAX({$this->_pt()}.id)"; }
  public function countId() { return "COUNT({$this->_pt()}.id)"; }

  public function minDescripcion() { return "MIN({$this->_pt()}.descripcion)"; }
  public function maxDescripcion() { return "MAX({$this->_pt()}.descripcion)"; }
  public function countDescripcion() { return "COUNT({$this->_pt()}.descripcion)"; }

  public function avgCreado() { return "AVG({$this->_pt()}.creado)"; }
  public function minCreado() { return "MIN({$this->_pt()}.creado)"; }
  public function maxCreado() { return "MAX({$this->_pt()}.creado)"; }
  public function countCreado() { return "COUNT({$this->_pt()}.creado)"; }

  public function minArchivo() { return "MIN({$this->_pt()}.archivo)"; }
  public function maxArchivo() { return "MAX({$this->_pt()}.archivo)"; }
  public function countArchivo() { return "COUNT({$this->_pt()}.archivo)"; }

  public function minPersona() { return "MIN({$this->_pt()}.persona)"; }
  public function maxPersona() { return "MAX({$this->_pt()}.persona)"; }
  public function countPersona() { return "COUNT({$this->_pt()}.persona)"; }

  public function label() {
    return "CONCAT_WS(' ', {$this->_pt()}.id)"; 
  }


}
