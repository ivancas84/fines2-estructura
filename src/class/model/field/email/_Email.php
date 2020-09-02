<?php

require_once("class/model/Field.php");

class _FieldEmailEmail extends Field {

  public $type = "varchar";
  public $fieldType = "nf";
  public $unique = false;
  public $notNull = true;
  public $default = null;
  public $length = "255";
  public $main = false;
  public $name = "email";
  public $alias = "ema";


  public function getEntity(){ return $this->container->getEntity('email'); }


}
