<?php

require_once("class/model/Field.php");

class _FieldDomicilioDepartamento extends Field {

  public $type = "varchar";
  public $fieldType = "nf";
  public $unique = false;
  public $notNull = false;
  public $default = null;
  public $length = "45";
  public $main = false;
  public $name = "departamento";
  public $alias = "dep";


  public function getEntity(){ return Entity::getInstanceRequire('domicilio'); }


}
