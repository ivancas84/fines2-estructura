<?php
require_once("class/model/entityOptions/FieldAlias.php");

class _PersonaFieldAlias extends FieldAliasEntityOptions{

  public function id() { return $this->mapping->id() . " AS " . $this->_pf() . "id"; }
  public function nombres() { return $this->mapping->nombres() . " AS " . $this->_pf() . "nombres"; }
  public function apellidos() { return $this->mapping->apellidos() . " AS " . $this->_pf() . "apellidos"; }
  public function fechaNacimiento() { return $this->mapping->fechaNacimiento() . " AS " . $this->_pf() . "fecha_nacimiento"; }
  public function numeroDocumento() { return $this->mapping->numeroDocumento() . " AS " . $this->_pf() . "numero_documento"; }
  public function cuil() { return $this->mapping->cuil() . " AS " . $this->_pf() . "cuil"; }
  public function genero() { return $this->mapping->genero() . " AS " . $this->_pf() . "genero"; }
  public function apodo() { return $this->mapping->apodo() . " AS " . $this->_pf() . "apodo"; }
  public function telefono() { return $this->mapping->telefono() . " AS " . $this->_pf() . "telefono"; }
  public function email() { return $this->mapping->email() . " AS " . $this->_pf() . "email"; }
  public function alta() { return $this->mapping->alta() . " AS " . $this->_pf() . "alta"; }
  public function altaDate() { return $this->mapping->altaDate() . " AS " . $this->_pf() . "alta_date"; }
  public function altaYm() { return $this->mapping->altaYm() . " AS " . $this->_pf() . "alta_ym"; }
  public function altaY() { return $this->mapping->altaY() . " AS " . $this->_pf() . "alta_y"; }
  public function domicilio() { return $this->mapping->domicilio() . " AS " . $this->_pf() . "domicilio"; }

  public function minId() { return $this->mapping->minId() . " AS " . $this->_pf() . "min_id"; }
  public function maxId() { return $this->mapping->maxId() . " AS " . $this->_pf() . "max_id"; }
  public function countId() { return $this->mapping->countId() . " AS " . $this->_pf() . "count_id"; }

  public function minNombres() { return $this->mapping->minNombres() . " AS " . $this->_pf() . "min_nombres"; }
  public function maxNombres() { return $this->mapping->maxNombres() . " AS " . $this->_pf() . "max_nombres"; }
  public function countNombres() { return $this->mapping->countNombres() . " AS " . $this->_pf() . "count_nombres"; }

  public function minApellidos() { return $this->mapping->minApellidos() . " AS " . $this->_pf() . "min_apellidos"; }
  public function maxApellidos() { return $this->mapping->maxApellidos() . " AS " . $this->_pf() . "max_apellidos"; }
  public function countApellidos() { return $this->mapping->countApellidos() . " AS " . $this->_pf() . "count_apellidos"; }

  public function avgFechaNacimiento() { return $this->mapping->avgFechaNacimiento() . " AS " . $this->_pf() . "avg_fecha_nacimiento"; }
  public function minFechaNacimiento() { return $this->mapping->minFechaNacimiento() . " AS " . $this->_pf() . "min_fecha_nacimiento"; }
  public function maxFechaNacimiento() { return $this->mapping->maxFechaNacimiento() . " AS " . $this->_pf() . "max_fecha_nacimiento"; }
  public function countFechaNacimiento() { return $this->mapping->countFechaNacimiento() . " AS " . $this->_pf() . "count_fecha_nacimiento"; }

  public function minNumeroDocumento() { return $this->mapping->minNumeroDocumento() . " AS " . $this->_pf() . "min_numero_documento"; }
  public function maxNumeroDocumento() { return $this->mapping->maxNumeroDocumento() . " AS " . $this->_pf() . "max_numero_documento"; }
  public function countNumeroDocumento() { return $this->mapping->countNumeroDocumento() . " AS " . $this->_pf() . "count_numero_documento"; }

  public function minCuil() { return $this->mapping->minCuil() . " AS " . $this->_pf() . "min_cuil"; }
  public function maxCuil() { return $this->mapping->maxCuil() . " AS " . $this->_pf() . "max_cuil"; }
  public function countCuil() { return $this->mapping->countCuil() . " AS " . $this->_pf() . "count_cuil"; }

  public function minGenero() { return $this->mapping->minGenero() . " AS " . $this->_pf() . "min_genero"; }
  public function maxGenero() { return $this->mapping->maxGenero() . " AS " . $this->_pf() . "max_genero"; }
  public function countGenero() { return $this->mapping->countGenero() . " AS " . $this->_pf() . "count_genero"; }

  public function minApodo() { return $this->mapping->minApodo() . " AS " . $this->_pf() . "min_apodo"; }
  public function maxApodo() { return $this->mapping->maxApodo() . " AS " . $this->_pf() . "max_apodo"; }
  public function countApodo() { return $this->mapping->countApodo() . " AS " . $this->_pf() . "count_apodo"; }

  public function minTelefono() { return $this->mapping->minTelefono() . " AS " . $this->_pf() . "min_telefono"; }
  public function maxTelefono() { return $this->mapping->maxTelefono() . " AS " . $this->_pf() . "max_telefono"; }
  public function countTelefono() { return $this->mapping->countTelefono() . " AS " . $this->_pf() . "count_telefono"; }

  public function minEmail() { return $this->mapping->minEmail() . " AS " . $this->_pf() . "min_email"; }
  public function maxEmail() { return $this->mapping->maxEmail() . " AS " . $this->_pf() . "max_email"; }
  public function countEmail() { return $this->mapping->countEmail() . " AS " . $this->_pf() . "count_email"; }

  public function avgAlta() { return $this->mapping->avgAlta() . " AS " . $this->_pf() . "avg_alta"; }
  public function minAlta() { return $this->mapping->minAlta() . " AS " . $this->_pf() . "min_alta"; }
  public function maxAlta() { return $this->mapping->maxAlta() . " AS " . $this->_pf() . "max_alta"; }
  public function countAlta() { return $this->mapping->countAlta() . " AS " . $this->_pf() . "count_alta"; }

  public function minDomicilio() { return $this->mapping->minDomicilio() . " AS " . $this->_pf() . "min_domicilio"; }
  public function maxDomicilio() { return $this->mapping->maxDomicilio() . " AS " . $this->_pf() . "max_domicilio"; }
  public function countDomicilio() { return $this->mapping->countDomicilio() . " AS " . $this->_pf() . "count_domicilio"; }

  public function label() { return $this->mapping->label() . " AS " . $this->_pf() . "label"; }



}
