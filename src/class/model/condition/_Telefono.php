<?php
require_once("class/model/entityOptions/Condition.php");

class _TelefonoCondition extends ConditionEntityOptions{

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

  public function tipo($option, $value) { 
    $field = $this->mapping->tipo();
    if($c = $this->sql->exists($field, $option, $value)) return $c;
    if($c = $this->sql->approx($field, $option, $value)) return $c;
    $this->value->setTipo($value);
    if(!$this->value->checkTipo()) throw new Exception("Valor incorrecto: Tipo");
    return "({$field} {$option} {$this->value->sqlTipo()})";  
  }

  public function tipoIsSet($option, $value) { 
    return $this->_exists($this->mapping->tipo(), $option, settypebool($value));
  }

  public function prefijo($option, $value) { 
    $field = $this->mapping->prefijo();
    if($c = $this->sql->exists($field, $option, $value)) return $c;
    if($c = $this->sql->approx($field, $option, $value)) return $c;
    $this->value->setPrefijo($value);
    if(!$this->value->checkPrefijo()) throw new Exception("Valor incorrecto: Prefijo");
    return "({$field} {$option} {$this->value->sqlPrefijo()})";  
  }

  public function prefijoIsSet($option, $value) { 
    return $this->_exists($this->mapping->prefijo(), $option, settypebool($value));
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

  public function eliminado($option, $value) { 
    $field = $this->mapping->eliminado();
    if($c = $this->sql->exists($field, $option, $value)) return $c;
    if($c = $this->sql->approxCast($field, $option, $value)) return $c;
    $this->value->setEliminado($value);
    if(!$this->value->checkEliminado()) throw new Exception("Valor incorrecto: Eliminado ");
    return "({$field} {$option} {$this->value->sqlEliminado()})";  
  }

  public function eliminadoDate($option, $value) { 
    $field = $this->mapping->eliminadoDate();
    if($c = $this->sql->exists($field, $option, $value)) return $c;
    if($c = $this->sql->approxCast($field, $option, $value)) return $c;
    $this->value->setEliminado($value);
    if(!$this->value->checkEliminado()) throw new Exception("Valor incorrecto: Eliminado Date");
    return "({$field} {$option} {$this->value->sqlEliminadoDate()})";  
  }

  public function eliminadoYm($option, $value) { 
    $field = $this->mapping->eliminadoYm();
    if($c = $this->sql->exists($field, $option, $value)) return $c;
    if($c = $this->sql->approxCast($field, $option, $value)) return $c;
    $this->value->setEliminado($value);
    if(!$this->value->checkEliminado()) throw new Exception("Valor incorrecto: Eliminado Ym");
    return "({$field} {$option} {$this->value->sqlEliminadoYm()})";  
  }

  public function eliminadoY($option, $value) { 
    $field = $this->mapping->eliminadoY();
    if($c = $this->sql->exists($field, $option, $value)) return $c;
    if($c = $this->sql->approxCast($field, $option, $value)) return $c;
    $this->value->setEliminadoY($value);
    if(!$this->value->checkEliminado()) throw new Exception("Valor incorrecto: Eliminado Y");
    return "({$field} {$option} {$this->value->sqlEliminadoY()})";  
  }

  public function eliminadoIsSet($option, $value) { 
    return $this->_exists($this->mapping->eliminado(), $option, settypebool($value));
  }

  public function persona($option, $value) { 
    $field = $this->mapping->persona();
    if($c = $this->sql->exists($field, $option, $value)) return $c;
    if($c = $this->sql->approx($field, $option, $value)) return $c;
    $this->value->setPersona($value);
    if(!$this->value->checkPersona()) throw new Exception("Valor incorrecto: Persona");
    return "({$field} {$option} {$this->value->sqlPersona()})";  
  }

  public function personaIsSet($option, $value) { 
    return $this->_exists($this->mapping->persona(), $option, settypebool($value));
  }




}
