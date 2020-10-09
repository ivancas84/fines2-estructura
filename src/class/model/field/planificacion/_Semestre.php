<?php

require_once("class/model/Field.php");

class _FieldPlanificacionSemestre extends Field {

  public $type = "varchar";
  public $fieldType = "nf";
  public $default = null;
  public $length = "45";  
  public $name = "semestre";
  public $alias = "sem";
  public $entityName = "planificacion";


}
