<?php

require_once("class/model/Field.php");

class FieldComisionSemestreMain extends Field {

  public $type = "int";
  public $fieldType = "nf";
  public $unique = false;
  public $notNull = true;
  public $default = false;
  public $length = "10";
  public $main = false;
  public $name = "semestre";
  public $alias = "sem";


  public function getEntity(){ return new ComisionEntity; }


}
