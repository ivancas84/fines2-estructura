<?php
require_once("class/model/entityOptions/Condition.php");

class _ComisionCondition extends ConditionEntityOptions{

  public function id($option, $value) { 
    $field = $this->mapping->id();
    if($c = $this->sql->exists($field, $option, $value)) return $c;
    if($c = $this->sql->approx($field, $option, $value)) return $c;
    $this->value->setId($value);
    if(!$this->value->checkId()) throw new Exception("Valor incorrecto: Id");
    return "({$field} {$option} {$this->value->sqlId()})";  
  }

  public function idIsSet($option, $value) { 
    return $this->sql->exists($this->mapping->id(), $option, settypebool($value));
  }

  public function turno($option, $value) { 
    $field = $this->mapping->turno();
    if($c = $this->sql->exists($field, $option, $value)) return $c;
    if($c = $this->sql->approx($field, $option, $value)) return $c;
    $this->value->setTurno($value);
    if(!$this->value->checkTurno()) throw new Exception("Valor incorrecto: Turno");
    return "({$field} {$option} {$this->value->sqlTurno()})";  
  }

  public function turnoIsSet($option, $value) { 
    return $this->sql->exists($this->mapping->turno(), $option, settypebool($value));
  }

  public function division($option, $value) { 
    $field = $this->mapping->division();
    if($c = $this->sql->exists($field, $option, $value)) return $c;
    if($c = $this->sql->approx($field, $option, $value)) return $c;
    $this->value->setDivision($value);
    if(!$this->value->checkDivision()) throw new Exception("Valor incorrecto: Division");
    return "({$field} {$option} {$this->value->sqlDivision()})";  
  }

  public function divisionIsSet($option, $value) { 
    return $this->sql->exists($this->mapping->division(), $option, settypebool($value));
  }

  public function comentario($option, $value) { 
    $field = $this->mapping->comentario();
    if($c = $this->sql->exists($field, $option, $value)) return $c;
    if($c = $this->sql->approx($field, $option, $value)) return $c;
    $this->value->setComentario($value);
    if(!$this->value->checkComentario()) throw new Exception("Valor incorrecto: Comentario");
    return "({$field} {$option} {$this->value->sqlComentario()})";  
  }

  public function comentarioIsSet($option, $value) { 
    return $this->sql->exists($this->mapping->comentario(), $option, settypebool($value));
  }

  public function autorizada($option, $value) { 
    $field = $this->mapping->autorizada();
    if($c = $this->sql->exists($field, $option, $value)) return $c;
    $this->value->setAutorizada($value);
    if(!$this->value->checkAutorizada()) throw new Exception("Valor incorrecto: Autorizada ");
    return "({$field} {$option} {$this->value->sqlAutorizada()})";  
  }
  
  public function apertura($option, $value) { 
    $field = $this->mapping->apertura();
    if($c = $this->sql->exists($field, $option, $value)) return $c;
    $this->value->setApertura($value);
    if(!$this->value->checkApertura()) throw new Exception("Valor incorrecto: Apertura ");
    return "({$field} {$option} {$this->value->sqlApertura()})";  
  }
  
  public function publicada($option, $value) { 
    $field = $this->mapping->publicada();
    if($c = $this->sql->exists($field, $option, $value)) return $c;
    $this->value->setPublicada($value);
    if(!$this->value->checkPublicada()) throw new Exception("Valor incorrecto: Publicada ");
    return "({$field} {$option} {$this->value->sqlPublicada()})";  
  }
  
  public function observaciones($option, $value) { 
    $field = $this->mapping->observaciones();
    if($c = $this->sql->exists($field, $option, $value)) return $c;
    if($c = $this->sql->approx($field, $option, $value)) return $c;
    $this->value->setObservaciones($value);
    if(!$this->value->checkObservaciones()) throw new Exception("Valor incorrecto: Observaciones");
    return "({$field} {$option} {$this->value->sqlObservaciones()})";  
  }

  public function observacionesIsSet($option, $value) { 
    return $this->sql->exists($this->mapping->observaciones(), $option, settypebool($value));
  }

  public function alta($option, $value) { 
    $field = $this->mapping->alta();
    if($c = $this->sql->exists($field, $option, $value)) return $c;
    if($c = $this->sql->approxCast($field, $option, $value)) return $c;
    $this->value->setAlta($value);
    if(!$this->value->checkAlta()) throw new Exception("Valor incorrecto: Alta ");
    return "({$field} {$option} {$this->value->sqlAlta()})";  
  }

  public function altaDate($option, $value) { 
    $field = $this->mapping->altaDate();
    if($c = $this->sql->exists($field, $option, $value)) return $c;
    if($c = $this->sql->approxCast($field, $option, $value)) return $c;
    $this->value->setAlta($value);
    if(!$this->value->checkAlta()) throw new Exception("Valor incorrecto: Alta Date");
    return "({$field} {$option} {$this->value->sqlAltaDate()})";  
  }

