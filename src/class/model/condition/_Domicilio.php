<?php
require_once("class/model/entityOptions/Condition.php");

class _DomicilioCondition extends ConditionEntityOptions{

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

  public function calle($option, $value) { 
    $field = $this->mapping->calle();
    if($c = $this->_exists($field, $option, $value)) return $c;
    if($c = $this->_approx($field, $option, $value)) return $c;
    $this->value->setCalle($value);
    if(!$this->value->checkCalle()) throw new Exception("Valor incorrecto: Calle ");
    return "({$field} {$option} {$this->value->sqlCalle()})";  
  }

  public function calleIsSet($option, $value) { 
    return $this->_exists($this->mapping->calle(), $option, settypebool($value));
  }

  public function entre($option, $value) { 
    $field = $this->mapping->entre();
    if($c = $this->_exists($field, $option, $value)) return $c;
    if($c = $this->_approx($field, $option, $value)) return $c;
    $this->value->setEntre($value);
    if(!$this->value->checkEntre()) throw new Exception("Valor incorrecto: Entre ");
    return "({$field} {$option} {$this->value->sqlEntre()})";  
  }

  public function entreIsSet($option, $value) { 
    return $this->_exists($this->mapping->entre(), $option, settypebool($value));
  }

  public function numero($option, $value) { 
    $field = $this->mapping->numero();
    if($c = $this->_exists($field, $option, $value)) return $c;
    if($c = $this->_approx($field, $option, $value)) return $c;
    $this->value->setNumero($value);
    if(!$this->value->checkNumero()) throw new Exception("Valor incorrecto: Numero ");
    return "({$field} {$option} {$this->value->sqlNumero()})";  
  }

  public function numeroIsSet($option, $value) { 
    return $this->_exists($this->mapping->numero(), $option, settypebool($value));
  }

  public function piso($option, $value) { 
    $field = $this->mapping->piso();
    if($c = $this->_exists($field, $option, $value)) return $c;
    if($c = $this->_approx($field, $option, $value)) return $c;
    $this->value->setPiso($value);
    if(!$this->value->checkPiso()) throw new Exception("Valor incorrecto: Piso ");
    return "({$field} {$option} {$this->value->sqlPiso()})";  
  }

  public function pisoIsSet($option, $value) { 
    return $this->_exists($this->mapping->piso(), $option, settypebool($value));
  }

  public function departamento($option, $value) { 
    $field = $this->mapping->departamento();
    if($c = $this->_exists($field, $option, $value)) return $c;
    if($c = $this->_approx($field, $option, $value)) return $c;
    $this->value->setDepartamento($value);
    if(!$this->value->checkDepartamento()) throw new Exception("Valor incorrecto: Departamento ");
    return "({$field} {$option} {$this->value->sqlDepartamento()})";  
  }

  public function departamentoIsSet($option, $value) { 
    return $this->_exists($this->mapping->departamento(), $option, settypebool($value));
  }

  public function barrio($option, $value) { 
    $field = $this->mapping->barrio();
    if($c = $this->_exists($field, $option, $value)) return $c;
    if($c = $this->_approx($field, $option, $value)) return $c;
    $this->value->setBarrio($value);
    if(!$this->value->checkBarrio()) throw new Exception("Valor incorrecto: Barrio ");
    return "({$field} {$option} {$this->value->sqlBarrio()})";  
  }

  public function barrioIsSet($option, $value) { 
    return $this->_exists($this->mapping->barrio(), $option, settypebool($value));
  }

  public function localidad($option, $value) { 
    $field = $this->mapping->localidad();
    if($c = $this->_exists($field, $option, $value)) return $c;
    if($c = $this->_approx($field, $option, $value)) return $c;
    $this->value->setLocalidad($value);
    if(!$this->value->checkLocalidad()) throw new Exception("Valor incorrecto: Localidad ");
    return "({$field} {$option} {$this->value->sqlLocalidad()})";  
  }

  public function localidadIsSet($option, $value) { 
    return $this->_exists($this->mapping->localidad(), $option, settypebool($value));
  }




}
