<?php

require_once("class/model/Field.php");

class _FieldAlumnoSemestreInscripcion extends Field {

  public $type = "smallint";
  public $fieldType = "nf";
  public $default = null;
  public $name = "semestre_inscripcion";
  public $alias = "si";
  public $entityName = "alumno";
  public $dataType = "integer";  
  public $subtype = "integer";  
  public $length = "1";  


}
