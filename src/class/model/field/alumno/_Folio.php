<?php

require_once("class/model/Field.php");

class _FieldAlumnoFolio extends Field {

  public $type = "varchar";
  public $fieldType = "nf";
  public $default = null;
  public $name = "folio";
  public $alias = "fol";
  public $entityName = "alumno";
  public $dataType = "string";  
  public $subtype = "text";  
  public $length = "45";  


}
