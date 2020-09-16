<?php
require_once("class/model/entityOptions/Condition.php");

class _DetallePersonaCondition extends ConditionEntityOptions{

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

  public function descripcion($option, $value) { 
    $field = $this->mapping->descripcion();
    if($c = $this->_exists($field, $option, $value)) return $c;
    if($c = $this->_approx($field, $option, $value)) return $c;
    $this->value->setDescripcion($value);
    if(!$this->value->checkDescripcion()) throw new Exception("Valor incorrecto: Descripcion");
    return "({$field} {$option} {$this->value->sqlDescripcion()})";  
  }

  public function descripcionIsSet($option, $value) { 
    return $this->_exists($this->mapping->descripcion(), $option, settypebool($value));
  }

  public function creado($option, $value) { 
    $field = $this->mapping->creado();
    if($c = $this->_exists($field, $option, $value)) return $c;
    if($c = $this->_approxCast($field, $option, $value)) return $c;
    $this->value->setCreado($value);
    if(!$this->value->checkCreado()) throw new Exception("Valor incorrecto: Creado ");
    return "({$field} {$option} {$this->value->sqlCreado()})";  
  }

  public function creadoDate($option, $value) { 
    $field = $this->mapping->creadoDate();
    if($c = $this->_exists($field, $option, $value)) return $c;
    if($c = $this->_approxCast($field, $option, $value)) return $c;
    $this->value->setCreado($value);
    if(!$this->value->checkCreado()) throw new Exception("Valor incorrecto: Creado Date");
    return "({$field} {$option} {$this->value->sqlCreadoDate()})";  
  }

  public function creadoYm($option, $value) { 
    $field = $this->mapping->creadoYm();
    if($c = $this->_exists($field, $option, $value)) return $c;
    if($c = $this->_approxCast($field, $option, $value)) return $c;
    $this->value->setCreado($value);
    if(!$this->value->checkCreado()) throw new Exception("Valor incorrecto: Creado Ym");
    return "({$field} {$option} {$this->value->sqlCreadoYm()})";  
  }

  public function creadoY($option, $value) { 
    $field = $this->mapping->creadoY();
    if($c = $this->_exists($field, $option, $value)) return $c;
    if($c = $this->_approxCast($field, $option, $value)) return $c;
    $this->value->setCreadoY($value);
    if(!$this->value->checkCreado()) throw new Exception("Valor incorrecto: Creado Y");
    return "({$field} {$option} {$this->value->sqlCreadoY()})";  
  }

  public function creadoIsSet($option, $value) { 
    return $this->_exists($this->mapping->creado(), $option, settypebool($value));
  }

  public function archivo($option, $value) { 
    $field = $this->mapping->archivo();
    if($c = $this->_exists($field, $option, $value)) return $c;
    if($c = $this->_approx($field, $option, $value)) return $c;
    $this->value->setArchivo($value);
    if(!$this->value->checkArchivo()) throw new Exception("Valor incorrecto: Archivo");
    return "({$field} {$option} {$this->value->sqlArchivo()})";  
  }

  public function archivoIsSet($option, $value) { 
    return $this->_exists($this->mapping->archivo(), $option, settypebool($value));
  }

  public function persona($option, $value) { 
    $field = $this->mapping->persona();
    if($c = $this->_exists($field, $option, $value)) return $c;
    if($c = $this->_approx($field, $option, $value)) return $c;
    $this->value->setPersona($value);
    if(!$this->value->checkPersona()) throw new Exception("Valor incorrecto: Persona");
    return "({$field} {$option} {$this->value->sqlPersona()})";  
  }

  public function personaIsSet($option, $value) { 
    return $this->_exists($this->mapping->persona(), $option, settypebool($value));
  }




}
