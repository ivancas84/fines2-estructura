<?php

require_once("class/model/Values.php");

//Implementacion principal de Values para una entidad especifica
class ComisionValuesMain extends EntityValues {
  public $id = UNDEFINED;
  public $anio = UNDEFINED;
  public $semestre = UNDEFINED;
  public $observaciones = UNDEFINED;
  public $fecha = UNDEFINED;
  public $alta = UNDEFINED;
  public $baja = UNDEFINED;
  public $comentario = UNDEFINED;
  public $autorizada = UNDEFINED;
  public $apertura = UNDEFINED;
  public $publicar = UNDEFINED;
  public $fechaAnio = UNDEFINED;
  public $fechaSemestre = UNDEFINED;
  public $tramo = UNDEFINED;
  public $horario = UNDEFINED;
  public $periodo = UNDEFINED;
  public $comisionSiguiente = UNDEFINED;
  public $division = UNDEFINED;

  public function setDefault(){
    $this->id = null;
    $this->anio = null;
    $this->semestre = null;
    $this->observaciones = null;
    $this->fecha = null;
    $this->alta = new DateTime();
    $this->baja = null;
    $this->comentario = null;
    $this->autorizada = null;
    $this->apertura = null;
    $this->publicar = null;
    $this->fechaAnio = null;
    $this->fechaSemestre = null;
    $this->tramo = null;
    $this->horario = null;
    $this->periodo = null;
    $this->comisionSiguiente = null;
    $this->division = null;
  }

  public function fromArray(array $row = NULL, $p = ""){
    if(empty($row)) return;
    if(isset($row[$p."id"])) $this->id = (is_null($row[$p."id"])) ? null : (string)$row[$p."id"]; //los id siempre deben tratarse como string para evitar problemas de manejo de numero enteros
    if(isset($row[$p."anio"])) $this->anio = (is_null($row[$p."anio"])) ? null : intval($row[$p."anio"]);
    if(isset($row[$p."semestre"])) $this->semestre = (is_null($row[$p."semestre"])) ? null : intval($row[$p."semestre"]);
    if(isset($row[$p."observaciones"])) $this->observaciones = (is_null($row[$p."observaciones"])) ? null : (string)$row[$p."observaciones"];
    if(isset($row[$p."fecha"])) $this->fecha = (is_null($row[$p."fecha"])) ? null : DateTime::createFromFormat('Y-m-d', $row[$p."fecha"]);
    if(isset($row[$p."alta"])) $this->alta = (is_null($row[$p."alta"])) ? null : DateTime::createFromFormat('Y-m-d H:i:s', $row[$p."alta"]);
    if(isset($row[$p."baja"])) $this->baja = (is_null($row[$p."baja"])) ? null : DateTime::createFromFormat('Y-m-d H:i:s', $row[$p."baja"]);
    if(isset($row[$p."comentario"])) $this->comentario = (is_null($row[$p."comentario"])) ? null : (string)$row[$p."comentario"];
    if(isset($row[$p."autorizada"])) $this->autorizada = (is_null($row[$p."autorizada"])) ? null : settypebool($row[$p."autorizada"]);
    if(isset($row[$p."apertura"])) $this->apertura = (is_null($row[$p."apertura"])) ? null : settypebool($row[$p."apertura"]);
    if(isset($row[$p."publicar"])) $this->publicar = (is_null($row[$p."publicar"])) ? null : settypebool($row[$p."publicar"]);
    if(isset($row[$p."fecha_anio"])) $this->fechaAnio = (is_null($row[$p."fecha_anio"])) ? null : (string)$row[$p."fecha_anio"];
    if(isset($row[$p."fecha_semestre"])) $this->fechaSemestre = (is_null($row[$p."fecha_semestre"])) ? null : intval($row[$p."fecha_semestre"]);
    if(isset($row[$p."tramo"])) $this->tramo = (is_null($row[$p."tramo"])) ? null : (string)$row[$p."tramo"];
    if(isset($row[$p."horario"])) $this->horario = (is_null($row[$p."horario"])) ? null : (string)$row[$p."horario"];
    if(isset($row[$p."periodo"])) $this->periodo = (is_null($row[$p."periodo"])) ? null : (string)$row[$p."periodo"];
    if(isset($row[$p."comision_siguiente"])) $this->comisionSiguiente = (is_null($row[$p."comision_siguiente"])) ? null : (string)$row[$p."comision_siguiente"]; //los id siempre deben tratarse como string para evitar problemas de manejo de numero enteros
    if(isset($row[$p."division"])) $this->division = (is_null($row[$p."division"])) ? null : (string)$row[$p."division"]; //los id siempre deben tratarse como string para evitar problemas de manejo de numero enteros
  }

