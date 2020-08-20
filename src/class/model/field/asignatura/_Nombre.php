<?php

require_once("class/model/Field.php");

class _FieldAsignaturaNombre extends Field {

  public $type = "varchar";
  public $fieldType = "nf";
  public $unique = true;
  public $notNull = true;
  public $default = null;
  public $length = "255";
  public $main = false;
  public $name = "nombre";
  public $alias = "nom";


  public function getEntity(){ return Entity::getInstanceRequire('asignatura'); }


}
