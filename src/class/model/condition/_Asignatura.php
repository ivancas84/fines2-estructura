<?php
require_once("class/model/entityOptions/Condition.php");

class _AsignaturaCondition extends ConditionEntityOptions{

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

  public function formacion($option, $value) { 
    $field = $this->mapping->formacion();
    if($c = $this->sql->exists($field, $option, $value)) return $c;
    if($c = $this->sql->approx($field, $option, $value)) return $c;
    $this->value->setFormacion($value);
    if(!$this->value->checkFormacion()) throw new Exception("Valor incorrecto: Formacion");
    return "({$field} {$option} {$this->value->sqlFormacion()})";  
  }

  public function formacionIsSet($option, $value) { 
    return $this->_exists($this->mapping->formacion(), $option, settypebool($value));
  }

  public function clasificacion($option, $value) { 
    $field = $this->mapping->clasificacion();
    if($c = $this->sql->exists($field, $option, $value)) return $c;
    if($c = $this->sql->approx($field, $option, $value)) return $c;
    $this->value->setClasificacion($value);
    if(!$this->value->checkClasificacion()) throw new Exception("Valor incorrecto: Clasificacion");
    return "({$field} {$option} {$this->value->sqlClasificacion()})";  
  }

  public function clasificacionIsSet($option, $value) { 
    return $this->_exists($this->mapping->clasificacion(), $option, settypebool($value));
  }

  public function codigo($option, $value) { 
    $field = $this->mapping->codigo();
    if($c = $this->sql->exists($field, $option, $value)) return $c;
    if($c = $this->sql->approx($field, $option, $value)) return $c;
    $this->value->setCodigo($value);
    if(!$this->value->checkCodigo()) throw new Exception("Valor incorrecto: Codigo");
    return "({$field} {$option} {$this->value->sqlCodigo()})";  
  }

  public function codigoIsSet($option, $value) { 
    return $this->_exists($this->mapping->codigo(), $option, settypebool($value));
  }

  public function perfil($option, $value) { 
    $field = $this->mapping->perfil();
    if($c = $this->sql->exists($field, $option, $value)) return $c;
    if($c = $this->sql->approx($field, $option, $value)) return $c;
    $this->value->setPerfil($value);
    if(!$this->value->checkPerfil()) throw new Exception("Valor incorrecto: Perfil");
    return "({$field} {$option} {$this->value->sqlPerfil()})";  
  }

  public function perfilIsSet($option, $value) { 
    return $this->_exists($this->mapping->perfil(), $option, settypebool($value));
  }




}
