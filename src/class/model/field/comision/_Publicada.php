<?php

require_once("class/model/Field.php");

class _FieldComisionPublicada extends Field {

  public $type = "tinyint";
  public $fieldType = "nf";
  public $unique = false;
  public $notNull = true;
  public $default = null;
  public $length = "1";
  public $main = false;
  public $name = "publicada";
  public $alias = "pub";


  public function getEntity(){ return $this->container->getEntity('comision'); }


}
