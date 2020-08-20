<?php

require_once("class/model/Field.php");

class _FieldAsignaturaFormacion extends Field {

  public $type = "varchar";
  public $fieldType = "nf";
  public $unique = false;
  public $notNull = false;
  public $default = null;
  public $length = "45";
  public $main = false;
  public $name = "formacion";
  public $alias = "for";


  public function getEntity(){ return Entity::getInstanceRequire('asignatura'); }


}
