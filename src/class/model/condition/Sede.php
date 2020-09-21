<?php
require_once("class/model/condition/_Sede.php");

class SedeCondition extends _SedeCondition{

  public function numeroTrim($option, $value) { 
    $field = $this->mapping->numeroTrim();
    if($c = $this->sql->exists($field, $option, $value)) return $c;
    if($c = $this->sql->approx($field, $option, $value)) return $c;
    $this->value->setNumero($value);
    if(!$this->value->checkNumero()) throw new Exception("Valor incorrecto: Numero");
    return "({$field} {$option} {$this->value->sqlNumero()})";  
  }
}
