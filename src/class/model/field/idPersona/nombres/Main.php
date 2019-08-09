<?php

require_once("class/model/Field.php");

class FieldIdPersonaNombresMain extends Field {

  public $type = "varchar";
  public $fieldType = "nf";
  public $unique = false;
  public $notNull = true;
  public $default = false;
  public $length = "100";
  public $main = false;
  public $name = "nombres";
  public $alias = "nom";


  public function getEntity(){ return new IdPersonaEntity; }


}
