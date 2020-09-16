<?php
require_once("class/model/entityOptions/Condition.php");

class _HorarioCondition extends ConditionEntityOptions{

  public function id($option, $value) { 
    $field = $this->mapping->id();
    if($c = $this->_exists($field, $option, $value)) return $c;
    if($c = $this->_approx($field, $option, $value)) return $c;
    $this->value->setId($value);
    if(!$this->value->checkId()) throw new Exception("Valor incorrecto: Id");
    return "({$field} {$option} {$this->value->sqlId()})";  
  }

  public function idIsSet($option, $value) { 
    return $this->_exists($this->mapping->id(), $option, settypebool($value));
  }

  public function horaInicio($option, $value) { 
    $field = $this->mapping->horaInicio();
    if($c = $this->_exists($field, $option, $value)) return $c;
    if($c = $this->_approxCast($field, $option, $value)) return $c;
    $this->value->setHoraInicio($value);
    if(!$this->value->checkHoraInicio()) throw new Exception("Valor incorrecto: Hora Inicio ");
    return "({$field} {$option} {$this->value->sqlHoraInicio()})";  
  }

  public function horaInicioHm($option, $value) { 
    $field = $this->mapping->horaInicioHm();
    if($c = $this->_exists($field, $option, $value)) return $c;
    if($c = $this->_approxCast($field, $option, $value)) return $c;
    $this->value->setHoraInicio($value);
    if(!$this->value->checkHoraInicio()) throw new Exception("Valor incorrecto: Hora Inicio Hm");
    return "({$field} {$option} {$this->value->sqlHoraInicioHm()})";  
  }

  public function horaInicioIsSet($option, $value) { 
    return $this->_exists($this->mapping->horaInicio(), $option, settypebool($value));
  }

  public function horaFin($option, $value) { 
    $field = $this->mapping->horaFin();
    if($c = $this->_exists($field, $option, $value)) return $c;
    if($c = $this->_approxCast($field, $option, $value)) return $c;
    $this->value->setHoraFin($value);
    if(!$this->value->checkHoraFin()) throw new Exception("Valor incorrecto: Hora Fin ");
    return "({$field} {$option} {$this->value->sqlHoraFin()})";  
  }

  public function horaFinHm($option, $value) { 
    $field = $this->mapping->horaFinHm();
    if($c = $this->_exists($field, $option, $value)) return $c;
    if($c = $this->_approxCast($field, $option, $value)) return $c;
    $this->value->setHoraFin($value);
    if(!$this->value->checkHoraFin()) throw new Exception("Valor incorrecto: Hora Fin Hm");
    return "({$field} {$option} {$this->value->sqlHoraFinHm()})";  
  }

  public function horaFinIsSet($option, $value) { 
    return $this->_exists($this->mapping->horaFin(), $option, settypebool($value));
  }

  public function curso($option, $value) { 
    $field = $this->mapping->curso();
    if($c = $this->_exists($field, $option, $value)) return $c;
    if($c = $this->_approx($field, $option, $value)) return $c;
    $this->value->setCurso($value);
    if(!$this->value->checkCurso()) throw new Exception("Valor incorrecto: Curso");
    return "({$field} {$option} {$this->value->sqlCurso()})";  
  }

  public function cursoIsSet($option, $value) { 
    return $this->_exists($this->mapping->curso(), $option, settypebool($value));
  }

  public function dia($option, $value) { 
    $field = $this->mapping->dia();
    if($c = $this->_exists($field, $option, $value)) return $c;
    if($c = $this->_approx($field, $option, $value)) return $c;
    $this->value->setDia($value);
    if(!$this->value->checkDia()) throw new Exception("Valor incorrecto: Dia");
    return "({$field} {$option} {$this->value->sqlDia()})";  
  }

  public function diaIsSet($option, $value) { 
    return $this->_exists($this->mapping->dia(), $option, settypebool($value));
  }




}
