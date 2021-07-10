<?php

require_once("class/model/Field.php");

class _FieldAlumnoResolucionInscripcion extends Field {

  public $type = "varchar";
  public $fieldType = "mu";
  public $default = null;
  public $name = "resolucion_inscripcion";
  public $alias = "ri";
  public $entityName = "alumno";
  public $entityRefName = "resolucion";  
  public $dataType = "string";  
  public $subtype = "typeahead";  
  public $length = "45";  


}
