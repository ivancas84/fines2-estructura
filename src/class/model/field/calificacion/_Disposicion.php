<?php

require_once("class/model/Field.php");

class _FieldCalificacionDisposicion extends Field {

  public $type = "varchar";
  public $fieldType = "mu";
  public $default = null;
  public $name = "disposicion";
  public $alias = "dis";
  public $entityName = "calificacion";
  public $entityRefName = "disposicion";  
  public $dataType = "string";  
  public $subtype = "typeahead";  
  public $length = "45";  


}
