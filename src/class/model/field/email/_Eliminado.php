<?php

require_once("class/model/Field.php");

class _FieldEmailEliminado extends Field {

  public $type = "timestamp";
  public $fieldType = "nf";
  public $unique = false;
  public $notNull = false;
  public $default = false;
  public $length = false;
  public $main = false;
  public $name = "eliminado";
  public $alias = "eli";


  public function getEntity(){ return new EmailEntity; }


}