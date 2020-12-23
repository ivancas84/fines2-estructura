<?php

require_once("class/model/Field.php");

class _FieldAsignacionPlanillaDocenteComentario extends Field {

  public $type = "varchar";
  public $fieldType = "nf";
  public $default = null;
  public $name = "comentario";
  public $alias = "com";
  public $entityName = "asignacion_planilla_docente";
  public $dataType = "string";  
  public $subtype = "text";  
  public $length = "255";  


}
