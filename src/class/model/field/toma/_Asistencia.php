<?php

require_once("class/model/Field.php");

class _FieldTomaAsistencia extends Field {

  public $type = "tinyint";
  public $fieldType = "nf";
  public $default = "0";
  public $name = "asistencia";
  public $alias = "asi";
  public $entityName = "toma";
  public $dataType = "boolean";  
  public $subtype = "checkbox";  
  public $length = "1";  


}
