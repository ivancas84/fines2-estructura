<?php

require_once("class/model/Field.php");

class _FieldComisionPlanificacion extends Field {

  public $type = "varchar";
  public $fieldType = "mu";
  public $default = null;
  public $length = "45";  
  public $name = "planificacion";
  public $alias = "pla";
  public $entityName = "comision";
  public $entityRefName = "planificacion";  


}
