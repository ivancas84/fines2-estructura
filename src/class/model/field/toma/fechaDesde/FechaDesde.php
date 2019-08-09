<?php

require_once("class/model/Field.php");

class FieldTomaFechaDesde extends Field {

  public $type = "date";
  public $fieldType = "nf";
  public $unique = false;
  public $notNull = false;
  public $default = false;
  public $length = false;
  public $main = true;
  public $name = "fecha_desde";
  public $alias = "fd";
  public $admin = false;
  public $db = false;

  public function getEntity(){ return new TomaEntity; }
}
