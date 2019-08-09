<?php

require_once("class/model/Field.php");

class FieldDomicilioLocalidadMain extends Field {

  public $type = "varchar";
  public $fieldType = "nf";
  public $unique = false;
  public $notNull = true;
  public $default = "La Plata";
  public $length = "45";
  public $main = false;
  public $name = "localidad";
  public $alias = "loc";


  public function getEntity(){ return new DomicilioEntity; }


}
