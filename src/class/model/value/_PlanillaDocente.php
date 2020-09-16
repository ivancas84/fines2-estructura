<?php
require_once("class/model/entityOptions/Value.php");

class _PlanillaDocenteValue extends ValueEntityOptions{

  protected $id = UNDEFINED;
  protected $numero = UNDEFINED;
  protected $insertado = UNDEFINED;

  public function setDefaultId() { if($this->id === UNDEFINED) $this->setId(uniqid()); }
  public function setDefaultNumero() { if($this->numero === UNDEFINED) $this->setNumero(null); }
  public function setDefaultInsertado() { if($this->insertado === UNDEFINED) $this->setInsertado(date('c')); }

  public function isEmptyId() { if(!Validation::is_empty($this->id)) return false; }
  public function isEmptyNumero() { if(!Validation::is_empty($this->numero)) return false; }
  public function isEmptyInsertado() { if(!Validation::is_empty($this->insertado)) return false; }

  public function id() { return $this->id; }
  public function numero($format = null) { return Format::convertCase($this->numero, $format); }
  public function insertado($format = null) { return Format::date($this->insertado, $format); }

  public function _setId(string $p = null) { return $this->id = $p; }  
  public function setId($p) { return $this->id = (is_null($p)) ? null : (string)$p; }

  public function _setNumero(string $p = null) { return $this->numero = $p; }  
  public function setNumero($p) { return $this->numero = (is_null($p)) ? null : (string)$p; }

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

  public function resetNumero() { if(!Validation::is_empty($this->numero)) $this->numero = preg_replace('/\s\s+/', ' ', trim($this->numero)); }

  public function checkId() { 
      if(Validation::is_undefined($this->id)) return null;
      return true; 
  }

  public function checkNumero() { 
      $this->_logs->resetLogs("numero");
      if(Validation::is_undefined($this->numero)) return null;
      $v = Validation::getInstanceValue($this->numero)->required()->max(255);
      foreach($v->getErrors() as $error){ $this->_logs->addLog("numero", "error", $error); }
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
  public function sqlNumero() { return $this->_sqlString($this->numero); }
  public function sqlInsertado() { return $this->_sqlDateTime($this->insertado, "Y-m-d H:i:s"); }
  public function sqlInsertadoDate() { return $this->_sqlDateTime($this->insertado, "Y-m-d"); }
  public function sqlInsertadoYm() { return $this->_sqlDateTime($this->insertado, "Y-m"); }
  public function sqlInsertadoY() { return $this->_sqlDateTime($this->insertado, "Y"); }

  public function jsonId() { return $this->id; }
  public function jsonNumero() { return $this->numero; }
  public function jsonInsertado() { return $this->insertado('c'); }



}
