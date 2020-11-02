<?php

require_once("class/model/Field.php");

class _FieldAsignaturaClasificacion extends Field {

  public $type = "varchar";
  public $fieldType = "nf";
  public $default = null;
  public $name = "clasificacion";
  public $alias = "cla";
  public $entityName = "asignatura";
  public $dataType = "string";  
  public $subtype = "text";  
  public $length = "45";  


}
