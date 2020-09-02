<?php

require_once("class/model/Field.php");

class _FieldComisionAutorizada extends Field {

  public $type = "tinyint";
  public $fieldType = "nf";
  public $unique = false;
  public $notNull = true;
  public $default = null;
  public $length = "1";
  public $main = false;
  public $name = "autorizada";
  public $alias = "aut";


  public function getEntity(){ return $this->container->getEntity('comision'); }


}
