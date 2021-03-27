<?php

require_once("class/model/Field.php");

class _FieldCalificacionPorcentajeAsistencia extends Field {

  public $type = "int";
  public $fieldType = "nf";
  public $default = null;
  public $name = "porcentaje_asistencia";
  public $alias = "pa";
  public $entityName = "calificacion";
  public $dataType = "integer";  
  public $subtype = "integer";  
  public $length = "3";  


}
