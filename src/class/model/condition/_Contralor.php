<?php
require_once("class/model/entityOptions/Condition.php");

class _ContralorCondition extends ConditionEntityOptions{

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

  public function fechaContralor($option, $value) { 
    $field = $this->mapping->fechaContralor();
    if($c = $this->_exists($field, $option, $value)) return $c;
    if($c = $this->_approxCast($field, $option, $value)) return $c;
    $this->value->setFechaContralor($value);
    if(!$this->value->checkFechaContralor()) throw new Exception("Valor incorrecto: Fecha Contralor ");
    return "({$field} {$option} {$this->value->sqlFechaContralor()})";  
  }

  public function fechaContralorYm($option, $value) { 
    $field = $this->mapping->fechaContralorYm();
    if($c = $this->_exists($field, $option, $value)) return $c;
    if($c = $this->_approxCast($field, $option, $value)) return $c;
    $this->value->setFechaContralor($value);
    if(!$this->value->checkFechaContralor()) throw new Exception("Valor incorrecto: Fecha Contralor Ym");
    return "({$field} {$option} {$this->value->sqlFechaContralorYm()})";  
  }

  public function fechaContralorY($option, $value) { 
    $field = $this->mapping->fechaContralorY();
    if($c = $this->_exists($field, $option, $value)) return $c;
    if($c = $this->_approxCast($field, $option, $value)) return $c;
    $this->value->setFechaContralorY($value);
    if(!$this->value->checkFechaContralor()) throw new Exception("Valor incorrecto: Fecha Contralor Y");
    return "({$field} {$option} {$this->value->sqlFechaContralorY()})";  
  }

  public function fechaContralorIsSet($option, $value) { 
    return $this->_exists($this->mapping->fechaContralor(), $option, settypebool($value));
  }

  public function fechaConsejo($option, $value) { 
    $field = $this->mapping->fechaConsejo();
    if($c = $this->_exists($field, $option, $value)) return $c;
    if($c = $this->_approxCast($field, $option, $value)) return $c;
    $this->value->setFechaConsejo($value);
    if(!$this->value->checkFechaConsejo()) throw new Exception("Valor incorrecto: Fecha Consejo ");
    return "({$field} {$option} {$this->value->sqlFechaConsejo()})";  
  }

  public function fechaConsejoYm($option, $value) { 
    $field = $this->mapping->fechaConsejoYm();
    if($c = $this->_exists($field, $option, $value)) return $c;
    if($c = $this->_approxCast($field, $option, $value)) return $c;
    $this->value->setFechaConsejo($value);
    if(!$this->value->checkFechaConsejo()) throw new Exception("Valor incorrecto: Fecha Consejo Ym");
    return "({$field} {$option} {$this->value->sqlFechaConsejoYm()})";  
  }

  public function fechaConsejoY($option, $value) { 
    $field = $this->mapping->fechaConsejoY();
    if($c = $this->_exists($field, $option, $value)) return $c;
    if($c = $this->_approxCast($field, $option, $value)) return $c;
    $this->value->setFechaConsejoY($value);
    if(!$this->value->checkFechaConsejo()) throw new Exception("Valor incorrecto: Fecha Consejo Y");
    return "({$field} {$option} {$this->value->sqlFechaConsejoY()})";  
  }

  public function fechaConsejoIsSet($option, $value) { 
    return $this->_exists($this->mapping->fechaConsejo(), $option, settypebool($value));
  }

  public function insertado($option, $value) { 
    $field = $this->mapping->insertado();
    if($c = $this->_exists($field, $option, $value)) return $c;
    if($c = $this->_approxCast($field, $option, $value)) return $c;
    $this->value->setInsertado($value);
    if(!$this->value->checkInsertado()) throw new Exception("Valor incorrecto: Insertado ");
    return "({$field} {$option} {$this->value->sqlInsertado()})";  
  }

  public function insertadoDate($option, $value) { 
    $field = $this->mapping->insertadoDate();
    if($c = $this->_exists($field, $option, $value)) return $c;
    if($c = $this->_approxCast($field, $option, $value)) return $c;
    $this->value->setInsertado($value);
    if(!$this->value->checkInsertado()) throw new Exception("Valor incorrecto: Insertado Date");
    return "({$field} {$option} {$this->value->sqlInsertadoDate()})";  
  }

  public function insertadoYm($option, $value) { 
    $field = $this->mapping->insertadoYm();
    if($c = $this->_exists($field, $option, $value)) return $c;
    if($c = $this->_approxCast($field, $option, $value)) return $c;
    $this->value->setInsertado($value);
    if(!$this->value->checkInsertado()) throw new Exception("Valor incorrecto: Insertado Ym");
    return "({$field} {$option} {$this->value->sqlInsertadoYm()})";  
  }

  public function insertadoY($option, $value) { 
    $field = $this->mapping->insertadoY();
    if($c = $this->_exists($field, $option, $value)) return $c;
    if($c = $this->_approxCast($field, $option, $value)) return $c;
    $this->value->setInsertadoY($value);
    if(!$this->value->checkInsertado()) throw new Exception("Valor incorrecto: Insertado Y");
    return "({$field} {$option} {$this->value->sqlInsertadoY()})";  
  }

  public function insertadoIsSet($option, $value) { 
    return $this->_exists($this->mapping->insertado(), $option, settypebool($value));
  }

  public function planillaDocente($option, $value) { 
    $field = $this->mapping->planillaDocente();
    if($c = $this->_exists($field, $option, $value)) return $c;
    if($c = $this->_approx($field, $option, $value)) return $c;
    $this->value->setPlanillaDocente($value);
    if(!$this->value->checkPlanillaDocente()) throw new Exception("Valor incorrecto: Planilla Docente");
    return "({$field} {$option} {$this->value->sqlPlanillaDocente()})";  
  }

  public function planillaDocenteIsSet($option, $value) { 
    return $this->_exists($this->mapping->planillaDocente(), $option, settypebool($value));
  }




}
