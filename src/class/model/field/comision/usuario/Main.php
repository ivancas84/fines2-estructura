<?php

require_once("class/model/Field.php");

class FieldComisionUsuarioMain extends Field {

  public $type = "bigint";
  public $fieldType = "nf";
  public $unique = false;
  public $notNull = true;
  public $default = "1";
  public $length = "20";
  public $main = false;
  public $name = "usuario";
  public $alias = "usu";


  public function getEntity(){ return new ComisionEntity; }


}
