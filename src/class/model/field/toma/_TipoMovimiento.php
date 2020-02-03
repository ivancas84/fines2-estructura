<?php

require_once("class/model/Field.php");

class _FieldTomaTipoMovimiento extends Field {

  public $type = "varchar";
  public $fieldType = "nf";
  public $unique = false;
  public $notNull = true;
  public $default = false;
  public $length = "45";
  public $main = false;
  public $name = "tipo_movimiento";
  public $alias = "tm";


  public function getEntity(){ return new TomaEntity; }


}
