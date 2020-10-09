<?php

require_once("class/model/Field.php");

class _FieldDistribucionHorariaPlanificacion extends Field {

  public $type = "varchar";
  public $fieldType = "mu";
  public $default = null;
  public $length = "45";  
  public $name = "planificacion";
  public $alias = "pla";
  public $entityName = "distribucion_horaria";
  public $entityRefName = "planificacion";  


}
