<?php

require_once("class/model/Field.php");

class _FieldTomaEstadoContralor extends Field {

  public $type = "varchar";
  public $fieldType = "nf";
  public $unique = false;
  public $notNull = false;
  public $default = null;
  public $length = "45";
  public $main = false;
  public $name = "estado_contralor";
  public $alias = "ec";


  public function getEntity(){ return Entity::getInstanceRequire('toma'); }


}
