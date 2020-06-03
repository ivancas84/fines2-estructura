<?php

require_once("class/model/Field.php");

class _FieldContralorFechaConsejo extends Field {

  public $type = "date";
  public $fieldType = "nf";
  public $unique = false;
  public $notNull = false;
  public $default = false;
  public $length = false;
  public $main = false;
  public $name = "fecha_consejo";
  public $alias = "fca";


  public function getEntity(){ return Entity::getInstanceRequire('contralor'); }


}