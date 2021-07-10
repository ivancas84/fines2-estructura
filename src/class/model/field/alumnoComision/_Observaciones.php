<?php

require_once("class/model/Field.php");

class _FieldAlumnoComisionObservaciones extends Field {

  public $type = "text";
  public $fieldType = "nf";
  public $default = null;
  public $name = "observaciones";
  public $alias = "obs";
  public $entityName = "alumno_comision";
  public $dataType = "text";  
  public $subtype = "textarea";  
  public $length = "65535";  


}
