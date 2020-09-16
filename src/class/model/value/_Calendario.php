<?php
require_once("class/model/entityOptions/Value.php");

class _CalendarioValue extends ValueEntityOptions{

  protected $id = UNDEFINED;
  protected $inicio = UNDEFINED;
  protected $fin = UNDEFINED;
  protected $anio = UNDEFINED;
  protected $semestre = UNDEFINED;
  protected $insertado = UNDEFINED;

  public function setDefaultId() { if($this->id === UNDEFINED) $this->setId(uniqid()); }
  public function setDefaultInicio() { if($this->inicio === UNDEFINED) $this->setInicio(null); }
  public function setDefaultFin() { if($this->fin === UNDEFINED) $this->setFin(null); }
  public function setDefaultAnio() { if($this->anio === UNDEFINED) $this->setAnio(null); }
  public function setDefaultSemestre() { if($this->semestre === UNDEFINED) $this->setSemestre(null); }
  public function setDefaultInsertado() { if($this->insertado === UNDEFINED) $this->setInsertado(date('c')); }

  public function isEmptyId() { if(!Validation::is_empty($this->id)) return false; }
  public function isEmptyInicio() { if(!Validation::is_empty($this->inicio)) return false; }
  public function isEmptyFin() { if(!Validation::is_empty($this->fin)) return false; }
  public function isEmptyAnio() { if(!Validation::is_empty($this->anio)) return false; }
  public function isEmptySemestre() { if(!Validation::is_empty($this->semestre)) return false; }
  public function isEmptyInsertado() { if(!Validation::is_empty($this->insertado)) return false; }

  public function id() { return $this->id; }
  public function inicio($format = null) { return Format::date($this->inicio, $format); }
  public function fin($format = null) { return Format::date($this->fin, $format); }
  public function anio($format = null) { return Format::date($this->anio, $format); }
  public function semestre() { return $this->semestre; }
  public function insertado($format = null) { return Format::date($this->insertado, $format); }

  public function _setId(string $p = null) { return $this->id = $p; }  
  public function setId($p) { return $this->id = (is_null($p)) ? null : (string)$p; }

  public function _setInicio(DateTime $p = null) { return $this->inicio = $p; }  

  public function setInicio($p) {
    if(!is_null($p) && !($p instanceof DateTime)) $p = new SpanishDateTime($p);
    if($p instanceof DateTime) $p->setTimeZone(new DateTimeZone(date_default_timezone_get()));
    return $this->inicio = $p;
  }

  public function setInicioY($p) {
    if(!is_null($p) && !($p instanceof DateTime)) {
      $p = (strlen($p) == 4) ? SpanishDateTime::createFromFormat('Y', $p) : new SpanishDateTime($p);
    }
    if($p instanceof DateTime) $p->setTimeZone(new DateTimeZone(date_default_timezone_get()));
    return $this->inicio = $p;
  }

  public function _setFin(DateTime $p = null) { return $this->fin = $p; }  

  public function setFin($p) {
    if(!is_null($p) && !($p instanceof DateTime)) $p = new SpanishDateTime($p);
    if($p instanceof DateTime) $p->setTimeZone(new DateTimeZone(date_default_timezone_get()));
    return $this->fin = $p;
  }

  public function setFinY($p) {
    if(!is_null($p) && !($p instanceof DateTime)) {
      $p = (strlen($p) == 4) ? SpanishDateTime::createFromFormat('Y', $p) : new SpanishDateTime($p);
    }
    if($p instanceof DateTime) $p->setTimeZone(new DateTimeZone(date_default_timezone_get()));
    return $this->fin = $p;
  }

  public function _setAnio(DateTime $p = null) { return $this->anio = $p; }  

  public function setAnio($p) {
    if(!is_null($p) && !($p instanceof DateTime)) {
      $p = (strlen($p) == 4) ? SpanishDateTime::createFromFormat('Y', $p) : new SpanishDateTime($p);
    }
    if($p instanceof DateTime) $p->setTimeZone(new DateTimeZone(date_default_timezone_get()));
    return $this->anio = $p;
  }

  public function _setSemestre(integer $p = null) { return $this->semestre = $p; }    
  public function setSemestre($p) { return $this->semestre = (is_null($p)) ? null : intval($p); }

