<?php

require_once("class/model/Field.php");

class _FieldPersonaEmailVerificado extends Field {

  public $type = "tinyint";
  public $fieldType = "nf";
  public $default = "0";
  public $name = "email_verificado";
  public $alias = "ev";
  public $entityName = "persona";
  public $dataType = "boolean";  
  public $subtype = "checkbox";  
  public $length = "1";  


}