  public function altaYm($option, $value) { 
    $field = $this->mapping->altaYm();
    if($c = $this->sql->exists($field, $option, $value)) return $c;
    if($c = $this->sql->approxCast($field, $option, $value)) return $c;
    $this->value->setAlta($value);
    if(!$this->value->checkAlta()) throw new Exception("Valor incorrecto: Alta Ym");
    return "({$field} {$option} {$this->value->sqlAltaYm()})";  
  }

  public function altaY($option, $value) { 
    $field = $this->mapping->altaY();
    if($c = $this->sql->exists($field, $option, $value)) return $c;
    if($c = $this->sql->approxCast($field, $option, $value)) return $c;
    $this->value->setAltaY($value);
    if(!$this->value->checkAlta()) throw new Exception("Valor incorrecto: Alta Y");
    return "({$field} {$option} {$this->value->sqlAltaY()})";  
  }

  public function altaIsSet($option, $value) { 
    return $this->sql->exists($this->mapping->alta(), $option, settypebool($value));
  }

  public function identificacion($option, $value) { 
    $field = $this->mapping->identificacion();
    if($c = $this->sql->exists($field, $option, $value)) return $c;
    if($c = $this->sql->approx($field, $option, $value)) return $c;
    $this->value->setIdentificacion($value);
    if(!$this->value->checkIdentificacion()) throw new Exception("Valor incorrecto: Identificacion");
    return "({$field} {$option} {$this->value->sqlIdentificacion()})";  
  }

  public function identificacionIsSet($option, $value) { 
    return $this->sql->exists($this->mapping->identificacion(), $option, settypebool($value));
  }

  public function sede($option, $value) { 
    $field = $this->mapping->sede();
    if($c = $this->sql->exists($field, $option, $value)) return $c;
    if($c = $this->sql->approx($field, $option, $value)) return $c;
    $this->value->setSede($value);
    if(!$this->value->checkSede()) throw new Exception("Valor incorrecto: Sede");
    return "({$field} {$option} {$this->value->sqlSede()})";  
  }

  public function sedeIsSet($option, $value) { 
    return $this->sql->exists($this->mapping->sede(), $option, settypebool($value));
  }

  public function modalidad($option, $value) { 
    $field = $this->mapping->modalidad();
    if($c = $this->sql->exists($field, $option, $value)) return $c;
    if($c = $this->sql->approx($field, $option, $value)) return $c;
    $this->value->setModalidad($value);
    if(!$this->value->checkModalidad()) throw new Exception("Valor incorrecto: Modalidad");
    return "({$field} {$option} {$this->value->sqlModalidad()})";  
  }

  public function modalidadIsSet($option, $value) { 
    return $this->sql->exists($this->mapping->modalidad(), $option, settypebool($value));
  }

  public function planificacion($option, $value) { 
    $field = $this->mapping->planificacion();
    if($c = $this->sql->exists($field, $option, $value)) return $c;
    if($c = $this->sql->approx($field, $option, $value)) return $c;
    $this->value->setPlanificacion($value);
    if(!$this->value->checkPlanificacion()) throw new Exception("Valor incorrecto: Planificacion");
    return "({$field} {$option} {$this->value->sqlPlanificacion()})";  
  }

  public function planificacionIsSet($option, $value) { 
    return $this->sql->exists($this->mapping->planificacion(), $option, settypebool($value));
  }

  public function comisionSiguiente($option, $value) { 
    $field = $this->mapping->comisionSiguiente();
    if($c = $this->sql->exists($field, $option, $value)) return $c;
    if($c = $this->sql->approx($field, $option, $value)) return $c;
    $this->value->setComisionSiguiente($value);
    if(!$this->value->checkComisionSiguiente()) throw new Exception("Valor incorrecto: Comision Siguiente");
    return "({$field} {$option} {$this->value->sqlComisionSiguiente()})";  
  }

  public function comisionSiguienteIsSet($option, $value) { 
    return $this->sql->exists($this->mapping->comisionSiguiente(), $option, settypebool($value));
  }

  public function calendario($option, $value) { 
    $field = $this->mapping->calendario();
    if($c = $this->sql->exists($field, $option, $value)) return $c;
    if($c = $this->sql->approx($field, $option, $value)) return $c;
    $this->value->setCalendario($value);
    if(!$this->value->checkCalendario()) throw new Exception("Valor incorrecto: Calendario");
    return "({$field} {$option} {$this->value->sqlCalendario()})";  
  }

  public function calendarioIsSet($option, $value) { 
    return $this->sql->exists($this->mapping->calendario(), $option, settypebool($value));
  }




}
