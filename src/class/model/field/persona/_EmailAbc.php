<?php

require_once("class/model/Field.php");

class _FieldPersonaEmailAbc extends Field {

  public $type = "varchar";
  public $fieldType = "nf";
  public $unique = true;
  public $notNull = false;
  public $default = null;
  public $length = "255";
  public $main = false;
  public $name = "email_abc";
  public $alias = "ea";


  public function getEntity(){ return $this->container->getEntity('persona'); }


}
