<?php

require_once("class/model/Field.php");

class FieldNotaProfesorMain extends Field {

  public $type = "bigint";
  public $fieldType = "mu";
  public $unique = false;
  public $notNull = true;
  public $default = false;
  public $length = "20";
  public $main = false;
  public $name = "profesor";
  public $alias = "pro";


  public function getEntity(){ return new NotaEntity; }

  public function getEntityRef(){ return new IdPersonaEntity; }


}
