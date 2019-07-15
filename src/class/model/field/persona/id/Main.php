<?php

require_once("class/model/Field.php");

class FieldPersonaIdMain extends Field {

  public $type = "bigint";
  public $fieldType = "pk";
  public $unique = true;
  public $notNull = true;
  public $default = false;
  public $length = "19";
  public $main = true;
  public $name = "id";
  public $alias = "id";


  public function getEntity(){ return new PersonaEntity; }


}
