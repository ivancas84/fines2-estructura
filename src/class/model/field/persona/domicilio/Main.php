<?php

require_once("class/model/Field.php");

class FieldPersonaDomicilioMain extends Field {

  public $type = "varchar";
  public $fieldType = "mu";
  public $unique = false;
  public $notNull = false;
  public $default = false;
  public $length = "45";
  public $main = false;
  public $name = "domicilio";
  public $alias = "dom";


  public function getEntity(){ return new PersonaEntity; }

  public function getEntityRef(){ return new DomicilioEntity; }


}
