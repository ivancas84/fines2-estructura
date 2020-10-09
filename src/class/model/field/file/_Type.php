<?php

require_once("class/model/Field.php");

class _FieldFileType extends Field {

  public $type = "varchar";
  public $fieldType = "nf";
  public $default = null;
  public $length = "255";  
  public $name = "type";
  public $alias = "typ";
  public $entityName = "file";


}
