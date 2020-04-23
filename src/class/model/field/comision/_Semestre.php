<?php

require_once("class/model/Field.php");

class _FieldComisionSemestre extends Field {

  public $type = "varchar";
  public $fieldType = "nf";
  public $unique = false;
  public $notNull = false;
  public $default = "NULL";
  public $length = "45";
  public $main = false;
  public $name = "semestre";
  public $alias = "sem";


  public function getEntity(){ return new ComisionEntity; }


}
