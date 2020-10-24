<?php

require_once("class/model/Field.php");

class _FieldEmailVerificado extends Field {

  public $type = "tinyint";
  public $fieldType = "nf";
  public $default = "0";
  public $name = "verificado";
  public $alias = "ver";
  public $entityName = "email";
  public $dataType = "boolean";  
  public $subtype = "checkbox";  
  public $length = "1";  
  public $value = "boolean";  


}
