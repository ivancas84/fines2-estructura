<?php

require_once("class/model/Field.php");

class _FieldDomicilioLocalidad extends Field {

  public $type = "varchar";
  public $fieldType = "nf";
  public $unique = false;
  public $notNull = true;
  public $default = false;
  public $length = "255";
  public $main = false;
  public $name = "localidad";
  public $alias = "loc";


  public function getEntity(){ return new DomicilioEntity; }


}
