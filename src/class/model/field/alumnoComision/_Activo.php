<?php

require_once("class/model/Field.php");

class _FieldAlumnoComisionActivo extends Field {

  public $type = "tinyint";
  public $fieldType = "nf";
  public $default = "0";
  public $name = "activo";
  public $alias = "act";
  public $entityName = "alumno_comision";
  public $dataType = "boolean";  
  public $subtype = "checkbox";  
  public $length = "1";  


}
