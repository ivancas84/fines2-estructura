<?php

require_once("class/model/Field.php");

class _FieldDisposicionPlanificacion extends Field {

  public $type = "varchar";
  public $fieldType = "mu";
  public $default = null;
  public $name = "planificacion";
  public $alias = "pla";
  public $entityName = "disposicion";
  public $entityRefName = "planificacion";  
  public $dataType = "string";  
  public $subtype = "typeahead";  
  public $length = "45";  


}
