<?php

require_once("class/model/Field.php");

class _FieldComisionApertura extends Field {

  public $type = "tinyint";
  public $fieldType = "nf";
  public $unique = false;
  public $notNull = true;
  public $default = null;
  public $length = "1";
  public $main = false;
  public $name = "apertura";
  public $alias = "ape";


  public function getEntity(){ return $this->container->getEntity('comision'); }


}
