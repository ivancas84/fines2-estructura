<?php
require_once("class/model/entityOptions/Condition.php");

class _PersonaCondition extends ConditionEntityOptions{

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

  public function nombres($option, $value) { 
    $field = $this->mapping->nombres();
    if($c = $this->_exists($field, $option, $value)) return $c;
    if($c = $this->_approx($field, $option, $value)) return $c;
    $this->value->setNombres($value);
    if(!$this->value->checkNombres()) throw new Exception("Valor incorrecto: Nombres ");
    return "({$field} {$option} {$this->value->sqlNombres()})";  
  }

  public function nombresIsSet($option, $value) { 
    return $this->_exists($this->mapping->nombres(), $option, settypebool($value));
  }

  public function apellidos($option, $value) { 
    $field = $this->mapping->apellidos();
    if($c = $this->_exists($field, $option, $value)) return $c;
    if($c = $this->_approx($field, $option, $value)) return $c;
    $this->value->setApellidos($value);
    if(!$this->value->checkApellidos()) throw new Exception("Valor incorrecto: Apellidos ");
    return "({$field} {$option} {$this->value->sqlApellidos()})";  
  }

  public function apellidosIsSet($option, $value) { 
    return $this->_exists($this->mapping->apellidos(), $option, settypebool($value));
  }

  public function fechaNacimiento($option, $value) { 
    $field = $this->mapping->fechaNacimiento();
    if($c = $this->_exists($field, $option, $value)) return $c;
    if($c = $this->_approxCast($field, $option, $value)) return $c;
    $this->value->setFechaNacimiento($value);
    if(!$this->value->checkFechaNacimiento()) throw new Exception("Valor incorrecto: Fecha Nacimiento ");
    return "({$field} {$option} {$this->value->sqlFechaNacimiento()})";  
  }

  public function fechaNacimientoYm($option, $value) { 
    $field = $this->mapping->fechaNacimientoYm();
    if($c = $this->_exists($field, $option, $value)) return $c;
    if($c = $this->_approxCast($field, $option, $value)) return $c;
    $this->value->setFechaNacimiento($value);
    if(!$this->value->checkFechaNacimiento()) throw new Exception("Valor incorrecto: Fecha Nacimiento Ym");
    return "({$field} {$option} {$this->value->sqlFechaNacimientoYm()})";  
  }

  public function fechaNacimientoY($option, $value) { 
    $field = $this->mapping->fechaNacimientoY();
    if($c = $this->_exists($field, $option, $value)) return $c;
    if($c = $this->_approxCast($field, $option, $value)) return $c;
    $this->value->setFechaNacimientoY($value);
    if(!$this->value->checkFechaNacimiento()) throw new Exception("Valor incorrecto: Fecha Nacimiento Y");
    return "({$field} {$option} {$this->value->sqlFechaNacimientoY()})";  
  }

  public function fechaNacimientoIsSet($option, $value) { 
    return $this->_exists($this->mapping->fechaNacimiento(), $option, settypebool($value));
  }

  public function numeroDocumento($option, $value) { 
    $field = $this->mapping->numeroDocumento();
    if($c = $this->_exists($field, $option, $value)) return $c;
    if($c = $this->_approx($field, $option, $value)) return $c;
    $this->value->setNumeroDocumento($value);
    if(!$this->value->checkNumeroDocumento()) throw new Exception("Valor incorrecto: Numero Documento ");
    return "({$field} {$option} {$this->value->sqlNumeroDocumento()})";  
  }

  public function numeroDocumentoIsSet($option, $value) { 
    return $this->_exists($this->mapping->numeroDocumento(), $option, settypebool($value));
  }

  public function cuil($option, $value) { 
    $field = $this->mapping->cuil();
    if($c = $this->_exists($field, $option, $value)) return $c;
    if($c = $this->_approx($field, $option, $value)) return $c;
    $this->value->setCuil($value);
    if(!$this->value->checkCuil()) throw new Exception("Valor incorrecto: Cuil ");
    return "({$field} {$option} {$this->value->sqlCuil()})";  
  }

  public function cuilIsSet($option, $value) { 
    return $this->_exists($this->mapping->cuil(), $option, settypebool($value));
  }

  public function genero($option, $value) { 
    $field = $this->mapping->genero();
    if($c = $this->_exists($field, $option, $value)) return $c;
    if($c = $this->_approx($field, $option, $value)) return $c;
    $this->value->setGenero($value);
    if(!$this->value->checkGenero()) throw new Exception("Valor incorrecto: Genero ");
    return "({$field} {$option} {$this->value->sqlGenero()})";  
  }

  public function generoIsSet($option, $value) { 
    return $this->_exists($this->mapping->genero(), $option, settypebool($value));
  }

  public function apodo($option, $value) { 
    $field = $this->mapping->apodo();
    if($c = $this->_exists($field, $option, $value)) return $c;
    if($c = $this->_approx($field, $option, $value)) return $c;
    $this->value->setApodo($value);
    if(!$this->value->checkApodo()) throw new Exception("Valor incorrecto: Apodo ");
    return "({$field} {$option} {$this->value->sqlApodo()})";  
  }

  public function apodoIsSet($option, $value) { 
    return $this->_exists($this->mapping->apodo(), $option, settypebool($value));
  }

  public function telefono($option, $value) { 
    $field = $this->mapping->telefono();
    if($c = $this->_exists($field, $option, $value)) return $c;
    if($c = $this->_approx($field, $option, $value)) return $c;
    $this->value->setTelefono($value);
    if(!$this->value->checkTelefono()) throw new Exception("Valor incorrecto: Telefono ");
    return "({$field} {$option} {$this->value->sqlTelefono()})";  
  }

  public function telefonoIsSet($option, $value) { 
    return $this->_exists($this->mapping->telefono(), $option, settypebool($value));
  }

  public function email($option, $value) { 
    $field = $this->mapping->email();
    if($c = $this->_exists($field, $option, $value)) return $c;
    if($c = $this->_approx($field, $option, $value)) return $c;
    $this->value->setEmail($value);
    if(!$this->value->checkEmail()) throw new Exception("Valor incorrecto: Email ");
    return "({$field} {$option} {$this->value->sqlEmail()})";  
  }

  public function emailIsSet($option, $value) { 
    return $this->_exists($this->mapping->email(), $option, settypebool($value));
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




}
