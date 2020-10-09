<?php

require_once("class/model/Field.php");

class _FieldDistribucionHorariaAsignatura extends Field {

  public $type = "varchar";
  public $fieldType = "mu";
  public $default = null;
  public $length = "45";  
  public $name = "asignatura";
  public $alias = "asi";
  public $entityName = "distribucion_horaria";
  public $entityRefName = "asignatura";  


}
