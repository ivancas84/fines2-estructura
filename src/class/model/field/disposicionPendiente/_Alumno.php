<?php

require_once("class/model/Field.php");

class _FieldDisposicionPendienteAlumno extends Field {

  public $type = "varchar";
  public $fieldType = "mu";
  public $default = null;
  public $name = "alumno";
  public $alias = "alu";
  public $entityName = "disposicion_pendiente";
  public $entityRefName = "alumno";  
  public $dataType = "string";  
  public $subtype = "typeahead";  
  public $length = "45";  


}
