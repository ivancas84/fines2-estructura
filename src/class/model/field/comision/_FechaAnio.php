<?php

require_once("class/model/Field.php");

class _FieldComisionFechaAnio extends Field {

  public $type = "year";
  public $fieldType = "nf";
  public $unique = false;
  public $notNull = false;
  public $default = "NULL";
  public $length = false;
  public $main = false;
  public $name = "fecha_anio";
  public $alias = "fa";


  public function getEntity(){ return new ComisionEntity; }


}
