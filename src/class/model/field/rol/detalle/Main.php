<?php

require_once("class/model/Field.php");

class FieldRolDetalleMain extends Field {

  public $type = "varchar";
  public $fieldType = "nf";
  public $unique = false;
  public $notNull = false;
  public $default = false;
  public $length = "255";
  public $main = false;
  public $name = "detalle";
  public $alias = "det";


  public function getEntity(){ return new RolEntity; }


}
