<?php

require_once("class/model/Field.php");

class _FieldTomaPlanillaDocente extends Field {

  public $type = "varchar";
  public $fieldType = "mu";
  public $default = null;
  public $name = "planilla_docente";
  public $alias = "pd";
  public $entityName = "toma";
  public $entityRefName = "planilla_docente";  
  public $dataType = "string";  
  public $subtype = "typeahead";  
  public $length = "45";  


}
