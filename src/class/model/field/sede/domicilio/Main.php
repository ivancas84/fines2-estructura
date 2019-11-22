<?php

require_once("class/model/Field.php");

class FieldSedeDomicilioMain extends Field {

  public $type = "varchar";
  public $fieldType = "mu";
  public $unique = false;
  public $notNull = false;
  public $default = false;
  public $length = "45";
  public $main = false;
  public $name = "domicilio";
  public $alias = "dom";


  public function getEntity(){ return new SedeEntity; }

  public function getEntityRef(){ return new DomicilioEntity; }


}
