<?php
require_once("class/model/entityOptions/Value.php");

class _AsignacionPlanillaDocenteValue extends ValueEntityOptions{

  protected $id = UNDEFINED;
  protected $insertado = UNDEFINED;
  protected $planillaDocente = UNDEFINED;
  protected $toma = UNDEFINED;

  public function setDefaultId() { if($this->id === UNDEFINED) $this->setId(uniqid()); }
  public function setDefaultInsertado() { if($this->insertado === UNDEFINED) $this->setInsertado(date('c')); }
  public function setDefaultPlanillaDocente() { if($this->planillaDocente === UNDEFINED) $this->setPlanillaDocente(null); }
  public function setDefaultToma() { if($this->toma === UNDEFINED) $this->setToma(null); }

  public function isEmptyId() { if(!Validation::is_empty($this->id)) return false; }
  public function isEmptyInsertado() { if(!Validation::is_empty($this->insertado)) return false; }
  public function isEmptyPlanillaDocente() { if(!Validation::is_empty($this->planillaDocente)) return false; }
  public function isEmptyToma() { if(!Validation::is_empty($this->toma)) return false; }

  public function id() { return $this->id; }
  public function insertado($format = null) { return Format::date($this->insertado, $format); }
  public function planillaDocente($format = null) { return Format::convertCase($this->planillaDocente, $format); }
  public function toma($format = null) { return Format::convertCase($this->toma, $format); }

  public function _setId(string $p = null) { return $this->id = $p; }  
  public function setId($p) { return $this->id = (is_null($p)) ? null : (string)$p; }

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

  public function _setToma(string $p = null) { return $this->toma = $p; }  
  public function setToma($p) { return $this->toma = (is_null($p)) ? null : (string)$p; }

  public function resetId() { if(!Validation::is_empty($this->id)) $this->id = preg_replace('/\s\s+/', ' ', trim($this->id)); }
  public function resetPlanillaDocente() { if(!Validation::is_empty($this->planillaDocente)) $this->planillaDocente = preg_replace('/\s\s+/', ' ', trim($this->planillaDocente)); }
  public function resetToma() { if(!Validation::is_empty($this->toma)) $this->toma = preg_replace('/\s\s+/', ' ', trim($this->toma)); }

  public function checkId() { 
      if(Validation::is_undefined($this->id)) return null;
      return true; 
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
  
    public function checkToma() { 
      $this->_logs->resetLogs("toma");
      if(Validation::is_undefined($this->toma)) return null;
      $v = Validation::getInstanceValue($this->toma)->required()->max(45);
      foreach($v->getErrors() as $error){ $this->_logs->addLog("toma", "error", $error); }
      return $v->isSuccess();
    }
  
    public function sqlId() { return $this->sql->string($this->id); }
  public function sqlInsertado() { return $this->sql->dateTime($this->insertado, "Y-m-d H:i:s"); }
  public function sqlInsertadoDate() { return $this->sql->dateTime($this->insertado, "Y-m-d"); }
  public function sqlInsertadoYm() { return $this->sql->dateTime($this->insertado, "Y-m"); }
  public function sqlInsertadoY() { return $this->sql->dateTime($this->insertado, "Y"); }
  public function sqlPlanillaDocente() { return $this->sql->string($this->planillaDocente); }
  public function sqlToma() { return $this->sql->string($this->toma); }

  public function jsonId() { return $this->id; }
  public function jsonInsertado() { return $this->insertado('c'); }
  public function jsonPlanillaDocente() { return $this->planillaDocente; }
  public function jsonToma() { return $this->toma; }



}
