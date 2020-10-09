<?php

require_once("class/model/Field.php");

class _FieldFileName extends Field {

  public $type = "varchar";
  public $fieldType = "nf";
  public $default = null;
  public $length = "255";  
  public $name = "name";
  public $alias = "nam";
  public $entityName = "file";


}
