<?php

require_once("class/model/Field.php");

class _FieldComisionApertura extends Field {

  public $type = "tinyint";
  public $fieldType = "nf";
  public $default = null;
  public $name = "apertura";
  public $alias = "ape";
  public $entityName = "comision";
  public $dataType = "boolean";  
  public $subtype = "checkbox";  
  public $length = "1";  
  public $value = "boolean";  


}
