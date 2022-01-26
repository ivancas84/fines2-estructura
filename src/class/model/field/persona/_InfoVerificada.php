<?php

require_once("class/model/Field.php");

class _FieldPersonaInfoVerificada extends Field {

  public $type = "tinyint";
  public $fieldType = "nf";
  public $default = "0";
  public $name = "info_verificada";
  public $alias = "iv";
  public $entityName = "persona";
  public $dataType = "boolean";  
  public $subtype = "checkbox";  
  public $length = "1";  


}
