<?php

require_once("class/model/Field.php");

class _FieldPlanillaDocenteFechaContralor extends Field {

  public $type = "date";
  public $fieldType = "nf";
  public $default = null;
  public $name = "fecha_contralor";
  public $alias = "fc";
  public $entityName = "planilla_docente";
  public $dataType = "date";  
  public $subtype = "date";  


}
