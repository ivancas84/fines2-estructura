<?php

require_once("class/model/Field.php");

class FieldLugarNacimientoCiudadMain extends Field {

  public $type = "varchar";
  public $fieldType = "nf";
  public $unique = false;
  public $notNull = false;
  public $default = false;
  public $length = "100";
  public $main = false;
  public $name = "ciudad";
  public $alias = "ciu";


  public function getEntity(){ return new LugarNacimientoEntity; }


}
