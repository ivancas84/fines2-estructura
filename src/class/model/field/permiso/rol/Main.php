<?php

require_once("class/model/Field.php");

class FieldPermisoRolMain extends Field {

  public $type = "bigint";
  public $fieldType = "mu";
  public $unique = false;
  public $notNull = true;
  public $default = false;
  public $length = "20";
  public $main = false;
  public $name = "rol";
  public $alias = "rol";


  public function getEntity(){ return new PermisoEntity; }

  public function getEntityRef(){ return new RolEntity; }


}
