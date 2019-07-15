<?php

require_once("class/model/Field.php");

class FieldNomina2ComisionMain extends Field {

  public $type = "bigint";
  public $fieldType = "mu";
  public $unique = false;
  public $notNull = true;
  public $default = false;
  public $length = "20";
  public $main = false;
  public $name = "comision";
  public $alias = "com";


  public function getEntity(){ return new Nomina2Entity; }

  public function getEntityRef(){ return new ComisionEntity; }


}
