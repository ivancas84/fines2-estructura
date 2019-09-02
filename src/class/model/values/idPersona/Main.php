<?php

require_once("class/model/Values.php");

//Implementacion principal de Values para una entidad especifica
class IdPersonaValuesMain extends EntityValues {
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

  public function setDefault(){
    $this->id = null;
    $this->nombres = null;
    $this->apellidos = null;
    $this->sobrenombre = null;
    $this->fechaNacimiento = null;
    $this->tipoDocumento = "DNI";
    $this->numeroDocumento = null;
    $this->email = null;
    $this->genero = null;
    $this->cuil = null;
    $this->alta = new DateTime();
    $this->telefonos = null;
  }

  public function fromArray(array $row = NULL, $p = ""){
    if(empty($row)) return;
    if(isset($row[$p."id"])) $this->setId($row[$p."id"]);
    if(isset($row[$p."nombres"])) $this->setNombres($row[$p."nombres"]);
    if(isset($row[$p."apellidos"])) $this->setApellidos($row[$p."apellidos"]);
    if(isset($row[$p."sobrenombre"])) $this->setSobrenombre($row[$p."sobrenombre"]);
    if(isset($row[$p."fecha_nacimiento"])) $this->setFechaNacimientoStr($row[$p."fecha_nacimiento"]);
    if(isset($row[$p."tipo_documento"])) $this->setTipoDocumento($row[$p."tipo_documento"]);
    if(isset($row[$p."numero_documento"])) $this->setNumeroDocumento($row[$p."numero_documento"]);
    if(isset($row[$p."email"])) $this->setEmail($row[$p."email"]);
    if(isset($row[$p."genero"])) $this->setGenero($row[$p."genero"]);
    if(isset($row[$p."cuil"])) $this->setCuil($row[$p."cuil"]);
    if(isset($row[$p."alta"])) $this->setAltaStr($row[$p."alta"]);
    if(isset($row[$p."telefonos"])) $this->setTelefonos($row[$p."telefonos"]);
  }

  public function toArray(){
    $row = [];
    if($this->id !== UNDEFINED) $row["id"] = $this->id;
    if($this->nombres !== UNDEFINED) $row["nombres"] = $this->nombres;
    if($this->apellidos !== UNDEFINED) $row["apellidos"] = $this->apellidos;
    if($this->sobrenombre !== UNDEFINED) $row["sobrenombre"] = $this->sobrenombre;
    if($this->fechaNacimiento !== UNDEFINED) {
        if(empty($this->fechaNacimiento)) $row["fecha_nacimiento"] = $this->fechaNacimiento;
        else $row["fecha_nacimiento"] = $this->fechaNacimiento->format('Y-m-d');
      }
    if($this->tipoDocumento !== UNDEFINED) $row["tipo_documento"] = $this->tipoDocumento;
    if($this->numeroDocumento !== UNDEFINED) $row["numero_documento"] = $this->numeroDocumento;
    if($this->email !== UNDEFINED) $row["email"] = $this->email;
    if($this->genero !== UNDEFINED) $row["genero"] = $this->genero;
    if($this->cuil !== UNDEFINED) $row["cuil"] = $this->cuil;
    if($this->alta !== UNDEFINED) {
        if(empty($this->alta)) $row["alta"] = $this->alta;
        else $row["alta"] = $this->alta->format('Y-m-d H:i:s');
      }
    if($this->telefonos !== UNDEFINED) $row["telefonos"] = $this->telefonos;
    return $row;
  }

  public function id() { return $this->id; }
  public function nombres($format = null) { return $this->formatString($this->nombres, $format); }
  public function apellidos($format = null) { return $this->formatString($this->apellidos, $format); }
  public function sobrenombre($format = null) { return $this->formatString($this->sobrenombre, $format); }
  public function fechaNacimiento($format = 'd/m/Y') { return $this->formatDate($this->fechaNacimiento, $format); }
  public function tipoDocumento($format = null) { return $this->formatString($this->tipoDocumento, $format); }
  public function numeroDocumento($format = null) { return $this->formatString($this->numeroDocumento, $format); }
  public function email($format = null) { return $this->formatString($this->email, $format); }
  public function genero($format = null) { return $this->formatString($this->genero, $format); }
  public function cuil($format = null) { return $this->formatString($this->cuil, $format); }
  public function alta($format = 'd/m/Y H:i:s') { return $this->formatDate($this->alta, $format); }
  public function telefonos($format = null) { return $this->formatString($this->telefonos, $format); }
  public function setId($p) {
    $p = trim($p);
    $this->id = (empty($p)) ? null : (string)$p;
  }

  public function setNombres($p) {
    $p = trim($p);
    $this->nombres = (empty($p)) ? null : (string)$p;
  }

  public function setApellidos($p) {
    $p = trim($p);
    $this->apellidos = (empty($p)) ? null : (string)$p;
  }

  public function setSobrenombre($p) {
    $p = trim($p);
    $this->sobrenombre = (empty($p)) ? null : (string)$p;
  }

  public function setFechaNacimiento(DateTime $p = null) {
    $this->fechaNacimiento = $p;
  }

  public function setFechaNacimientoStr($p, $format = "Y-m-d") {
    $p = SpanishDateTime::createFromFormat($format, trim($p));
    $this->fechaNacimiento = (empty($p)) ? null : $p;
  }

  public function setTipoDocumento($p) {
    $p = trim($p);
    $this->tipoDocumento = (empty($p)) ? null : (string)$p;
  }

  public function setNumeroDocumento($p) {
    $p = trim($p);
    $this->numeroDocumento = (empty($p)) ? null : (string)$p;
  }

  public function setEmail($p) {
    $p = trim($p);
    $this->email = (empty($p)) ? null : (string)$p;
  }

  public function setGenero($p) {
    $p = trim($p);
    $this->genero = (empty($p)) ? null : (string)$p;
  }

  public function setCuil($p) {
    $p = trim($p);
    $this->cuil = (empty($p)) ? null : (string)$p;
  }

  public function setAlta(DateTime $p = null) {
    $this->alta = $p;
  }

  public function setAltaStr($p, $format = "Y-m-d H:i:s") {
    $p = SpanishDateTime::createFromFormat($format, trim($p));
    $this->alta = (empty($p)) ? null : $p;
  }

  public function setTelefonos($p) {
    $p = trim($p);
    $this->telefonos = (empty($p)) ? null : (string)$p;
  }



}
