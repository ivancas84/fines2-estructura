<?php
require_once("class/model/entityOptions/Condition.php");

class _DistribucionHorariaCondition extends ConditionEntityOptions{

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

  public function horasCatedra($option, $value) { 
    $field = $this->mapping->horasCatedra();
    if($c = $this->_exists($field, $option, $value)) return $c;
    if($c = $this->_approxCast($field, $option, $value)) return $c;
    $this->value->setHorasCatedra($value);
    if(!$this->value->checkHorasCatedra()) throw new Exception("Valor incorrecto: Horas Catedra ");
    return "({$field} {$option} {$this->value->sqlHorasCatedra()})";  
  }

    public function horasCatedraIsSet($option, $value) { 
    return $this->_exists($this->mapping->horasCatedra(), $option, settypebool($value));
  }

  public function dia($option, $value) { 
    $field = $this->mapping->dia();
    if($c = $this->_exists($field, $option, $value)) return $c;
    if($c = $this->_approxCast($field, $option, $value)) return $c;
    $this->value->setDia($value);
    if(!$this->value->checkDia()) throw new Exception("Valor incorrecto: Dia ");
    return "({$field} {$option} {$this->value->sqlDia()})";  
  }

    public function diaIsSet($option, $value) { 
    return $this->_exists($this->mapping->dia(), $option, settypebool($value));
  }

  public function asignatura($option, $value) { 
    $field = $this->mapping->asignatura();
    if($c = $this->_exists($field, $option, $value)) return $c;
    if($c = $this->_approx($field, $option, $value)) return $c;
    $this->value->setAsignatura($value);
    if(!$this->value->checkAsignatura()) throw new Exception("Valor incorrecto: Asignatura ");
    return "({$field} {$option} {$this->value->sqlAsignatura()})";  
  }

  public function asignaturaIsSet($option, $value) { 
    return $this->_exists($this->mapping->asignatura(), $option, settypebool($value));
  }

  public function planificacion($option, $value) { 
    $field = $this->mapping->planificacion();
    if($c = $this->_exists($field, $option, $value)) return $c;
    if($c = $this->_approx($field, $option, $value)) return $c;
    $this->value->setPlanificacion($value);
    if(!$this->value->checkPlanificacion()) throw new Exception("Valor incorrecto: Planificacion ");
    return "({$field} {$option} {$this->value->sqlPlanificacion()})";  
  }

  public function planificacionIsSet($option, $value) { 
    return $this->_exists($this->mapping->planificacion(), $option, settypebool($value));
  }




}
