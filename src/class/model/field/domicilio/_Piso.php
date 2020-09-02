<?php

require_once("class/model/Field.php");

class _FieldDomicilioPiso extends Field {

  public $type = "varchar";
  public $fieldType = "nf";
  public $unique = false;
  public $notNull = false;
  public $default = null;
  public $length = "45";
  public $main = false;
  public $name = "piso";
  public $alias = "pis";


  public function getEntity(){ return $this->container->getEntity('domicilio'); }


}
