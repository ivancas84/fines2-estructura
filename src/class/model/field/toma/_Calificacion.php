<?php

require_once("class/model/Field.php");

class _FieldTomaCalificacion extends Field {

  public $type = "tinyint";
  public $fieldType = "nf";
  public $default = "0";
  public $name = "calificacion";
  public $alias = "cal";
  public $entityName = "toma";
  public $dataType = "boolean";  
  public $subtype = "checkbox";  
  public $length = "1";  


}
