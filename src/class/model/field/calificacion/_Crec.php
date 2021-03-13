<?php

require_once("class/model/Field.php");

class _FieldCalificacionCrec extends Field {

  public $type = "decimal";
  public $fieldType = "nf";
  public $default = null;
  public $name = "crec";
  public $alias = "cre";
  public $entityName = "calificacion";
  public $dataType = "float";  
  public $subtype = "float";  
  public $length = "4,2";  


}
