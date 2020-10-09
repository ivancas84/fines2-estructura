<?php

require_once("class/model/Field.php");

class _FieldFileSize extends Field {

  public $type = "int";
  public $fieldType = "nf";
  public $default = null;
  public $length = "10";  
  public $name = "size";
  public $alias = "siz";
  public $entityName = "file";


}
