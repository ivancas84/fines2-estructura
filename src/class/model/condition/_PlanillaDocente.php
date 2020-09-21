<?php
require_once("class/model/entityOptions/Condition.php");

class _PlanillaDocenteCondition extends ConditionEntityOptions{

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
    if($c = $this->sql->approx($field, $option, $value)) return $c;
    $this->value->setNumero($value);
    if(!$this->value->checkNumero()) throw new Exception("Valor incorrecto: Numero");
    return "({$field} {$option} {$this->value->sqlNumero()})";  
  }

  public function numeroIsSet($option, $value) { 
    return $this->_exists($this->mapping->numero(), $option, settypebool($value));
  }

  public function insertado($option, $value) { 
    $field = $this->mapping->insertado();
    if($c = $this->sql->exists($field, $option, $value)) return $c;
    if($c = $this->sql->approxCast($field, $option, $value)) return $c;
    $this->value->setInsertado($value);
    if(!$this->value->checkInsertado()) throw new Exception("Valor incorrecto: Insertado ");
    return "({$field} {$option} {$this->value->sqlInsertado()})";  
  }

  public function insertadoDate($option, $value) { 
    $field = $this->mapping->insertadoDate();
    if($c = $this->sql->exists($field, $option, $value)) return $c;
    if($c = $this->sql->approxCast($field, $option, $value)) return $c;
    $this->value->setInsertado($value);
    if(!$this->value->checkInsertado()) throw new Exception("Valor incorrecto: Insertado Date");
    return "({$field} {$option} {$this->value->sqlInsertadoDate()})";  
  }

  public function insertadoYm($option, $value) { 
    $field = $this->mapping->insertadoYm();
    if($c = $this->sql->exists($field, $option, $value)) return $c;
    if($c = $this->sql->approxCast($field, $option, $value)) return $c;
    $this->value->setInsertado($value);
    if(!$this->value->checkInsertado()) throw new Exception("Valor incorrecto: Insertado Ym");
    return "({$field} {$option} {$this->value->sqlInsertadoYm()})";  
  }

  public function insertadoY($option, $value) { 
    $field = $this->mapping->insertadoY();
    if($c = $this->sql->exists($field, $option, $value)) return $c;
    if($c = $this->sql->approxCast($field, $option, $value)) return $c;
    $this->value->setInsertadoY($value);
    if(!$this->value->checkInsertado()) throw new Exception("Valor incorrecto: Insertado Y");
    return "({$field} {$option} {$this->value->sqlInsertadoY()})";  
  }

  public function insertadoIsSet($option, $value) { 
    return $this->_exists($this->mapping->insertado(), $option, settypebool($value));
  }




}
