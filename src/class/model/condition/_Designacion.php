<?php
require_once("class/model/entityOptions/Condition.php");

class _DesignacionCondition extends ConditionEntityOptions{

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

  public function desde($option, $value) { 
    $field = $this->mapping->desde();
    if($c = $this->_exists($field, $option, $value)) return $c;
    if($c = $this->_approxCast($field, $option, $value)) return $c;
    $this->value->setDesde($value);
    if(!$this->value->checkDesde()) throw new Exception("Valor incorrecto: Desde ");
    return "({$field} {$option} {$this->value->sqlDesde()})";  
  }

  public function desdeYm($option, $value) { 
    $field = $this->mapping->desdeYm();
    if($c = $this->_exists($field, $option, $value)) return $c;
    if($c = $this->_approxCast($field, $option, $value)) return $c;
    $this->value->setDesde($value);
    if(!$this->value->checkDesde()) throw new Exception("Valor incorrecto: Desde Ym");
    return "({$field} {$option} {$this->value->sqlDesdeYm()})";  
  }

  public function desdeY($option, $value) { 
    $field = $this->mapping->desdeY();
    if($c = $this->_exists($field, $option, $value)) return $c;
    if($c = $this->_approxCast($field, $option, $value)) return $c;
    $this->value->setDesdeY($value);
    if(!$this->value->checkDesde()) throw new Exception("Valor incorrecto: Desde Y");
    return "({$field} {$option} {$this->value->sqlDesdeY()})";  
  }

  public function desdeIsSet($option, $value) { 
    return $this->_exists($this->mapping->desde(), $option, settypebool($value));
  }

  public function hasta($option, $value) { 
    $field = $this->mapping->hasta();
    if($c = $this->_exists($field, $option, $value)) return $c;
    if($c = $this->_approxCast($field, $option, $value)) return $c;
    $this->value->setHasta($value);
    if(!$this->value->checkHasta()) throw new Exception("Valor incorrecto: Hasta ");
    return "({$field} {$option} {$this->value->sqlHasta()})";  
  }

  public function hastaYm($option, $value) { 
    $field = $this->mapping->hastaYm();
    if($c = $this->_exists($field, $option, $value)) return $c;
    if($c = $this->_approxCast($field, $option, $value)) return $c;
    $this->value->setHasta($value);
    if(!$this->value->checkHasta()) throw new Exception("Valor incorrecto: Hasta Ym");
    return "({$field} {$option} {$this->value->sqlHastaYm()})";  
  }

  public function hastaY($option, $value) { 
    $field = $this->mapping->hastaY();
    if($c = $this->_exists($field, $option, $value)) return $c;
    if($c = $this->_approxCast($field, $option, $value)) return $c;
    $this->value->setHastaY($value);
    if(!$this->value->checkHasta()) throw new Exception("Valor incorrecto: Hasta Y");
    return "({$field} {$option} {$this->value->sqlHastaY()})";  
  }

  public function hastaIsSet($option, $value) { 
    return $this->_exists($this->mapping->hasta(), $option, settypebool($value));
  }

  public function alta($option, $value) { 
    $field = $this->mapping->alta();
    if($c = $this->_exists($field, $option, $value)) return $c;
    if($c = $this->_approxCast($field, $option, $value)) return $c;
    $this->value->setAlta($value);
    if(!$this->value->checkAlta()) throw new Exception("Valor incorrecto: Alta ");
    return "({$field} {$option} {$this->value->sqlAlta()})";  
  }

  public function altaDate($option, $value) { 
    $field = $this->mapping->altaDate();
    if($c = $this->_exists($field, $option, $value)) return $c;
    if($c = $this->_approxCast($field, $option, $value)) return $c;
    $this->value->setAlta($value);
    if(!$this->value->checkAlta()) throw new Exception("Valor incorrecto: Alta Date");
    return "({$field} {$option} {$this->value->sqlAltaDate()})";  
  }

  public function altaYm($option, $value) { 
    $field = $this->mapping->altaYm();
    if($c = $this->_exists($field, $option, $value)) return $c;
    if($c = $this->_approxCast($field, $option, $value)) return $c;
    $this->value->setAlta($value);
    if(!$this->value->checkAlta()) throw new Exception("Valor incorrecto: Alta Ym");
    return "({$field} {$option} {$this->value->sqlAltaYm()})";  
  }

  public function altaY($option, $value) { 
    $field = $this->mapping->altaY();
    if($c = $this->_exists($field, $option, $value)) return $c;
    if($c = $this->_approxCast($field, $option, $value)) return $c;
    $this->value->setAltaY($value);
    if(!$this->value->checkAlta()) throw new Exception("Valor incorrecto: Alta Y");
    return "({$field} {$option} {$this->value->sqlAltaY()})";  
  }

  public function altaIsSet($option, $value) { 
    return $this->_exists($this->mapping->alta(), $option, settypebool($value));
  }

  public function cargo($option, $value) { 
    $field = $this->mapping->cargo();
    if($c = $this->_exists($field, $option, $value)) return $c;
    if($c = $this->_approx($field, $option, $value)) return $c;
    $this->value->setCargo($value);
    if(!$this->value->checkCargo()) throw new Exception("Valor incorrecto: Cargo ");
    return "({$field} {$option} {$this->value->sqlCargo()})";  
  }

  public function cargoIsSet($option, $value) { 
    return $this->_exists($this->mapping->cargo(), $option, settypebool($value));
  }

  public function sede($option, $value) { 
    $field = $this->mapping->sede();
    if($c = $this->_exists($field, $option, $value)) return $c;
    if($c = $this->_approx($field, $option, $value)) return $c;
    $this->value->setSede($value);
    if(!$this->value->checkSede()) throw new Exception("Valor incorrecto: Sede ");
    return "({$field} {$option} {$this->value->sqlSede()})";  
  }

  public function sedeIsSet($option, $value) { 
    return $this->_exists($this->mapping->sede(), $option, settypebool($value));
  }

  public function persona($option, $value) { 
    $field = $this->mapping->persona();
    if($c = $this->_exists($field, $option, $value)) return $c;
    if($c = $this->_approx($field, $option, $value)) return $c;
    $this->value->setPersona($value);
    if(!$this->value->checkPersona()) throw new Exception("Valor incorrecto: Persona ");
    return "({$field} {$option} {$this->value->sqlPersona()})";  
  }

  public function personaIsSet($option, $value) { 
    return $this->_exists($this->mapping->persona(), $option, settypebool($value));
  }




}
