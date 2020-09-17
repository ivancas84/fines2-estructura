<?php
require_once("class/model/entityOptions/Condition.php");

class _PlanCondition extends ConditionEntityOptions{

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

  public function orientacion($option, $value) { 
    $field = $this->mapping->orientacion();
    if($c = $this->sql->exists($field, $option, $value)) return $c;
    if($c = $this->sql->approx($field, $option, $value)) return $c;
    $this->value->setOrientacion($value);
    if(!$this->value->checkOrientacion()) throw new Exception("Valor incorrecto: Orientacion");
    return "({$field} {$option} {$this->value->sqlOrientacion()})";  
  }

  public function orientacionIsSet($option, $value) { 
    return $this->_exists($this->mapping->orientacion(), $option, settypebool($value));
  }

  public function resolucion($option, $value) { 
    $field = $this->mapping->resolucion();
    if($c = $this->sql->exists($field, $option, $value)) return $c;
    if($c = $this->sql->approx($field, $option, $value)) return $c;
    $this->value->setResolucion($value);
    if(!$this->value->checkResolucion()) throw new Exception("Valor incorrecto: Resolucion");
    return "({$field} {$option} {$this->value->sqlResolucion()})";  
  }

  public function resolucionIsSet($option, $value) { 
    return $this->_exists($this->mapping->resolucion(), $option, settypebool($value));
  }

  public function distribucionHoraria($option, $value) { 
    $field = $this->mapping->distribucionHoraria();
    if($c = $this->sql->exists($field, $option, $value)) return $c;
    if($c = $this->sql->approx($field, $option, $value)) return $c;
    $this->value->setDistribucionHoraria($value);
    if(!$this->value->checkDistribucionHoraria()) throw new Exception("Valor incorrecto: Distribucion Horaria");
    return "({$field} {$option} {$this->value->sqlDistribucionHoraria()})";  
  }

  public function distribucionHorariaIsSet($option, $value) { 
    return $this->_exists($this->mapping->distribucionHoraria(), $option, settypebool($value));
  }




}
