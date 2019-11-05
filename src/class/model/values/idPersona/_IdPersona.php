<?php

require_once("class/model/Values.php");

class _IdPersona extends EntityValues {
  public $id = UNDEFINED;
  public $nombres = UNDEFINED;
  public $apellidos = UNDEFINED;
  public $sobrenombre = UNDEFINED;
  public $fechaNacimiento = UNDEFINED;
  public $tipoDocumento = UNDEFINED;
  public $numeroDocumento = UNDEFINED;
  public $email = UNDEFINED;
  public $genero = UNDEFINED;
  public $cuil = UNDEFINED;
  public $alta = UNDEFINED;
  public $telefonos = UNDEFINED;

  public function _setDefault(){
    $this->setId(DEFAULT_VALUE);
    $this->setNombres(DEFAULT_VALUE);
    $this->setApellidos(DEFAULT_VALUE);
    $this->setSobrenombre(DEFAULT_VALUE);
    $this->setFechaNacimiento(DEFAULT_VALUE);
    $this->setTipoDocumento(DEFAULT_VALUE);
    $this->setNumeroDocumento(DEFAULT_VALUE);
    $this->setEmail(DEFAULT_VALUE);
    $this->setGenero(DEFAULT_VALUE);
    $this->setCuil(DEFAULT_VALUE);
    $this->setAlta(DEFAULT_VALUE);
    $this->setTelefonos(DEFAULT_VALUE);
  }

  public function _fromArray(array $row = NULL, $p = ""){
    if(empty($row)) return;
    if(isset($row[$p."id"])) $this->setId($row[$p."id"]);
    if(isset($row[$p."nombres"])) $this->setNombres($row[$p."nombres"]);
    if(isset($row[$p."apellidos"])) $this->setApellidos($row[$p."apellidos"]);
    if(isset($row[$p."sobrenombre"])) $this->setSobrenombre($row[$p."sobrenombre"]);
    if(isset($row[$p."fecha_nacimiento"])) $this->setFechaNacimiento($row[$p."fecha_nacimiento"]);
    if(isset($row[$p."tipo_documento"])) $this->setTipoDocumento($row[$p."tipo_documento"]);
    if(isset($row[$p."numero_documento"])) $this->setNumeroDocumento($row[$p."numero_documento"]);
    if(isset($row[$p."email"])) $this->setEmail($row[$p."email"]);
    if(isset($row[$p."genero"])) $this->setGenero($row[$p."genero"]);
    if(isset($row[$p."cuil"])) $this->setCuil($row[$p."cuil"]);
    if(isset($row[$p."alta"])) $this->setAlta($row[$p."alta"]);
    if(isset($row[$p."telefonos"])) $this->setTelefonos($row[$p."telefonos"]);
  }

  public function _toArray(){
    $row = [];
    if($this->id !== UNDEFINED) $row["id"] = $this->id();
    if($this->nombres !== UNDEFINED) $row["nombres"] = $this->nombres();
    if($this->apellidos !== UNDEFINED) $row["apellidos"] = $this->apellidos();
    if($this->sobrenombre !== UNDEFINED) $row["sobrenombre"] = $this->sobrenombre();
    if($this->fechaNacimiento !== UNDEFINED) $row["fecha_nacimiento"] = $this->fechaNacimiento();
    if($this->tipoDocumento !== UNDEFINED) $row["tipo_documento"] = $this->tipoDocumento();
    if($this->numeroDocumento !== UNDEFINED) $row["numero_documento"] = $this->numeroDocumento();
    if($this->email !== UNDEFINED) $row["email"] = $this->email();
    if($this->genero !== UNDEFINED) $row["genero"] = $this->genero();
    if($this->cuil !== UNDEFINED) $row["cuil"] = $this->cuil();
    if($this->alta !== UNDEFINED) $row["alta"] = $this->alta();
    if($this->telefonos !== UNDEFINED) $row["telefonos"] = $this->telefonos();
    return $row;
  }

  public function id() { return $this->id; }
  public function nombres($format = null) { return $this->_formatString($this->nombres, $format); }
  public function apellidos($format = null) { return $this->_formatString($this->apellidos, $format); }
  public function sobrenombre($format = null) { return $this->_formatString($this->sobrenombre, $format); }
  public function fechaNacimiento($format = 'Y-m-d') { return $this->_formatDate($this->fechaNacimiento, $format); }
  public function tipoDocumento($format = null) { return $this->_formatString($this->tipoDocumento, $format); }
  public function numeroDocumento($format = null) { return $this->_formatString($this->numeroDocumento, $format); }
  public function email($format = null) { return $this->_formatString($this->email, $format); }
  public function genero($format = null) { return $this->_formatString($this->genero, $format); }
  public function cuil($format = null) { return $this->_formatString($this->cuil, $format); }
  public function alta($format = 'Y-m-d H:i:s') { return $this->_formatDate($this->alta, $format); }
  public function telefonos($format = null) { return $this->_formatString($this->telefonos, $format); }
  public function setId($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $this->id = (empty($p)) ? null : (string)$p;
  }

  public function setNombres($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $this->nombres = (empty($p)) ? null : (string)$p;
  }

  public function setApellidos($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $this->apellidos = (empty($p)) ? null : (string)$p;
  }

  public function setSobrenombre($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $this->sobrenombre = (empty($p)) ? null : (string)$p;
  }

  public function _setFechaNacimiento(DateTime $p = null) {
    $this->fechaNacimiento = $p;
  }

  public function setFechaNacimiento($p, $format = "Y-m-d") {
    $p = ($p == DEFAULT_VALUE) ? '' : trim($p);
    $p = SpanishDateTime::createFromFormat($format, $p);
    $this->fechaNacimiento = (empty($p)) ? null : $p;
  }

  public function setTipoDocumento($p) {
    $p = ($p == DEFAULT_VALUE) ? 'DNI' : trim($p);
    $this->tipoDocumento = (empty($p)) ? null : (string)$p;
  }

  public function setNumeroDocumento($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $this->numeroDocumento = (empty($p)) ? null : (string)$p;
  }

  public function setEmail($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $this->email = (empty($p)) ? null : (string)$p;
  }

  public function setGenero($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $this->genero = (empty($p)) ? null : (string)$p;
  }

  public function setCuil($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $this->cuil = (empty($p)) ? null : (string)$p;
  }

  public function _setAlta(DateTime $p = null) {
    $this->alta = $p;
  }

  public function setAlta($p, $format = "Y-m-d H:i:s") {
    $p = ($p == DEFAULT_VALUE) ? date('Y-m-d H:i:s') : trim($p);
    $p = SpanishDateTime::createFromFormat($format, $p);
    $this->alta = (empty($p)) ? null : $p;
  }

  public function setTelefonos($p) {
    $p = ($p == DEFAULT_VALUE) ? null : trim($p);
    $this->telefonos = (empty($p)) ? null : (string)$p;
  }



}
