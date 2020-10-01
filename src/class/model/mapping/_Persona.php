<?php
require_once("class/model/entityOptions/Mapping.php");

class _PersonaMapping extends MappingEntityOptions{

  public function id() { return $this->_pt() . ".id"; }
  public function nombres() { return $this->_pt() . ".nombres"; }
  public function apellidos() { return $this->_pt() . ".apellidos"; }
  public function fechaNacimiento() { return $this->_pt() . ".fecha_nacimiento"; }
  public function numeroDocumento() { return $this->_pt() . ".numero_documento"; }
  public function cuil() { return $this->_pt() . ".cuil"; }
  public function genero() { return $this->_pt() . ".genero"; }
  public function apodo() { return $this->_pt() . ".apodo"; }
  public function telefono() { return $this->_pt() . ".telefono"; }
  public function email() { return $this->_pt() . ".email"; }
  public function emailAbc() { return $this->_pt() . ".email_abc"; }
  public function alta() { return $this->_pt() . ".alta"; }
  public function altaDate() { return "CAST({$this->_pt()}.alta AS DATE)"; }
  public function altaYm() { return "DATE_FORMAT({$this->_pt()}.alta, '%Y-%m')"; }
  public function altaY() { return "DATE_FORMAT({$this->_pt()}.alta, '%Y')"; }
  public function domicilio() { return $this->_pt() . ".domicilio"; }

  public function minId() { return "MIN({$this->_pt()}.id)"; }
  public function maxId() { return "MAX({$this->_pt()}.id)"; }
  public function countId() { return "COUNT({$this->_pt()}.id)"; }

  public function minNombres() { return "MIN({$this->_pt()}.nombres)"; }
  public function maxNombres() { return "MAX({$this->_pt()}.nombres)"; }
  public function countNombres() { return "COUNT({$this->_pt()}.nombres)"; }

  public function minApellidos() { return "MIN({$this->_pt()}.apellidos)"; }
  public function maxApellidos() { return "MAX({$this->_pt()}.apellidos)"; }
  public function countApellidos() { return "COUNT({$this->_pt()}.apellidos)"; }

  public function avgFechaNacimiento() { return "AVG({$this->_pt()}.fecha_nacimiento)"; }
  public function minFechaNacimiento() { return "MIN({$this->_pt()}.fecha_nacimiento)"; }
  public function maxFechaNacimiento() { return "MAX({$this->_pt()}.fecha_nacimiento)"; }
  public function countFechaNacimiento() { return "COUNT({$this->_pt()}.fecha_nacimiento)"; }

  public function minNumeroDocumento() { return "MIN({$this->_pt()}.numero_documento)"; }
  public function maxNumeroDocumento() { return "MAX({$this->_pt()}.numero_documento)"; }
  public function countNumeroDocumento() { return "COUNT({$this->_pt()}.numero_documento)"; }

  public function minCuil() { return "MIN({$this->_pt()}.cuil)"; }
  public function maxCuil() { return "MAX({$this->_pt()}.cuil)"; }
  public function countCuil() { return "COUNT({$this->_pt()}.cuil)"; }

  public function minGenero() { return "MIN({$this->_pt()}.genero)"; }
  public function maxGenero() { return "MAX({$this->_pt()}.genero)"; }
  public function countGenero() { return "COUNT({$this->_pt()}.genero)"; }

  public function minApodo() { return "MIN({$this->_pt()}.apodo)"; }
  public function maxApodo() { return "MAX({$this->_pt()}.apodo)"; }
  public function countApodo() { return "COUNT({$this->_pt()}.apodo)"; }

  public function minTelefono() { return "MIN({$this->_pt()}.telefono)"; }
  public function maxTelefono() { return "MAX({$this->_pt()}.telefono)"; }
  public function countTelefono() { return "COUNT({$this->_pt()}.telefono)"; }

  public function minEmail() { return "MIN({$this->_pt()}.email)"; }
  public function maxEmail() { return "MAX({$this->_pt()}.email)"; }
  public function countEmail() { return "COUNT({$this->_pt()}.email)"; }

  public function minEmailAbc() { return "MIN({$this->_pt()}.email_abc)"; }
  public function maxEmailAbc() { return "MAX({$this->_pt()}.email_abc)"; }
  public function countEmailAbc() { return "COUNT({$this->_pt()}.email_abc)"; }

  public function avgAlta() { return "AVG({$this->_pt()}.alta)"; }
  public function minAlta() { return "MIN({$this->_pt()}.alta)"; }
  public function maxAlta() { return "MAX({$this->_pt()}.alta)"; }
  public function countAlta() { return "COUNT({$this->_pt()}.alta)"; }

  public function minDomicilio() { return "MIN({$this->_pt()}.domicilio)"; }
  public function maxDomicilio() { return "MAX({$this->_pt()}.domicilio)"; }
  public function countDomicilio() { return "COUNT({$this->_pt()}.domicilio)"; }

  public function label() {
    return "CONCAT_WS(' ', {$this->_pt()}.nombres, 
{$this->_pt()}.apellidos, 
{$this->_pt()}.numero_documento)"; 
  }


}
