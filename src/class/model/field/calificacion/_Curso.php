<?php

require_once("class/model/Field.php");

class _FieldCalificacionCurso extends Field {

  public $type = "varchar";
  public $fieldType = "mu";
  public $default = null;
  public $name = "curso";
  public $alias = "cur";
  public $entityName = "calificacion";
  public $entityRefName = "curso";  
  public $dataType = "string";  
  public $subtype = "typeahead";  
  public $length = "45";  


}
