<?php

require_once("class/model/Field.php");

class _FieldModalidadNombre extends Field {

  public $type = "varchar";
  public $fieldType = "nf";
  public $unique = true;
  public $notNull = true;
  public $default = null;
  public $length = "45";
  public $main = false;
  public $name = "nombre";
  public $alias = "nom";


  public function getEntity(){ return Entity::getInstanceRequire('modalidad'); }


}
