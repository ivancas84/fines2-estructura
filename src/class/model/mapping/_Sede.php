<?php
require_once("class/model/entityOptions/Mapping.php");

class _SedeMapping extends MappingEntityOptions{

  public function id() { return $this->_pt() . ".id"; }
  public function numero() { return $this->_pt() . ".numero"; }
  public function nombre() { return $this->_pt() . ".nombre"; }
  public function observaciones() { return $this->_pt() . ".observaciones"; }
  public function alta() { return $this->_pt() . ".alta"; }
  public function altaDate() { return "CAST({$this->_pt()}.alta AS DATE)"; }
  public function altaYm() { return "DATE_FORMAT({$this->_pt()}.alta, '%Y-%m')"; }
  public function altaY() { return "DATE_FORMAT({$this->_pt()}.alta, '%Y')"; }
  public function baja() { return $this->_pt() . ".baja"; }
  public function bajaDate() { return "CAST({$this->_pt()}.baja AS DATE)"; }
  public function bajaYm() { return "DATE_FORMAT({$this->_pt()}.baja, '%Y-%m')"; }
  public function bajaY() { return "DATE_FORMAT({$this->_pt()}.baja, '%Y')"; }
  public function domicilio() { return $this->_pt() . ".domicilio"; }
  public function tipoSede() { return $this->_pt() . ".tipo_sede"; }
  public function centroEducativo() { return $this->_pt() . ".centro_educativo"; }

  public function minId() { return "MIN({$this->_pt()}.id)"; }
  public function maxId() { return "MAX({$this->_pt()}.id)"; }
  public function countId() { return "COUNT({$this->_pt()}.id)"; }

  public function minNumero() { return "MIN({$this->_pt()}.numero)"; }
  public function maxNumero() { return "MAX({$this->_pt()}.numero)"; }
  public function countNumero() { return "COUNT({$this->_pt()}.numero)"; }

  public function minNombre() { return "MIN({$this->_pt()}.nombre)"; }
  public function maxNombre() { return "MAX({$this->_pt()}.nombre)"; }
  public function countNombre() { return "COUNT({$this->_pt()}.nombre)"; }

  public function minObservaciones() { return "MIN({$this->_pt()}.observaciones)"; }
  public function maxObservaciones() { return "MAX({$this->_pt()}.observaciones)"; }
  public function countObservaciones() { return "COUNT({$this->_pt()}.observaciones)"; }

  public function avgAlta() { return "AVG({$this->_pt()}.alta)"; }
  public function minAlta() { return "MIN({$this->_pt()}.alta)"; }
  public function maxAlta() { return "MAX({$this->_pt()}.alta)"; }
  public function countAlta() { return "COUNT({$this->_pt()}.alta)"; }

  public function avgBaja() { return "AVG({$this->_pt()}.baja)"; }
  public function minBaja() { return "MIN({$this->_pt()}.baja)"; }
  public function maxBaja() { return "MAX({$this->_pt()}.baja)"; }
  public function countBaja() { return "COUNT({$this->_pt()}.baja)"; }

  public function minDomicilio() { return "MIN({$this->_pt()}.domicilio)"; }
  public function maxDomicilio() { return "MAX({$this->_pt()}.domicilio)"; }
  public function countDomicilio() { return "COUNT({$this->_pt()}.domicilio)"; }

  public function minTipoSede() { return "MIN({$this->_pt()}.tipo_sede)"; }
  public function maxTipoSede() { return "MAX({$this->_pt()}.tipo_sede)"; }
  public function countTipoSede() { return "COUNT({$this->_pt()}.tipo_sede)"; }

  public function minCentroEducativo() { return "MIN({$this->_pt()}.centro_educativo)"; }
  public function maxCentroEducativo() { return "MAX({$this->_pt()}.centro_educativo)"; }
  public function countCentroEducativo() { return "COUNT({$this->_pt()}.centro_educativo)"; }

  public function label() {
    return "CONCAT_WS(' ', {$this->_pt()}.numero, 
{$this->_pt()}.nombre)"; 
  }


}
