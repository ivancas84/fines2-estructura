<?php

require_once("class/model/Field.php");

class _FieldPersonaCuil extends Field {

  public $type = "varchar";
  public $fieldType = "nf";
  public $unique = true;
  public $notNull = false;
  public $default = null;
  public $length = "45";
  public $main = false;
  public $name = "cuil";
  public $alias = "cui";


  public function getEntity(){ return $this->container->getEntity('persona'); }


}
