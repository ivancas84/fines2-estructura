<?php

require_once("class/model/Field.php");

class _FieldTomaFechaInicio extends Field {

  public $type = "date";
  public $fieldType = "nf";
  public $unique = false;
  public $notNull = false;
  public $default = "NULL";
  public $length = false;
  public $main = false;
  public $name = "fecha_inicio";
  public $alias = "fi";


  public function getEntity(){ return new TomaEntity; }


}
