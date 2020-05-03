<?php

require_once("class/model/Field.php");

class _FieldPersonaApodo extends Field {

  public $type = "varchar";
  public $fieldType = "nf";
  public $unique = false;
  public $notNull = false;
  public $default = false;
  public $length = "255";
  public $main = false;
  public $name = "apodo";
  public $alias = "apo";


  public function getEntity(){ return new PersonaEntity; }


}
