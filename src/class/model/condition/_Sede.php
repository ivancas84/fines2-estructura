<?php
require_once("class/model/entityOptions/Condition.php");

class _SedeCondition extends ConditionEntityOptions{

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

  public function nombre($option, $value) { 
    $field = $this->mapping->nombre();
    if($c = $this->_exists($field, $option, $value)) return $c;
    if($c = $this->_approx($field, $option, $value)) return $c;
    $this->value->setNombre($value);
    if(!$this->value->checkNombre()) throw new Exception("Valor incorrecto: Nombre ");
    return "({$field} {$option} {$this->value->sqlNombre()})";  
  }

  public function nombreIsSet($option, $value) { 
    return $this->_exists($this->mapping->nombre(), $option, settypebool($value));
  }

  public function observaciones($option, $value) { 
    $field = $this->mapping->observaciones();
    if($c = $this->_exists($field, $option, $value)) return $c;
    if($c = $this->_approx($field, $option, $value)) return $c;
    $this->value->setObservaciones($value);
    if(!$this->value->checkObservaciones()) throw new Exception("Valor incorrecto: Observaciones ");
    return "({$field} {$option} {$this->value->sqlObservaciones()})";  
  }

  public function observacionesIsSet($option, $value) { 
    return $this->_exists($this->mapping->observaciones(), $option, settypebool($value));
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

  public function baja($option, $value) { 
    $field = $this->mapping->baja();
    if($c = $this->_exists($field, $option, $value)) return $c;
    if($c = $this->_approxCast($field, $option, $value)) return $c;
    $this->value->setBaja($value);
    if(!$this->value->checkBaja()) throw new Exception("Valor incorrecto: Baja ");
    return "({$field} {$option} {$this->value->sqlBaja()})";  
  }

  public function bajaDate($option, $value) { 
    $field = $this->mapping->bajaDate();
    if($c = $this->_exists($field, $option, $value)) return $c;
    if($c = $this->_approxCast($field, $option, $value)) return $c;
    $this->value->setBaja($value);
    if(!$this->value->checkBaja()) throw new Exception("Valor incorrecto: Baja Date");
    return "({$field} {$option} {$this->value->sqlBajaDate()})";  
  }

  public function bajaYm($option, $value) { 
    $field = $this->mapping->bajaYm();
    if($c = $this->_exists($field, $option, $value)) return $c;
    if($c = $this->_approxCast($field, $option, $value)) return $c;
    $this->value->setBaja($value);
    if(!$this->value->checkBaja()) throw new Exception("Valor incorrecto: Baja Ym");
    return "({$field} {$option} {$this->value->sqlBajaYm()})";  
  }

  public function bajaY($option, $value) { 
    $field = $this->mapping->bajaY();
    if($c = $this->_exists($field, $option, $value)) return $c;
    if($c = $this->_approxCast($field, $option, $value)) return $c;
    $this->value->setBajaY($value);
    if(!$this->value->checkBaja()) throw new Exception("Valor incorrecto: Baja Y");
    return "({$field} {$option} {$this->value->sqlBajaY()})";  
  }

  public function bajaIsSet($option, $value) { 
    return $this->_exists($this->mapping->baja(), $option, settypebool($value));
  }

  public function domicilio($option, $value) { 
    $field = $this->mapping->domicilio();
    if($c = $this->_exists($field, $option, $value)) return $c;
    if($c = $this->_approx($field, $option, $value)) return $c;
    $this->value->setDomicilio($value);
    if(!$this->value->checkDomicilio()) throw new Exception("Valor incorrecto: Domicilio ");
    return "({$field} {$option} {$this->value->sqlDomicilio()})";  
  }

  public function domicilioIsSet($option, $value) { 
    return $this->_exists($this->mapping->domicilio(), $option, settypebool($value));
  }

  public function tipoSede($option, $value) { 
    $field = $this->mapping->tipoSede();
    if($c = $this->_exists($field, $option, $value)) return $c;
    if($c = $this->_approx($field, $option, $value)) return $c;
    $this->value->setTipoSede($value);
    if(!$this->value->checkTipoSede()) throw new Exception("Valor incorrecto: Tipo Sede ");
    return "({$field} {$option} {$this->value->sqlTipoSede()})";  
  }

  public function tipoSedeIsSet($option, $value) { 
    return $this->_exists($this->mapping->tipoSede(), $option, settypebool($value));
  }

  public function centroEducativo($option, $value) { 
    $field = $this->mapping->centroEducativo();
    if($c = $this->_exists($field, $option, $value)) return $c;
    if($c = $this->_approx($field, $option, $value)) return $c;
    $this->value->setCentroEducativo($value);
    if(!$this->value->checkCentroEducativo()) throw new Exception("Valor incorrecto: Centro Educativo ");
    return "({$field} {$option} {$this->value->sqlCentroEducativo()})";  
  }

  public function centroEducativoIsSet($option, $value) { 
    return $this->_exists($this->mapping->centroEducativo(), $option, settypebool($value));
  }




}
