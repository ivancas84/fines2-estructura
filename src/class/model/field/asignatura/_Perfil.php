<?php

require_once("class/model/Field.php");

class _FieldAsignaturaPerfil extends Field {

  public $type = "varchar";
  public $fieldType = "nf";
  public $unique = false;
  public $notNull = false;
  public $default = false;
  public $length = "45";
  public $main = false;
  public $name = "perfil";
  public $alias = "per";


  public function getEntity(){ return Entity::getInstanceRequire('asignatura'); }


}
