<?php

require_once("class/model/Field.php");

class _FieldAlumnoDocumentacionInscripcion extends Field {

  public $type = "varchar";
  public $fieldType = "nf";
  public $default = null;
  public $name = "documentacion_inscripcion";
  public $alias = "di";
  public $entityName = "alumno";
  public $dataType = "string";  
  public $subtype = "text";  
  public $length = "255";  


}
