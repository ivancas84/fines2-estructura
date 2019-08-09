<?php

require_once("class/model/Field.php");

class FieldAlumnoConstanciaCuilMain extends Field {

  public $type = "tinyint";
  public $fieldType = "nf";
  public $unique = false;
  public $notNull = true;
  public $default = false;
  public $length = "1";
  public $main = false;
  public $name = "constancia_cuil";
  public $alias = "cc";


  public function getEntity(){ return new AlumnoEntity; }


}
