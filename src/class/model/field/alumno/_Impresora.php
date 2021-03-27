<?php

require_once("class/model/Field.php");

class _FieldAlumnoImpresora extends Field {

  public $type = "varchar";
  public $fieldType = "nf";
  public $default = null;
  public $name = "impresora";
  public $alias = "imp";
  public $entityName = "alumno";
  public $dataType = "string";  
  public $subtype = "text";  
  public $length = "45";  


}
