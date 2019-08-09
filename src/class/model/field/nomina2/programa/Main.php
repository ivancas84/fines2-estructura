<?php

require_once("class/model/Field.php");

class FieldNomina2ProgramaMain extends Field {

  public $type = "varchar";
  public $fieldType = "nf";
  public $unique = false;
  public $notNull = false;
  public $default = false;
  public $length = "45";
  public $main = false;
  public $name = "programa";
  public $alias = "pro";


  public function getEntity(){ return new Nomina2Entity; }


}
