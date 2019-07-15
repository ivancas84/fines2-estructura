<?php

require_once("class/model/Field.php");

class FieldInasistenciaFechaDesdeMain extends Field {

  public $type = "date";
  public $fieldType = "nf";
  public $unique = false;
  public $notNull = true;
  public $default = false;
  public $length = false;
  public $main = false;
  public $name = "fecha_desde";
  public $alias = "fd";


  public function getEntity(){ return new InasistenciaEntity; }


}
