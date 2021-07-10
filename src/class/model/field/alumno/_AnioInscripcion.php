<?php

require_once("class/model/Field.php");

class _FieldAlumnoAnioInscripcion extends Field {

  public $type = "smallint";
  public $fieldType = "nf";
  public $default = null;
  public $name = "anio_inscripcion";
  public $alias = "aia";
  public $entityName = "alumno";
  public $dataType = "integer";  
  public $subtype = "integer";  
  public $length = "1";  


}
