<?php

require_once("class/model/Field.php");

class FieldAlumnoAnioIngresoMain extends Field {

  public $type = "int";
  public $fieldType = "nf";
  public $unique = false;
  public $notNull = false;
  public $default = false;
  public $length = "10";
  public $main = false;
  public $name = "anio_ingreso";
  public $alias = "ai";


  public function getEntity(){ return new AlumnoEntity; }


}
