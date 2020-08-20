<?php

require_once("class/model/Field.php");

class _FieldCursoComision extends Field {

  public $type = "varchar";
  public $fieldType = "mu";
  public $unique = false;
  public $notNull = true;
  public $default = null;
  public $length = "45";
  public $main = false;
  public $name = "comision";
  public $alias = "com";


  public function getEntity(){ return Entity::getInstanceRequire('curso'); }

  public function getEntityRef(){ return Entity::getInstanceRequire('comision'); }


}
