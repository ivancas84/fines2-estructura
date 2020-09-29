<?php
require_once("class/model/entityOptions/Condition.php");

class _CursoCondition extends ConditionEntityOptions{

  public function id($option, $value) { 
    $field = $this->mapping->id();
    if($c = $this->sql->exists($field, $option, $value)) return $c;
    if($c = $this->sql->approx($field, $option, $value)) return $c;
    $this->value->setId($value);
    if(!$this->value->checkId()) throw new Exception("Valor incorrecto: Id");
    return "({$field} {$option} {$this->value->sqlId()})";  
  }

  public function idIsSet($option, $value) { 
    return $this->_exists($this->mapping->id(), $option, settypebool($value));
  }

  public function horasCatedra($option, $value) { 
    $field = $this->mapping->horasCatedra();
    if($c = $this->sql->exists($field, $option, $value)) return $c;
    if($c = $this->sql->approxCast($field, $option, $value)) return $c;
    $this->value->setHorasCatedra($value);
    if(!$this->value->checkHorasCatedra()) throw new Exception("Valor incorrecto: Horas Catedra ");
    return "({$field} {$option} {$this->value->sqlHorasCatedra()})";  
  }

    public function horasCatedraIsSet($option, $value) { 
    return $this->_exists($this->mapping->horasCatedra(), $option, settypebool($value));
  }

  public function ige($option, $value) { 
    $field = $this->mapping->ige();
    if($c = $this->sql->exists($field, $option, $value)) return $c;
    if($c = $this->sql->approx($field, $option, $value)) return $c;
    $this->value->setIge($value);
    if(!$this->value->checkIge()) throw new Exception("Valor incorrecto: Ige");
    return "({$field} {$option} {$this->value->sqlIge()})";  
  }

  public function igeIsSet($option, $value) { 
    return $this->_exists($this->mapping->ige(), $option, settypebool($value));
  }

  public function numeroDocumentoDesignado($option, $value) { 
    $field = $this->mapping->numeroDocumentoDesignado();
    if($c = $this->sql->exists($field, $option, $value)) return $c;
    if($c = $this->sql->approx($field, $option, $value)) return $c;
    $this->value->setNumeroDocumentoDesignado($value);
    if(!$this->value->checkNumeroDocumentoDesignado()) throw new Exception("Valor incorrecto: Numero Documento Designado");
    return "({$field} {$option} {$this->value->sqlNumeroDocumentoDesignado()})";  
  }

  public function numeroDocumentoDesignadoIsSet($option, $value) { 
    return $this->_exists($this->mapping->numeroDocumentoDesignado(), $option, settypebool($value));
  }

  public function alta($option, $value) { 
    $field = $this->mapping->alta();
    if($c = $this->sql->exists($field, $option, $value)) return $c;
    if($c = $this->sql->approxCast($field, $option, $value)) return $c;
    $this->value->setAlta($value);
    if(!$this->value->checkAlta()) throw new Exception("Valor incorrecto: Alta ");
    return "({$field} {$option} {$this->value->sqlAlta()})";  
  }

  public function altaDate($option, $value) { 
    $field = $this->mapping->altaDate();
    if($c = $this->sql->exists($field, $option, $value)) return $c;
    if($c = $this->sql->approxCast($field, $option, $value)) return $c;
    $this->value->setAlta($value);
    if(!$this->value->checkAlta()) throw new Exception("Valor incorrecto: Alta Date");
    return "({$field} {$option} {$this->value->sqlAltaDate()})";  
  }

  public function altaYm($option, $value) { 
    $field = $this->mapping->altaYm();
    if($c = $this->sql->exists($field, $option, $value)) return $c;
    if($c = $this->sql->approxCast($field, $option, $value)) return $c;
    $this->value->setAlta($value);
    if(!$this->value->checkAlta()) throw new Exception("Valor incorrecto: Alta Ym");
    return "({$field} {$option} {$this->value->sqlAltaYm()})";  
  }

  public function altaY($option, $value) { 
    $field = $this->mapping->altaY();
    if($c = $this->sql->exists($field, $option, $value)) return $c;
    if($c = $this->sql->approxCast($field, $option, $value)) return $c;
    $this->value->setAltaY($value);
    if(!$this->value->checkAlta()) throw new Exception("Valor incorrecto: Alta Y");
    return "({$field} {$option} {$this->value->sqlAltaY()})";  
  }

  public function altaIsSet($option, $value) { 
    return $this->_exists($this->mapping->alta(), $option, settypebool($value));
  }

  public function comision($option, $value) { 
    $field = $this->mapping->comision();
    if($c = $this->sql->exists($field, $option, $value)) return $c;
    if($c = $this->sql->approx($field, $option, $value)) return $c;
    $this->value->setComision($value);
    if(!$this->value->checkComision()) throw new Exception("Valor incorrecto: Comision");
    return "({$field} {$option} {$this->value->sqlComision()})";  
  }

  public function comisionIsSet($option, $value) { 
    return $this->_exists($this->mapping->comision(), $option, settypebool($value));
  }

  public function asignatura($option, $value) { 
    $field = $this->mapping->asignatura();
    if($c = $this->sql->exists($field, $option, $value)) return $c;
    if($c = $this->sql->approx($field, $option, $value)) return $c;
    $this->value->setAsignatura($value);
    if(!$this->value->checkAsignatura()) throw new Exception("Valor incorrecto: Asignatura");
    return "({$field} {$option} {$this->value->sqlAsignatura()})";  
  }

  public function asignaturaIsSet($option, $value) { 
    return $this->_exists($this->mapping->asignatura(), $option, settypebool($value));
  }




}
