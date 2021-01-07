<?php

require_once("class/model/Field.php");

class _FieldPlanillaDocenteFechaConsejo extends Field {

  public $type = "date";
  public $fieldType = "nf";
  public $default = null;
  public $name = "fecha_consejo";
  public $alias = "fca";
  public $entityName = "planilla_docente";
  public $dataType = "date";  
  public $subtype = "date";  


}
