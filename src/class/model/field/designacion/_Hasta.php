<?php

require_once("class/model/Field.php");

class _FieldDesignacionHasta extends Field {

  public $type = "date";
  public $fieldType = "nf";
  public $unique = false;
  public $notNull = false;
  public $default = false;
  public $length = false;
  public $main = false;
  public $name = "hasta";
  public $alias = "has";


  public function getEntity(){ return new DesignacionEntity; }


}
