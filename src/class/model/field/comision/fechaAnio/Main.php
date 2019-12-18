<?php

require_once("class/model/Field.php");

class FieldComisionFechaAnioMain extends Field {

  public $type = "year";
  public $fieldType = "nf";
  public $unique = false;
  public $notNull = false;
  public $default = false;
  public $length = false;
  public $main = false;
  public $name = "fecha_anio";
  public $alias = "fa";


  public function getEntity(){ return new ComisionEntity; }


}
