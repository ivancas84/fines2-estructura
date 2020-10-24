<?php

require_once("class/model/Field.php");

class _FieldAsignacionPlanillaDocentePlanillaDocente extends Field {

  public $type = "varchar";
  public $fieldType = "mu";
  public $default = null;
  public $name = "planilla_docente";
  public $alias = "pd";
  public $entityName = "asignacion_planilla_docente";
  public $entityRefName = "planilla_docente";  
  public $dataType = "string";  
  public $subtype = "typeahead";  
  public $length = "45";  
  public $value = "string";  


}
