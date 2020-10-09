<?php
require_once("class/model/entityOptions/Mapping.php");

class _AsignaturaMapping extends MappingEntityOptions{

  public function id() { return $this->_pt() . ".id"; }
  public function nombre() { return $this->_pt() . ".nombre"; }
  public function formacion() { return $this->_pt() . ".formacion"; }
  public function clasificacion() { return $this->_pt() . ".clasificacion"; }
  public function codigo() { return $this->_pt() . ".codigo"; }
  public function perfil() { return $this->_pt() . ".perfil"; }

  public function minId() { return "MIN({$this->_pt()}.id)"; }
  public function maxId() { return "MAX({$this->_pt()}.id)"; }
  public function countId() { return "COUNT({$this->_pt()}.id)"; }

  public function minNombre() { return "MIN({$this->_pt()}.nombre)"; }
  public function maxNombre() { return "MAX({$this->_pt()}.nombre)"; }
  public function countNombre() { return "COUNT({$this->_pt()}.nombre)"; }

  public function minFormacion() { return "MIN({$this->_pt()}.formacion)"; }
  public function maxFormacion() { return "MAX({$this->_pt()}.formacion)"; }
  public function countFormacion() { return "COUNT({$this->_pt()}.formacion)"; }

  public function minClasificacion() { return "MIN({$this->_pt()}.clasificacion)"; }
  public function maxClasificacion() { return "MAX({$this->_pt()}.clasificacion)"; }
  public function countClasificacion() { return "COUNT({$this->_pt()}.clasificacion)"; }

  public function minCodigo() { return "MIN({$this->_pt()}.codigo)"; }
  public function maxCodigo() { return "MAX({$this->_pt()}.codigo)"; }
  public function countCodigo() { return "COUNT({$this->_pt()}.codigo)"; }

  public function minPerfil() { return "MIN({$this->_pt()}.perfil)"; }
  public function maxPerfil() { return "MAX({$this->_pt()}.perfil)"; }
  public function countPerfil() { return "COUNT({$this->_pt()}.perfil)"; }

  public function label() {
    return "CONCAT_WS(' ', {$this->_pt()}.nombre)"; 
  }


}
