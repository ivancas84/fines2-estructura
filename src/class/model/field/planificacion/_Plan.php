<?php

require_once("class/model/Field.php");

class _FieldPlanificacionPlan extends Field {

  public $type = "varchar";
  public $fieldType = "mu";
  public $default = null;
  public $name = "plan";
  public $alias = "plb";
  public $entityName = "planificacion";
  public $entityRefName = "plan";  
  public $dataType = "string";  
  public $subtype = "typeahead";  
  public $length = "45";  
  public $value = "string";  


}
