<?php

require_once("class/model/Field.php");

class _FieldAsignacionPlanillaDocentePlanillaDocente extends Field {

  public $type = "varchar";
  public $fieldType = "mu";
  public $default = null;
  public $length = "45";  
  public $name = "planilla_docente";
  public $alias = "pd";
  public $entityName = "asignacion_planilla_docente";
  public $entityRefName = "planilla_docente";  


}
