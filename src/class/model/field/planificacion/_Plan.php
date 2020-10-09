<?php

require_once("class/model/Field.php");

class _FieldPlanificacionPlan extends Field {

  public $type = "varchar";
  public $fieldType = "mu";
  public $default = null;
  public $length = "45";  
  public $name = "plan";
  public $alias = "plb";
  public $entityName = "planificacion";
  public $entityRefName = "plan";  


}
