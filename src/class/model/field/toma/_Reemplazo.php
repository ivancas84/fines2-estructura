<?php

require_once("class/model/Field.php");

class _FieldTomaReemplazo extends Field {

  public $type = "varchar";
  public $fieldType = "mu";
  public $unique = false;
  public $notNull = false;
  public $default = false;
  public $length = "45";
  public $main = false;
  public $name = "reemplazo";
  public $alias = "ree";


  public function getEntity(){ return Entity::getInstanceRequire('toma'); }

  public function getEntityRef(){ return Entity::getInstanceRequire('persona'); }


}
