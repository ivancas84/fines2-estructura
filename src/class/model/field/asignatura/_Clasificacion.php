<?php

require_once("class/model/Field.php");

class _FieldAsignaturaClasificacion extends Field {

  public $type = "varchar";
  public $fieldType = "nf";
  public $default = null;
  public $length = "45";  
  public $name = "clasificacion";
  public $alias = "cla";
  public $entityName = "asignatura";


}
