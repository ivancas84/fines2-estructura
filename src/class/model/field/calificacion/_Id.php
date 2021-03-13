<?php

require_once("class/model/Field.php");

class _FieldCalificacionId extends Field {

  public $type = "varchar";
  public $fieldType = "pk";
  public $default = null;
  public $name = "id";
  public $alias = "id";
  public $entityName = "calificacion";
  public $dataType = "string";  
  public $subtype = "text";  
  public $length = "45";  


}
