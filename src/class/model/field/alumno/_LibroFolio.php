<?php

require_once("class/model/Field.php");

class _FieldAlumnoLibroFolio extends Field {

  public $type = "varchar";
  public $fieldType = "nf";
  public $default = null;
  public $name = "libro_folio";
  public $alias = "lf";
  public $entityName = "alumno";
  public $dataType = "string";  
  public $subtype = "text";  
  public $length = "255";  


}
