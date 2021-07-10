<?php

require_once("class/model/Field.php");

class _FieldPersonaTelefonoVerificado extends Field {

  public $type = "tinyint";
  public $fieldType = "nf";
  public $default = "0";
  public $name = "telefono_verificado";
  public $alias = "tv";
  public $entityName = "persona";
  public $dataType = "boolean";  
  public $subtype = "checkbox";  
  public $length = "1";  


}
