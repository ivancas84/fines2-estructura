<?php

require_once("class/model/Field.php");

class FieldTomaObservacionesMain extends Field {

  public $type = "text";
  public $fieldType = "nf";
  public $unique = false;
  public $notNull = false;
  public $default = false;
  public $length = "65535";
  public $main = false;
  public $name = "observaciones";
  public $alias = "obs";


  public function getEntity(){ return new TomaEntity; }


}
