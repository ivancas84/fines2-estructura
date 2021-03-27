<?php

require_once("class/model/Field.php");

class _FieldAsignaturaFormacion extends Field {

  public $type = "varchar";
  public $fieldType = "nf";
  public $default = null;
  public $name = "formacion";
  public $alias = "for";
  public $entityName = "asignatura";
  public $dataType = "string";  
  public $subtype = "text";  
  public $length = "45";  


}
