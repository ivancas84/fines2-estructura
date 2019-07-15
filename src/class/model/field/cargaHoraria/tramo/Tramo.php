<?php

require_once("class/model/Field.php");

class FieldCargaHorariaTramo extends Field {

  public $type = "varchar";
  public $fieldType = "nf";
  public $unique = false;
  public $notNull = true;
  public $default = false;
  public $length = "255";
  public $main = false;
  public $name = "tramo";
  public $alias = "tra";
  public $admin = false;
  public $db = false;



  public function getEntity(){ return new CargaHorariaEntity; }


}
