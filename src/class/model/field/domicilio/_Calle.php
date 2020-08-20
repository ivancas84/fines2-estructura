<?php

require_once("class/model/Field.php");

class _FieldDomicilioCalle extends Field {

  public $type = "varchar";
  public $fieldType = "nf";
  public $unique = false;
  public $notNull = true;
  public $default = null;
  public $length = "45";
  public $main = false;
  public $name = "calle";
  public $alias = "cal";


  public function getEntity(){ return Entity::getInstanceRequire('domicilio'); }


}
