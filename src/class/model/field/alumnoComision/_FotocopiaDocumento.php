<?php

require_once("class/model/Field.php");

class _FieldAlumnoComisionFotocopiaDocumento extends Field {

  public $type = "tinyint";
  public $fieldType = "nf";
  public $default = "0";
  public $name = "fotocopia_documento";
  public $alias = "fd";
  public $entityName = "alumno_comision";
  public $dataType = "boolean";  
  public $subtype = "checkbox";  
  public $length = "1";  


}
