<?php

require_once("class/model/Field.php");

class _FieldCursoHorasCatedra extends Field {

  public $type = "int";
  public $fieldType = "nf";
  public $default = null;
  public $name = "horas_catedra";
  public $alias = "hc";
  public $entityName = "curso";
  public $dataType = "integer";  
  public $subtype = "integer";  
  public $length = "10";  
  public $value = "integer";  


}
