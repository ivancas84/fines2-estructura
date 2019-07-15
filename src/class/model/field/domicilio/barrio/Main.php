<?php

require_once("class/model/Field.php");

class FieldDomicilioBarrioMain extends Field {

  public $type = "varchar";
  public $fieldType = "nf";
  public $unique = false;
  public $notNull = false;
  public $default = false;
  public $length = "255";
  public $main = false;
  public $name = "barrio";
  public $alias = "bar";


  public function getEntity(){ return new DomicilioEntity; }


}
