<?php

require_once("class/model/Field.php");

class _FieldAsignacionPlanillaDocenteToma extends Field {

  public $type = "varchar";
  public $fieldType = "mu";
  public $default = null;
  public $name = "toma";
  public $alias = "tom";
  public $entityName = "asignacion_planilla_docente";
  public $entityRefName = "toma";  
  public $dataType = "string";  
  public $subtype = "typeahead";  
  public $length = "45";  


}
