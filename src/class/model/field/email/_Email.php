<?php

require_once("class/model/Field.php");

class _FieldEmailEmail extends Field {

  public $type = "varchar";
  public $fieldType = "nf";
  public $default = null;
  public $length = "255";  
  public $name = "email";
  public $alias = "ema";
  public $entityName = "email";


}
