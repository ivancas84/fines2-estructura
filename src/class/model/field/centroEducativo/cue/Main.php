<?php

require_once("class/model/Field.php");

class FieldCentroEducativoCueMain extends Field {

  public $type = "varchar";
  public $fieldType = "nf";
  public $unique = true;
  public $notNull = false;
  public $default = false;
  public $length = "45";
  public $main = false;
  public $name = "cue";
  public $alias = "cue";


  public function getEntity(){ return new CentroEducativoEntity; }


}
