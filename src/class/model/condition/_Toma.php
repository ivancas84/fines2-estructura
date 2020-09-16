<?php
require_once("class/model/entityOptions/Condition.php");

class _TomaCondition extends ConditionEntityOptions{

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

  public function fechaToma($option, $value) { 
    $field = $this->mapping->fechaToma();
    if($c = $this->_exists($field, $option, $value)) return $c;
    if($c = $this->_approxCast($field, $option, $value)) return $c;
    $this->value->setFechaToma($value);
    if(!$this->value->checkFechaToma()) throw new Exception("Valor incorrecto: Fecha Toma ");
    return "({$field} {$option} {$this->value->sqlFechaToma()})";  
  }

  public function fechaTomaYm($option, $value) { 
    $field = $this->mapping->fechaTomaYm();
    if($c = $this->_exists($field, $option, $value)) return $c;
    if($c = $this->_approxCast($field, $option, $value)) return $c;
    $this->value->setFechaToma($value);
    if(!$this->value->checkFechaToma()) throw new Exception("Valor incorrecto: Fecha Toma Ym");
    return "({$field} {$option} {$this->value->sqlFechaTomaYm()})";  
  }

  public function fechaTomaY($option, $value) { 
    $field = $this->mapping->fechaTomaY();
    if($c = $this->_exists($field, $option, $value)) return $c;
    if($c = $this->_approxCast($field, $option, $value)) return $c;
    $this->value->setFechaTomaY($value);
    if(!$this->value->checkFechaToma()) throw new Exception("Valor incorrecto: Fecha Toma Y");
    return "({$field} {$option} {$this->value->sqlFechaTomaY()})";  
  }

  public function fechaTomaIsSet($option, $value) { 
    return $this->_exists($this->mapping->fechaToma(), $option, settypebool($value));
  }

  public function estado($option, $value) { 
    $field = $this->mapping->estado();
    if($c = $this->_exists($field, $option, $value)) return $c;
    if($c = $this->_approx($field, $option, $value)) return $c;
    $this->value->setEstado($value);
    if(!$this->value->checkEstado()) throw new Exception("Valor incorrecto: Estado ");
    return "({$field} {$option} {$this->value->sqlEstado()})";  
  }

  public function estadoIsSet($option, $value) { 
    return $this->_exists($this->mapping->estado(), $option, settypebool($value));
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

  public function comentario($option, $value) { 
    $field = $this->mapping->comentario();
    if($c = $this->_exists($field, $option, $value)) return $c;
    if($c = $this->_approx($field, $option, $value)) return $c;
    $this->value->setComentario($value);
    if(!$this->value->checkComentario()) throw new Exception("Valor incorrecto: Comentario ");
    return "({$field} {$option} {$this->value->sqlComentario()})";  
  }

  public function comentarioIsSet($option, $value) { 
    return $this->_exists($this->mapping->comentario(), $option, settypebool($value));
  }

  public function tipoMovimiento($option, $value) { 
    $field = $this->mapping->tipoMovimiento();
    if($c = $this->_exists($field, $option, $value)) return $c;
    if($c = $this->_approx($field, $option, $value)) return $c;
    $this->value->setTipoMovimiento($value);
    if(!$this->value->checkTipoMovimiento()) throw new Exception("Valor incorrecto: Tipo Movimiento ");
    return "({$field} {$option} {$this->value->sqlTipoMovimiento()})";  
  }

  public function tipoMovimientoIsSet($option, $value) { 
    return $this->_exists($this->mapping->tipoMovimiento(), $option, settypebool($value));
  }

  public function estadoContralor($option, $value) { 
    $field = $this->mapping->estadoContralor();
    if($c = $this->_exists($field, $option, $value)) return $c;
    if($c = $this->_approx($field, $option, $value)) return $c;
    $this->value->setEstadoContralor($value);
    if(!$this->value->checkEstadoContralor()) throw new Exception("Valor incorrecto: Estado Contralor ");
    return "({$field} {$option} {$this->value->sqlEstadoContralor()})";  
  }

  public function estadoContralorIsSet($option, $value) { 
    return $this->_exists($this->mapping->estadoContralor(), $option, settypebool($value));
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

  public function curso($option, $value) { 
    $field = $this->mapping->curso();
    if($c = $this->_exists($field, $option, $value)) return $c;
    if($c = $this->_approx($field, $option, $value)) return $c;
    $this->value->setCurso($value);
    if(!$this->value->checkCurso()) throw new Exception("Valor incorrecto: Curso ");
    return "({$field} {$option} {$this->value->sqlCurso()})";  
  }

  public function cursoIsSet($option, $value) { 
    return $this->_exists($this->mapping->curso(), $option, settypebool($value));
  }

  public function docente($option, $value) { 
    $field = $this->mapping->docente();
    if($c = $this->_exists($field, $option, $value)) return $c;
    if($c = $this->_approx($field, $option, $value)) return $c;
    $this->value->setDocente($value);
    if(!$this->value->checkDocente()) throw new Exception("Valor incorrecto: Docente ");
    return "({$field} {$option} {$this->value->sqlDocente()})";  
  }

  public function docenteIsSet($option, $value) { 
    return $this->_exists($this->mapping->docente(), $option, settypebool($value));
  }

  public function reemplazo($option, $value) { 
    $field = $this->mapping->reemplazo();
    if($c = $this->_exists($field, $option, $value)) return $c;
    if($c = $this->_approx($field, $option, $value)) return $c;
    $this->value->setReemplazo($value);
    if(!$this->value->checkReemplazo()) throw new Exception("Valor incorrecto: Reemplazo ");
    return "({$field} {$option} {$this->value->sqlReemplazo()})";  
  }

  public function reemplazoIsSet($option, $value) { 
    return $this->_exists($this->mapping->reemplazo(), $option, settypebool($value));
  }

  public function planillaDocente($option, $value) { 
    $field = $this->mapping->planillaDocente();
    if($c = $this->_exists($field, $option, $value)) return $c;
    if($c = $this->_approx($field, $option, $value)) return $c;
    $this->value->setPlanillaDocente($value);
    if(!$this->value->checkPlanillaDocente()) throw new Exception("Valor incorrecto: Planilla Docente ");
    return "({$field} {$option} {$this->value->sqlPlanillaDocente()})";  
  }

  public function planillaDocenteIsSet($option, $value) { 
    return $this->_exists($this->mapping->planillaDocente(), $option, settypebool($value));
  }




}
