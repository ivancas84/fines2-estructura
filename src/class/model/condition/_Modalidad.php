<?php
require_once("class/model/entityOptions/Condition.php");

class _ModalidadCondition extends ConditionEntityOptions{

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

  public function nombre($option, $value) { 
    $field = $this->mapping->nombre();
    if($c = $this->sql->exists($field, $option, $value)) return $c;
    if($c = $this->sql->approx($field, $option, $value)) return $c;
    $this->value->setNombre($value);
    if(!$this->value->checkNombre()) throw new Exception("Valor incorrecto: Nombre");
    return "({$field} {$option} {$this->value->sqlNombre()})";  
  }

  public function nombreIsSet($option, $value) { 
    return $this->_exists($this->mapping->nombre(), $option, settypebool($value));
  }




}