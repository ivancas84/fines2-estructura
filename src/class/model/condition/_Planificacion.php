<?php
require_once("class/model/entityOptions/Condition.php");

class _PlanificacionCondition extends ConditionEntityOptions{

  public function id($option, $value) { 
    $field = $this->mapping->id();
    if($c = $this->_exists($field, $option, $value)) return $c;
    if($c = $this->_approx($field, $option, $value)) return $c;
    $this->value->setId($value);
    if(!$this->value->checkId()) throw new Exception("Valor incorrecto: Id ");
    return "({$field} {$option} {$this->value->sqlId()})";  
  }

  public function idIsSet($option, $value) { 
    return $this->_exists($this->mapping->id(), $option, settypebool($value));
  }

  public function anio($option, $value) { 
    $field = $this->mapping->anio();
    if($c = $this->_exists($field, $option, $value)) return $c;
    if($c = $this->_approx($field, $option, $value)) return $c;
    $this->value->setAnio($value);
    if(!$this->value->checkAnio()) throw new Exception("Valor incorrecto: Anio ");
    return "({$field} {$option} {$this->value->sqlAnio()})";  
  }

  public function anioIsSet($option, $value) { 
    return $this->_exists($this->mapping->anio(), $option, settypebool($value));
  }

  public function semestre($option, $value) { 
    $field = $this->mapping->semestre();
    if($c = $this->_exists($field, $option, $value)) return $c;
    if($c = $this->_approx($field, $option, $value)) return $c;
    $this->value->setSemestre($value);
    if(!$this->value->checkSemestre()) throw new Exception("Valor incorrecto: Semestre ");
    return "({$field} {$option} {$this->value->sqlSemestre()})";  
  }

  public function semestreIsSet($option, $value) { 
    return $this->_exists($this->mapping->semestre(), $option, settypebool($value));
  }

  public function plan($option, $value) { 
    $field = $this->mapping->plan();
    if($c = $this->_exists($field, $option, $value)) return $c;
    if($c = $this->_approx($field, $option, $value)) return $c;
    $this->value->setPlan($value);
    if(!$this->value->checkPlan()) throw new Exception("Valor incorrecto: Plan ");
    return "({$field} {$option} {$this->value->sqlPlan()})";  
  }

  public function planIsSet($option, $value) { 
    return $this->_exists($this->mapping->plan(), $option, settypebool($value));
  }




}
