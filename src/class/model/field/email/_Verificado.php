<?php

require_once("class/model/Field.php");

class _FieldEmailVerificado extends Field {

  public $type = "tinyint";
  public $fieldType = "nf";
  public $unique = false;
  public $notNull = true;
  public $default = false;
  public $length = "1";
  public $main = false;
  public $name = "verificado";
  public $alias = "ver";


  public function getEntity(){ return new EmailEntity; }


}