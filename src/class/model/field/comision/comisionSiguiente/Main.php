<?php

require_once("class/model/Field.php");

class FieldComisionComisionSiguienteMain extends Field {

  public $type = "varchar";
  public $fieldType = "mu";
  public $unique = false;
  public $notNull = false;
  public $default = false;
  public $length = "45";
  public $main = false;
  public $name = "comision_siguiente";
  public $alias = "cs";


  public function getEntity(){ return new ComisionEntity; }

  public function getEntityRef(){ return new ComisionEntity; }


}
