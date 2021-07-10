<?php

require_once("class/model/Field.php");

class _FieldAlumnoAdeudaInscripcion extends Field {

  public $type = "text";
  public $fieldType = "nf";
  public $default = null;
  public $name = "adeuda_inscripcion";
  public $alias = "aib";
  public $entityName = "alumno";
  public $dataType = "text";  
  public $subtype = "textarea";  
  public $length = "65535";  


}
