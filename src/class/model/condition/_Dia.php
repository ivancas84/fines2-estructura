<?php
require_once("class/model/entityOptions/Condition.php");

class _DiaCondition extends ConditionEntityOptions{

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

  public function numero($option, $value) { 
    $field = $this->mapping->numero();
    if($c = $this->sql->exists($field, $option, $value)) return $c;
    if($c = $this->sql->approxCast($field, $option, $value)) return $c;
    $this->value->setNumero($value);
    if(!$this->value->checkNumero()) throw new Exception("Valor incorrecto: Numero ");
    return "({$field} {$option} {$this->value->sqlNumero()})";  
  }

    public function numeroIsSet($option, $value) { 
    return $this->_exists($this->mapping->numero(), $option, settypebool($value));
  }

  public function dia($option, $value) { 
    $field = $this->mapping->dia();
    if($c = $this->sql->exists($field, $option, $value)) return $c;
    if($c = $this->sql->approx($field, $option, $value)) return $c;
    $this->value->setDia($value);
    if(!$this->value->checkDia()) throw new Exception("Valor incorrecto: Dia");
    return "({$field} {$option} {$this->value->sqlDia()})";  
  }

  public function diaIsSet($option, $value) { 
    return $this->_exists($this->mapping->dia(), $option, settypebool($value));
  }




}
