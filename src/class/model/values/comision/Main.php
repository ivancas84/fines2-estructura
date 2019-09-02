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
    if(isset($row[$p."id"])) $this->setId($row[$p."id"]);
    if(isset($row[$p."anio"])) $this->setAnio($row[$p."anio"]);
    if(isset($row[$p."semestre"])) $this->setSemestre($row[$p."semestre"]);
    if(isset($row[$p."observaciones"])) $this->setObservaciones($row[$p."observaciones"]);
    if(isset($row[$p."fecha"])) $this->setFechaStr($row[$p."fecha"]);
    if(isset($row[$p."alta"])) $this->setAltaStr($row[$p."alta"]);
    if(isset($row[$p."baja"])) $this->setBajaStr($row[$p."baja"]);
    if(isset($row[$p."comentario"])) $this->setComentario($row[$p."comentario"]);
    if(isset($row[$p."autorizada"])) $this->setAutorizada($row[$p."autorizada"]);
    if(isset($row[$p."apertura"])) $this->setApertura($row[$p."apertura"]);
    if(isset($row[$p."publicar"])) $this->setPublicar($row[$p."publicar"]);
    if(isset($row[$p."fecha_anio"])) $this->setFechaAnioStr($row[$p."fecha_anio"]);
    if(isset($row[$p."fecha_semestre"])) $this->setFechaSemestre($row[$p."fecha_semestre"]);
    if(isset($row[$p."tramo"])) $this->setTramo($row[$p."tramo"]);
    if(isset($row[$p."horario"])) $this->setHorario($row[$p."horario"]);
    if(isset($row[$p."periodo"])) $this->setPeriodo($row[$p."periodo"]);
    if(isset($row[$p."comision_siguiente"])) $this->setComisionSiguiente($row[$p."comision_siguiente"]);
    if(isset($row[$p."division"])) $this->setDivision($row[$p."division"]);
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
    if($this->autorizada !== UNDEFINED) $row["autorizada"] = ($this->autorizada) ? true : false;        
    if($this->apertura !== UNDEFINED) $row["apertura"] = ($this->apertura) ? true : false;        
    if($this->publicar !== UNDEFINED) $row["publicar"] = ($this->publicar) ? true : false;        
    if($this->fechaAnio !== UNDEFINED) {
        if(empty($this->fechaAnio)) $row["fecha_anio"] = $this->fechaAnio;
        else $row["fecha_anio"] = $this->fechaAnio->format('Y');
      }
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
  public function alta($format = 'd/m/Y H:i:s') { return $this->formatDate($this->alta, $format); }
  public function baja($format = 'd/m/Y H:i:s') { return $this->formatDate($this->baja, $format); }
  public function comentario($format = null) { return $this->formatString($this->comentario, $format); }
  public function autorizada() { return ($this->autorizada) ? 'Sí' : 'No'; }
  public function apertura() { return ($this->apertura) ? 'Sí' : 'No'; }
  public function publicar() { return ($this->publicar) ? 'Sí' : 'No'; }
  public function fechaAnio($format = 'Y') { return $this->formatDate($this->fechaAnio, $format); }
  public function fechaSemestre() { return $this->fechaSemestre; }
  public function tramo($format = null) { return $this->formatString($this->tramo, $format); }
  public function horario($format = null) { return $this->formatString($this->horario, $format); }
  public function periodo($format = null) { return $this->formatString($this->periodo, $format); }
  public function comisionSiguiente() { return $this->comisionSiguiente; }
  public function division() { return $this->division; }
  public function setId($p) {
    $p = trim($p);
    $this->id = (empty($p)) ? null : (string)$p;
  }

  public function setAnio($p) {
    $p = trim($p);
    $this->anio = (is_null($p) && $p !== 0) ? null : intval($p);
  }
  public function setSemestre($p) {
    $p = trim($p);
    $this->semestre = (is_null($p) && $p !== 0) ? null : intval($p);
  }
  public function setObservaciones($p) {
    $p = trim($p);
    $this->observaciones = (empty($p)) ? null : (string)$p;
  }

  public function setFecha(DateTime $p = null) {
    $this->fecha = $p;
  }

  public function setFechaStr($p, $format = "Y-m-d") {
    $p = SpanishDateTime::createFromFormat($format, trim($p));
    $this->fecha = (empty($p)) ? null : $p;
  }

  public function setAlta(DateTime $p = null) {
    $this->alta = $p;
  }

  public function setAltaStr($p, $format = "Y-m-d H:i:s") {
    $p = SpanishDateTime::createFromFormat($format, trim($p));
    $this->alta = (empty($p)) ? null : $p;
  }

  public function setBaja(DateTime $p = null) {
    $this->baja = $p;
  }

  public function setBajaStr($p, $format = "Y-m-d H:i:s") {
    $p = SpanishDateTime::createFromFormat($format, trim($p));
    $this->baja = (empty($p)) ? null : $p;
  }

  public function setComentario($p) {
    $p = trim($p);
    $this->comentario = (empty($p)) ? null : (string)$p;
  }

  public function setAutorizada($p) {
    $p = trim($p);
    $this->autorizada = (is_null($p)) ? null : settypebool($p);
  }
  public function setApertura($p) {
    $p = trim($p);
    $this->apertura = (is_null($p)) ? null : settypebool($p);
  }
  public function setPublicar($p) {
    $p = trim($p);
    $this->publicar = (is_null($p)) ? null : settypebool($p);
  }
  public function setFechaAnio(DateTime $p = null) {
    $this->fechaAnio = $p;
  }

  public function setFechaAnioStr($p, $format = "Y") {
    $p = SpanishDateTime::createFromFormat($format, trim($p));
    $this->fechaAnio = (empty($p)) ? null : $p;
  }

  public function setFechaSemestre($p) {
    $p = trim($p);
    $this->fechaSemestre = (is_null($p) && $p !== 0) ? null : intval($p);
  }
  public function setTramo($p) {
    $p = trim($p);
    $this->tramo = (empty($p)) ? null : (string)$p;
  }

  public function setHorario($p) {
    $p = trim($p);
    $this->horario = (empty($p)) ? null : (string)$p;
  }

  public function setPeriodo($p) {
    $p = trim($p);
    $this->periodo = (empty($p)) ? null : (string)$p;
  }

  public function setComisionSiguiente($p) {
    $p = trim($p);
    $this->comisionSiguiente = (empty($p)) ? null : (string)$p;
  }

  public function setDivision($p) {
    $p = trim($p);
    $this->division = (empty($p)) ? null : (string)$p;
  }



}