  public function _setInsertado(DateTime $p = null) { return $this->insertado = $p; }  

  public function setInsertado($p) {
    if(!is_null($p) && !($p instanceof DateTime)) $p = new SpanishDateTime($p);
    if($p instanceof DateTime) $p->setTimeZone(new DateTimeZone(date_default_timezone_get()));
    return $this->insertado = $p;
  }

  public function setInsertadoY($p) {
    if(!is_null($p) && !($p instanceof DateTime)) {
      $p = (strlen($p) == 4) ? SpanishDateTime::createFromFormat('Y', $p) : new SpanishDateTime($p);
    }
    if($p instanceof DateTime) $p->setTimeZone(new DateTimeZone(date_default_timezone_get()));
    return $this->insertado = $p;
  }


  public function checkId() { 
      if(Validation::is_undefined($this->id)) return null;
      return true; 
  }

  public function checkInicio() { 
      $this->_logs->resetLogs("inicio");
      if(Validation::is_undefined($this->inicio)) return null;
      $v = Validation::getInstanceValue($this->inicio)->isA('DateTime');
      foreach($v->getErrors() as $error){ $this->_logs->addLog("inicio", "error", $error); }
      return $v->isSuccess();
    }
  
    public function checkFin() { 
      $this->_logs->resetLogs("fin");
      if(Validation::is_undefined($this->fin)) return null;
      $v = Validation::getInstanceValue($this->fin)->isA('DateTime');
      foreach($v->getErrors() as $error){ $this->_logs->addLog("fin", "error", $error); }
      return $v->isSuccess();
    }
  
    public function checkAnio() { 
      $this->_logs->resetLogs("anio");
      if(Validation::is_undefined($this->anio)) return null;
      $v = Validation::getInstanceValue($this->anio)->required()->isA('DateTime');
      foreach($v->getErrors() as $error){ $this->_logs->addLog("anio", "error", $error); }
      return $v->isSuccess();
    }
  
    public function checkSemestre() { 
      $this->_logs->resetLogs("semestre");
      if(Validation::is_undefined($this->semestre)) return null;
      $v = Validation::getInstanceValue($this->semestre)->required()->max(5);
      foreach($v->getErrors() as $error){ $this->_logs->addLog("semestre", "error", $error); }
      return $v->isSuccess();
    }
  
    public function checkInsertado() { 
      $this->_logs->resetLogs("insertado");
      if(Validation::is_undefined($this->insertado)) return null;
      $v = Validation::getInstanceValue($this->insertado)->required()->isA('DateTime');
      foreach($v->getErrors() as $error){ $this->_logs->addLog("insertado", "error", $error); }
      return $v->isSuccess();
    }
  
    public function sqlId() { return $this->_sqlString($this->id); }
  public function sqlInicio() { return $this->_sqlDateTime($this->inicio, "Y-m-d"); }
  public function sqlInicioYm() { return $this->_sqlDateTime($this->inicio, "Y-m"); }
  public function sqlInicioY() { return $this->_sqlDateTime($this->inicio, "Y"); }
  public function sqlFin() { return $this->_sqlDateTime($this->fin, "Y-m-d"); }
  public function sqlFinYm() { return $this->_sqlDateTime($this->fin, "Y-m"); }
  public function sqlFinY() { return $this->_sqlDateTime($this->fin, "Y"); }
  public function sqlAnio() { return $this->_sqlDateTime($this->anio, "Y"); }
  public function sqlSemestre() { return $this->_sqlNumber($this->semestre); }
  public function sqlInsertado() { return $this->_sqlDateTime($this->insertado, "Y-m-d H:i:s"); }
  public function sqlInsertadoDate() { return $this->_sqlDateTime($this->insertado, "Y-m-d"); }
  public function sqlInsertadoYm() { return $this->_sqlDateTime($this->insertado, "Y-m"); }
  public function sqlInsertadoY() { return $this->_sqlDateTime($this->insertado, "Y"); }

  public function jsonId() { return $this->id; }
  public function jsonInicio() { return $this->inicio('c'); }
  public function jsonFin() { return $this->fin('c'); }
  public function jsonAnio() { return $this->anio('c'); }
  public function jsonSemestre() { return $this->semestre; }
  public function jsonInsertado() { return $this->insertado('c'); }



}
