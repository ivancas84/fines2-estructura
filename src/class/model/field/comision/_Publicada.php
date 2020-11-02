<?php

require_once("class/model/Field.php");

class _FieldComisionPublicada extends Field {

  public $type = "tinyint";
  public $fieldType = "nf";
  public $default = null;
  public $name = "publicada";
  public $alias = "pub";
  public $entityName = "comision";
  public $dataType = "boolean";  
  public $subtype = "checkbox";  
  public $length = "1";  


}
