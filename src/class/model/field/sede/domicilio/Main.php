<?php

require_once("class/model/Field.php");

class FieldSedeDomicilioMain extends Field {

  public $type = "bigint";
  public $fieldType = "_u";
  public $unique = true;
  public $notNull = false;
  public $default = false;
  public $length = "20";
  public $main = false;
  public $name = "domicilio";
  public $alias = "dom";


  public function getEntity(){ return new SedeEntity; }

  public function getEntityRef(){ return new DomicilioEntity; }


}
