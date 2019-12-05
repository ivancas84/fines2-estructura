<?php

require_once("class/model/Field.php");

class FieldAsignaturaClasificacionMain extends Field {

  public $type = "varchar";
  public $fieldType = "nf";
  public $unique = false;
  public $notNull = false;
  public $default = false;
  public $length = "45";
  public $main = false;
  public $name = "clasificacion";
  public $alias = "cla";


  public function getEntity(){ return new AsignaturaEntity; }


}
