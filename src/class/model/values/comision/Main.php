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

  public function fromArray(array $row = NULL){
    if(empty($row)) return;
    if(isset($row["id"])) $this->id = (is_null($row["id"])) ? null : (string)$row["id"]; //los id siempre deben tratarse como string para evitar problemas de manejo de numero enteros
    if(isset($row["anio"])) $this->anio = (is_null($row["anio"])) ? null : intval($row["anio"]);
    if(isset($row["semestre"])) $this->semestre = (is_null($row["semestre"])) ? null : intval($row["semestre"]);
    if(isset($row["observaciones"])) $this->observaciones = (is_null($row["observaciones"])) ? null : (string)$row["observaciones"];
    if(isset($row["fecha"])) $this->fecha = (is_null($row["fecha"])) ? null : DateTime::createFromFormat('Y-m-d', $row["fecha"]);
    if(isset($row["alta"])) $this->alta = (is_null($row["alta"])) ? null : DateTime::createFromFormat('Y-m-d H:i:s', $row["alta"]);
    if(isset($row["baja"])) $this->baja = (is_null($row["baja"])) ? null : DateTime::createFromFormat('Y-m-d H:i:s', $row["baja"]);
    if(isset($row["comentario"])) $this->comentario = (is_null($row["comentario"])) ? null : (string)$row["comentario"];
    if(isset($row["autorizada"])) $this->autorizada = (is_null($row["autorizada"])) ? null : settypebool($row["autorizada"]);
    if(isset($row["apertura"])) $this->apertura = (is_null($row["apertura"])) ? null : settypebool($row["apertura"]);
    if(isset($row["publicar"])) $this->publicar = (is_null($row["publicar"])) ? null : settypebool($row["publicar"]);
    if(isset($row["fecha_anio"])) $this->fechaAnio = (is_null($row["fecha_anio"])) ? null : (string)$row["fecha_anio"];
    if(isset($row["fecha_semestre"])) $this->fechaSemestre = (is_null($row["fecha_semestre"])) ? null : intval($row["fecha_semestre"]);
    if(isset($row["tramo"])) $this->tramo = (is_null($row["tramo"])) ? null : (string)$row["tramo"];
    if(isset($row["horario"])) $this->horario = (is_null($row["horario"])) ? null : (string)$row["horario"];
    if(isset($row["periodo"])) $this->periodo = (is_null($row["periodo"])) ? null : (string)$row["periodo"];
    if(isset($row["comision_siguiente"])) $this->comisionSiguiente = (is_null($row["comision_siguiente"])) ? null : (string)$row["comision_siguiente"]; //los id siempre deben tratarse como string para evitar problemas de manejo de numero enteros
    if(isset($row["division"])) $this->division = (is_null($row["division"])) ? null : (string)$row["division"]; //los id siempre deben tratarse como string para evitar problemas de manejo de numero enteros
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
    $this->id = $p;
  }

  public function setAnio($p) {
    if(empty($p) && $p !== 0) return;
    $this->anio = intval($p);
  }

  public function setSemestre($p) {
    if(empty($p) && $p !== 0) return;
    $this->semestre = intval($p);
  }

  public function setObservaciones($p) {
    if(empty($p)) return;
    $this->observaciones = $p;
  }

  public function setFecha($p) {
    if(empty($p)) return;
    $this->fecha = $p;
  }

  public function setAlta($p) {
    if(empty($p)) return;
    $this->alta = $p;
  }

  public function setBaja($p) {
    if(empty($p)) return;
    $this->baja = $p;
  }

  public function setComentario($p) {
    if(empty($p)) return;
    $this->comentario = $p;
  }

  public function setAutorizada($p) {
    $this->autorizada = settypebool($p);
  }

  public function setApertura($p) {
    $this->apertura = settypebool($p);
  }

  public function setPublicar($p) {
    $this->publicar = settypebool($p);
  }

  public function setFechaAnio($p) {
    if(empty($p)) return;
    $this->fechaAnio = $p;
  }

  public function setFechaSemestre($p) {
    if(empty($p) && $p !== 0) return;
    $this->fechaSemestre = intval($p);
  }

  public function setTramo($p) {
    if(empty($p)) return;
    $this->tramo = $p;
  }

  public function setHorario($p) {
    if(empty($p)) return;
    $this->horario = $p;
  }

  public function setPeriodo($p) {
    if(empty($p)) return;
    $this->periodo = $p;
  }

  public function setComisionSiguiente($p) {
    if(empty($p) && $p !== 0) return;
    $this->comisionSiguiente = intval($p);
  }

  public function setDivision($p) {
    if(empty($p) && $p !== 0) return;
    $this->division = intval($p);
  }



}
