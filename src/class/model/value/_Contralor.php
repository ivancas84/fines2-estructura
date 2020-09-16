<?php
require_once("class/model/entityOptions/Value.php");

class _ContralorValue extends ValueEntityOptions{

  protected $id = UNDEFINED;
  protected $fechaContralor = UNDEFINED;
  protected $fechaConsejo = UNDEFINED;
  protected $insertado = UNDEFINED;
  protected $planillaDocente = UNDEFINED;

  public function setDefaultId() { if($this->id === UNDEFINED) $this->setId(uniqid()); }
  public function setDefaultFechaContralor() { if($this->fechaContralor === UNDEFINED) $this->setFechaContralor(null); }
  public function setDefaultFechaConsejo() { if($this->fechaConsejo === UNDEFINED) $this->setFechaConsejo(null); }
  public function setDefaultInsertado() { if($this->insertado === UNDEFINED) $this->setInsertado(date('c')); }
  public function setDefaultPlanillaDocente() { if($this->planillaDocente === UNDEFINED) $this->setPlanillaDocente(null); }

  public function isEmptyId() { if(!Validation::is_empty($this->id)) return false; }
  public function isEmptyFechaContralor() { if(!Validation::is_empty($this->fechaContralor)) return false; }
  public function isEmptyFechaConsejo() { if(!Validation::is_empty($this->fechaConsejo)) return false; }
  public function isEmptyInsertado() { if(!Validation::is_empty($this->insertado)) return false; }
  public function isEmptyPlanillaDocente() { if(!Validation::is_empty($this->planillaDocente)) return false; }

  public function id() { return $this->id; }
  public function fechaContralor($format = null) { return Format::date($this->fechaContralor, $format); }
  public function fechaConsejo($format = null) { return Format::date($this->fechaConsejo, $format); }
  public function insertado($format = null) { return Format::date($this->insertado, $format); }
  public function planillaDocente($format = null) { return Format::convertCase($this->planillaDocente, $format); }

  public function _setId(string $p = null) { return $this->id = $p; }  
  public function setId($p) { return $this->id = (is_null($p)) ? null : (string)$p; }

  public function _setFechaContralor(DateTime $p = null) { return $this->fechaContralor = $p; }  

  public function setFechaContralor($p) {
    if(!is_null($p) && !($p instanceof DateTime)) $p = new SpanishDateTime($p);
    if($p instanceof DateTime) $p->setTimeZone(new DateTimeZone(date_default_timezone_get()));
    return $this->fechaContralor = $p;
  }

  public function setFechaContralorY($p) {
    if(!is_null($p) && !($p instanceof DateTime)) {
      $p = (strlen($p) == 4) ? SpanishDateTime::createFromFormat('Y', $p) : new SpanishDateTime($p);
    }
    if($p instanceof DateTime) $p->setTimeZone(new DateTimeZone(date_default_timezone_get()));
    return $this->fechaContralor = $p;
  }

  public function _setFechaConsejo(DateTime $p = null) { return $this->fechaConsejo = $p; }  

  public function setFechaConsejo($p) {
    if(!is_null($p) && !($p instanceof DateTime)) $p = new SpanishDateTime($p);
    if($p instanceof DateTime) $p->setTimeZone(new DateTimeZone(date_default_timezone_get()));
    return $this->fechaConsejo = $p;
  }

  public function setFechaConsejoY($p) {
    if(!is_null($p) && !($p instanceof DateTime)) {
      $p = (strlen($p) == 4) ? SpanishDateTime::createFromFormat('Y', $p) : new SpanishDateTime($p);
    }
    if($p instanceof DateTime) $p->setTimeZone(new DateTimeZone(date_default_timezone_get()));
    return $this->fechaConsejo = $p;
  }

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

  public function _setPlanillaDocente(string $p = null) { return $this->planillaDocente = $p; }  
  public function setPlanillaDocente($p) { return $this->planillaDocente = (is_null($p)) ? null : (string)$p; }


  public function checkId() { 
      if(Validation::is_undefined($this->id)) return null;
      return true; 
  }

  public function checkFechaContralor() { 
      $this->_logs->resetLogs("fecha_contralor");
      if(Validation::is_undefined($this->fechaContralor)) return null;
      $v = Validation::getInstanceValue($this->fechaContralor)->isA('DateTime');
      foreach($v->getErrors() as $error){ $this->_logs->addLog("fecha_contralor", "error", $error); }
      return $v->isSuccess();
    }
  
    public function checkFechaConsejo() { 
      $this->_logs->resetLogs("fecha_consejo");
      if(Validation::is_undefined($this->fechaConsejo)) return null;
      $v = Validation::getInstanceValue($this->fechaConsejo)->isA('DateTime');
      foreach($v->getErrors() as $error){ $this->_logs->addLog("fecha_consejo", "error", $error); }
      return $v->isSuccess();
    }
  
    public function checkInsertado() { 
      $this->_logs->resetLogs("insertado");
      if(Validation::is_undefined($this->insertado)) return null;
      $v = Validation::getInstanceValue($this->insertado)->required()->isA('DateTime');
      foreach($v->getErrors() as $error){ $this->_logs->addLog("insertado", "error", $error); }
      return $v->isSuccess();
    }
  
    public function checkPlanillaDocente() { 
      $this->_logs->resetLogs("planilla_docente");
      if(Validation::is_undefined($this->planillaDocente)) return null;
      $v = Validation::getInstanceValue($this->planillaDocente)->required()->max(45);
      foreach($v->getErrors() as $error){ $this->_logs->addLog("planilla_docente", "error", $error); }
      return $v->isSuccess();
    }
  
    public function sqlId() { return $this->_sqlString($this->id); }
  public function sqlFechaContralor() { return $this->_sqlDateTime($this->fechaContralor, "Y-m-d"); }
  public function sqlFechaContralorYm() { return $this->_sqlDateTime($this->fechaContralor, "Y-m"); }
  public function sqlFechaContralorY() { return $this->_sqlDateTime($this->fechaContralor, "Y"); }
  public function sqlFechaConsejo() { return $this->_sqlDateTime($this->fechaConsejo, "Y-m-d"); }
  public function sqlFechaConsejoYm() { return $this->_sqlDateTime($this->fechaConsejo, "Y-m"); }
  public function sqlFechaConsejoY() { return $this->_sqlDateTime($this->fechaConsejo, "Y"); }
  public function sqlInsertado() { return $this->_sqlDateTime($this->insertado, "Y-m-d H:i:s"); }
  public function sqlInsertadoDate() { return $this->_sqlDateTime($this->insertado, "Y-m-d"); }
  public function sqlInsertadoYm() { return $this->_sqlDateTime($this->insertado, "Y-m"); }
  public function sqlInsertadoY() { return $this->_sqlDateTime($this->insertado, "Y"); }
  public function sqlPlanillaDocente() { return $this->_sqlString($this->planillaDocente); }

  public function jsonId() { return $this->id; }
  public function jsonFechaContralor() { return $this->fechaContralor('c'); }
  public function jsonFechaConsejo() { return $this->fechaConsejo('c'); }
  public function jsonInsertado() { return $this->insertado('c'); }
  public function jsonPlanillaDocente() { return $this->planillaDocente; }



}
