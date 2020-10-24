<?php

require_once("class/model/Field.php");

class _FieldCalendarioSemestre extends Field {

  public $type = "smallint";
  public $fieldType = "nf";
  public $default = null;
  public $name = "semestre";
  public $alias = "sem";
  public $entityName = "calendario";
  public $dataType = "integer";  
  public $subtype = "integer";  
  public $length = "5";  
  public $value = "integer";  


}
