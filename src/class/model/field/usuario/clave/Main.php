<?php

require_once("class/model/Field.php");

class FieldUsuarioClaveMain extends Field {

  public $type = "varchar";
  public $fieldType = "nf";
  public $unique = false;
  public $notNull = true;
  public $default = false;
  public $length = "255";
  public $main = false;
  public $name = "clave";
  public $alias = "cla";


  public function getEntity(){ return new UsuarioEntity; }


}
