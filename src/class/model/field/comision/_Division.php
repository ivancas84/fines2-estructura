<?php

require_once("class/model/Field.php");

class _FieldComisionDivision extends Field {

  public $type = "varchar";
  public $fieldType = "nf";
  public $unique = false;
  public $notNull = true;
  public $default = null;
  public $length = "45";
  public $main = false;
  public $name = "division";
  public $alias = "dia";


  public function getEntity(){ return $this->container->getEntity('comision'); }


}
