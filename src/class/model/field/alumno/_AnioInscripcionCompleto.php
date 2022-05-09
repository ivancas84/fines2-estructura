<?php

require_once("class/model/Field.php");

class _FieldAlumnoAnioInscripcionCompleto extends Field {

  public $type = "tinyint";
  public $fieldType = "nf";
  public $default = null;
  public $name = "anio_inscripcion_completo";
  public $alias = "aic";
  public $entityName = "alumno";
  public $dataType = "boolean";  
  public $subtype = "checkbox";  
  public $length = "1";  


}
