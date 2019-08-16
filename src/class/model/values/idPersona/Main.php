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

  public function fromArray(array $row = NULL){
    if(empty($row)) return;
    if(isset($row["id"])) $this->id = (is_null($row["id"])) ? null : (string)$row["id"]; //los id siempre deben tratarse como string para evitar problemas de manejo de numero enteros
    if(isset($row["nombres"])) $this->nombres = (is_null($row["nombres"])) ? null : (string)$row["nombres"];
    if(isset($row["apellidos"])) $this->apellidos = (is_null($row["apellidos"])) ? null : (string)$row["apellidos"];
    if(isset($row["sobrenombre"])) $this->sobrenombre = (is_null($row["sobrenombre"])) ? null : (string)$row["sobrenombre"];
    if(isset($row["fecha_nacimiento"])) $this->fechaNacimiento = (is_null($row["fecha_nacimiento"])) ? null : DateTime::createFromFormat('Y-m-d', $row["fecha_nacimiento"]);
    if(isset($row["tipo_documento"])) $this->tipoDocumento = (is_null($row["tipo_documento"])) ? null : (string)$row["tipo_documento"];
    if(isset($row["numero_documento"])) $this->numeroDocumento = (is_null($row["numero_documento"])) ? null : (string)$row["numero_documento"];
    if(isset($row["email"])) $this->email = (is_null($row["email"])) ? null : (string)$row["email"];
    if(isset($row["genero"])) $this->genero = (is_null($row["genero"])) ? null : (string)$row["genero"];
    if(isset($row["cuil"])) $this->cuil = (is_null($row["cuil"])) ? null : (string)$row["cuil"];
    if(isset($row["alta"])) $this->alta = (is_null($row["alta"])) ? null : DateTime::createFromFormat('Y-m-d H:i:s', $row["alta"]);
    if(isset($row["telefonos"])) $this->telefonos = (is_null($row["telefonos"])) ? null : (string)$row["telefonos"];
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
  public function alta($format = 'd/m/Y H:i') { return $this->formatDate($this->alta, $format); }
  public function telefonos($format = null) { return $this->formatString($this->telefonos, $format); }
  public function setId($p) {
    if(empty($p)) return;
    $this->id = trim($p);
  }

  public function setNombres($p) {
    if(empty($p)) return;
    $this->nombres = trim($p);
  }

  public function setApellidos($p) {
    if(empty($p)) return;
    $this->apellidos = trim($p);
  }

  public function setSobrenombre($p) {
    if(empty($p)) return;
    $this->sobrenombre = trim($p);
  }

  public function setFechaNacimiento($p) {
    if(empty($p)) return;
    $this->fechaNacimiento = trim($p);
  }

  public function setTipoDocumento($p) {
    if(empty($p)) return;
    $this->tipoDocumento = trim($p);
  }

  public function setNumeroDocumento($p) {
    if(empty($p)) return;
    $this->numeroDocumento = trim($p);
  }

  public function setEmail($p) {
    if(empty($p)) return;
    $this->email = trim($p);
  }

  public function setGenero($p) {
    if(empty($p)) return;
    $this->genero = trim($p);
  }

  public function setCuil($p) {
    if(empty($p)) return;
    $this->cuil = trim($p);
  }

  public function setAlta($p) {
    if(empty($p)) return;
    $this->alta = trim($p);
  }

  public function setTelefonos($p) {
    if(empty($p)) return;
    $this->telefonos = trim($p);
  }



}
