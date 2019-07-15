<?php

require_once("class/model/Field.php");

class FieldTomaTipoMovimientoMain extends Field {

  public $type = "varchar";
  public $fieldType = "nf";
  public $unique = false;
  public $notNull = true;
  public $default = "AI";
  public $length = "2";
  public $main = false;
  public $name = "tipo_movimiento";
  public $alias = "tm";


  public function getEntity(){ return new TomaEntity; }


}
