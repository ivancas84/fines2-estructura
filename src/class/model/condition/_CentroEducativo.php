<?php
require_once("class/model/entityOptions/Condition.php");

class _CentroEducativoCondition extends ConditionEntityOptions{

  public function id($option, $value) { 
    $field = $this->mapping->id();
    if($c = $this->sql->exists($field, $option, $value)) return $c;
    if($c = $this->sql->approx($field, $option, $value)) return $c;
    $this->value->setId($value);
    if(!$this->value->checkId()) throw new Exception("Valor incorrecto: Id");
    return "({$field} {$option} {$this->value->sqlId()})";  
  }

  public function idIsSet($option, $value) { 
    return $this->sql->exists($this->mapping->id(), $option, settypebool($value));
  }

  public function nombre($option, $value) { 
    $field = $this->mapping->nombre();
    if($c = $this->sql->exists($field, $option, $value)) return $c;
    if($c = $this->sql->approx($field, $option, $value)) return $c;
    $this->value->setNombre($value);
    if(!$this->value->checkNombre()) throw new Exception("Valor incorrecto: Nombre");
    return "({$field} {$option} {$this->value->sqlNombre()})";  
  }

  public function nombreIsSet($option, $value) { 
    return $this->sql->exists($this->mapping->nombre(), $option, settypebool($value));
  }

  public function cue($option, $value) { 
    $field = $this->mapping->cue();
    if($c = $this->sql->exists($field, $option, $value)) return $c;
    if($c = $this->sql->approx($field, $option, $value)) return $c;
    $this->value->setCue($value);
    if(!$this->value->checkCue()) throw new Exception("Valor incorrecto: Cue");
    return "({$field} {$option} {$this->value->sqlCue()})";  
  }

  public function cueIsSet($option, $value) { 
    return $this->sql->exists($this->mapping->cue(), $option, settypebool($value));
  }

  public function domicilio($option, $value) { 
    $field = $this->mapping->domicilio();
    if($c = $this->sql->exists($field, $option, $value)) return $c;
    if($c = $this->sql->approx($field, $option, $value)) return $c;
    $this->value->setDomicilio($value);
    if(!$this->value->checkDomicilio()) throw new Exception("Valor incorrecto: Domicilio");
    return "({$field} {$option} {$this->value->sqlDomicilio()})";  
  }

  public function domicilioIsSet($option, $value) { 
    return $this->sql->exists($this->mapping->domicilio(), $option, settypebool($value));
  }




}
