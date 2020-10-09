<?php
require_once("class/model/entityOptions/Condition.php");

class _CalendarioCondition extends ConditionEntityOptions{

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

  public function inicio($option, $value) { 
    $field = $this->mapping->inicio();
    if($c = $this->sql->exists($field, $option, $value)) return $c;
    if($c = $this->sql->approxCast($field, $option, $value)) return $c;
    $this->value->setInicio($value);
    if(!$this->value->checkInicio()) throw new Exception("Valor incorrecto: Inicio ");
    return "({$field} {$option} {$this->value->sqlInicio()})";  
  }

  public function inicioYm($option, $value) { 
    $field = $this->mapping->inicioYm();
    if($c = $this->sql->exists($field, $option, $value)) return $c;
    if($c = $this->sql->approxCast($field, $option, $value)) return $c;
    $this->value->setInicio($value);
    if(!$this->value->checkInicio()) throw new Exception("Valor incorrecto: Inicio Ym");
    return "({$field} {$option} {$this->value->sqlInicioYm()})";  
  }

  public function inicioY($option, $value) { 
    $field = $this->mapping->inicioY();
    if($c = $this->sql->exists($field, $option, $value)) return $c;
    if($c = $this->sql->approxCast($field, $option, $value)) return $c;
    $this->value->setInicioY($value);
    if(!$this->value->checkInicio()) throw new Exception("Valor incorrecto: Inicio Y");
    return "({$field} {$option} {$this->value->sqlInicioY()})";  
  }

  public function inicioIsSet($option, $value) { 
    return $this->sql->exists($this->mapping->inicio(), $option, settypebool($value));
  }

  public function fin($option, $value) { 
    $field = $this->mapping->fin();
    if($c = $this->sql->exists($field, $option, $value)) return $c;
    if($c = $this->sql->approxCast($field, $option, $value)) return $c;
    $this->value->setFin($value);
    if(!$this->value->checkFin()) throw new Exception("Valor incorrecto: Fin ");
    return "({$field} {$option} {$this->value->sqlFin()})";  
  }

  public function finYm($option, $value) { 
    $field = $this->mapping->finYm();
    if($c = $this->sql->exists($field, $option, $value)) return $c;
    if($c = $this->sql->approxCast($field, $option, $value)) return $c;
    $this->value->setFin($value);
    if(!$this->value->checkFin()) throw new Exception("Valor incorrecto: Fin Ym");
    return "({$field} {$option} {$this->value->sqlFinYm()})";  
  }

  public function finY($option, $value) { 
    $field = $this->mapping->finY();
    if($c = $this->sql->exists($field, $option, $value)) return $c;
    if($c = $this->sql->approxCast($field, $option, $value)) return $c;
    $this->value->setFinY($value);
    if(!$this->value->checkFin()) throw new Exception("Valor incorrecto: Fin Y");
    return "({$field} {$option} {$this->value->sqlFinY()})";  
  }

  public function finIsSet($option, $value) { 
    return $this->sql->exists($this->mapping->fin(), $option, settypebool($value));
  }

  public function anio($option, $value) { 
    $field = $this->mapping->anio();
    if($c = $this->sql->exists($field, $option, $value)) return $c;
    if($c = $this->sql->approxCast($field, $option, $value)) return $c;
    $this->value->setAnio($value);
    if(!$this->value->checkAnio()) throw new Exception("Valor incorrecto: Anio ");
    return "({$field} {$option} {$this->value->sqlAnio()})";  
  }

    public function anioIsSet($option, $value) { 
    return $this->sql->exists($this->mapping->anio(), $option, settypebool($value));
  }

  public function semestre($option, $value) { 
    $field = $this->mapping->semestre();
    if($c = $this->sql->exists($field, $option, $value)) return $c;
    if($c = $this->sql->approxCast($field, $option, $value)) return $c;
    $this->value->setSemestre($value);
    if(!$this->value->checkSemestre()) throw new Exception("Valor incorrecto: Semestre ");
    return "({$field} {$option} {$this->value->sqlSemestre()})";  
  }

    public function semestreIsSet($option, $value) { 
    return $this->sql->exists($this->mapping->semestre(), $option, settypebool($value));
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
    return $this->sql->exists($this->mapping->insertado(), $option, settypebool($value));
  }




}