  public function toArray(){
    $row = [];
    if($this->id !== UNDEFINED) $row["id"] = $this->id;
    if($this->anio !== UNDEFINED) $row["anio"] = $this->anio;
    if($this->semestre !== UNDEFINED) $row["semestre"] = $this->semestre;
    if($this->observaciones !== UNDEFINED) $row["observaciones"] = $this->observaciones;
    if($this->fecha !== UNDEFINED) {
      if(empty($this->fecha)) $row["fecha"] = $this->fecha;
      else $row["fecha"] = $this->fecha->format('Y-m-d');
    }
    if($this->alta !== UNDEFINED) {
      if(empty($this->alta)) $row["alta"] = $this->alta;
      else $row["alta"] = $this->alta->format('Y-m-d H:i:s');
    }
    if($this->baja !== UNDEFINED) {
      if(empty($this->baja)) $row["baja"] = $this->baja;
      else $row["baja"] = $this->baja->format('Y-m-d H:i:s');
    }
    if($this->comentario !== UNDEFINED) $row["comentario"] = $this->comentario;
    if($this->autorizada !== UNDEFINED) $row["autorizada"] = ($this->autorizada) ? "true" : "false";        
    if($this->apertura !== UNDEFINED) $row["apertura"] = ($this->apertura) ? "true" : "false";        
    if($this->publicar !== UNDEFINED) $row["publicar"] = ($this->publicar) ? "true" : "false";        
    if($this->fechaAnio !== UNDEFINED) $row["fecha_anio"] = $this->fechaAnio;
    if($this->fechaSemestre !== UNDEFINED) $row["fecha_semestre"] = $this->fechaSemestre;
    if($this->tramo !== UNDEFINED) $row["tramo"] = $this->tramo;
    if($this->horario !== UNDEFINED) $row["horario"] = $this->horario;
    if($this->periodo !== UNDEFINED) $row["periodo"] = $this->periodo;
    if($this->comisionSiguiente !== UNDEFINED) $row["comision_siguiente"] = $this->comisionSiguiente;
    if($this->division !== UNDEFINED) $row["division"] = $this->division;
    return $row;
  }

  public function id() { return $this->id; }
  public function anio() { return $this->anio; }
  public function semestre() { return $this->semestre; }
  public function observaciones($format = null) { return $this->formatString($this->observaciones, $format); }
  public function fecha($format = 'd/m/Y') { return $this->formatDate($this->fecha, $format); }
  public function alta($format = 'd/m/Y H:i') { return $this->formatDate($this->alta, $format); }
  public function baja($format = 'd/m/Y H:i') { return $this->formatDate($this->baja, $format); }
  public function comentario($format = null) { return $this->formatString($this->comentario, $format); }
  public function autorizada() { return ($this->autorizada) ? 'Sí' : 'No'; }
  public function apertura() { return ($this->apertura) ? 'Sí' : 'No'; }
  public function publicar() { return ($this->publicar) ? 'Sí' : 'No'; }
  public function fechaAnio() { return $this->fechaAnio; }
  public function fechaSemestre() { return $this->fechaSemestre; }
  public function tramo($format = null) { return $this->formatString($this->tramo, $format); }
  public function horario($format = null) { return $this->formatString($this->horario, $format); }
  public function periodo($format = null) { return $this->formatString($this->periodo, $format); }
  public function comisionSiguiente() { return $this->comisionSiguiente; }
  public function division() { return $this->division; }
  public function setId($p) {
    if(empty($p)) return;
    $this->id = trim($p);
  }

  public function setAnio($p) {
    if(empty($p) && $p !== 0) return;
    $this->anio = intval(trim($p));
  }

  public function setSemestre($p) {
    if(empty($p) && $p !== 0) return;
    $this->semestre = intval(trim($p));
  }

  public function setObservaciones($p) {
    if(empty($p)) return;
    $this->observaciones = trim($p);
  }

  public function setFecha(DateTime $p) {
    if(empty($p)) return;
    $this->fecha = $p;
  }

  public function setFechaStr($p, $format = "Y-m-d") {
    $p = SpanishDateTime::createFromFormat($format, trim($p));
    if(empty($p)) return;
    $this->fecha = $p;
  }

  public function setAlta(DateTime $p) {
    if(empty($p)) return;
    $this->alta = $p;
  }

  public function setAltaStr($p, $format = "Y-m-d H:i:s") {
    $p = SpanishDateTime::createFromFormat($format, trim($p));
    if(empty($p)) return;
    $this->alta = $p;
  }

  public function setBaja(DateTime $p) {
    if(empty($p)) return;
    $this->baja = $p;
  }

  public function setBajaStr($p, $format = "Y-m-d H:i:s") {
    $p = SpanishDateTime::createFromFormat($format, trim($p));
    if(empty($p)) return;
    $this->baja = $p;
  }

  public function setComentario($p) {
    if(empty($p)) return;
    $this->comentario = trim($p);
  }

  public function setAutorizada($p) {
    $this->autorizada = settypebool(trim($p));
  }

  public function setApertura($p) {
    $this->apertura = settypebool(trim($p));
  }

  public function setPublicar($p) {
    $this->publicar = settypebool(trim($p));
  }

  public function setFechaAnio($p) {
    if(empty($p)) return;
    $this->fechaAnio = trim($p);
  }

  public function setFechaSemestre($p) {
    if(empty($p) && $p !== 0) return;
    $this->fechaSemestre = intval(trim($p));
  }

  public function setTramo($p) {
    if(empty($p)) return;
    $this->tramo = trim($p);
  }

  public function setHorario($p) {
    if(empty($p)) return;
    $this->horario = trim($p);
  }

  public function setPeriodo($p) {
    if(empty($p)) return;
    $this->periodo = trim($p);
  }

  public function setComisionSiguiente($p) {
    if(empty($p) && $p !== 0) return;
    $this->comisionSiguiente = intval(trim($p));
  }

  public function setDivision($p) {
    if(empty($p) && $p !== 0) return;
    $this->division = intval(trim($p));
  }



}
