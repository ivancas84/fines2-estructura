<?php

require_once("class/model/Field.php");

class _FieldAlumnoTrayectoriaEducativa extends Field {

  public $type = "varchar";
  public $fieldType = "nf";
  public $default = null;
  public $name = "trayectoria_educativa";
  public $alias = "te";
  public $entityName = "alumno";
  public $dataType = "string";  
  public $subtype = "text";  
  public $length = "45";  


}
