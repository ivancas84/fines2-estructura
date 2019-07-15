<?php

require_once("class/model/Field.php");

class FieldInasistenciaModulosSemanalesMain extends Field {

  public $type = "int";
  public $fieldType = "nf";
  public $unique = false;
  public $notNull = false;
  public $default = false;
  public $length = "10";
  public $main = false;
  public $name = "modulos_semanales";
  public $alias = "ms";


  public function getEntity(){ return new InasistenciaEntity; }


}
