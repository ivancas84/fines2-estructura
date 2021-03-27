<?php

require_once("class/model/Field.php");

class _FieldComisionRelacionadaRelacion extends Field {

  public $type = "varchar";
  public $fieldType = "mu";
  public $default = null;
  public $name = "relacion";
  public $alias = "rel";
  public $entityName = "comision_relacionada";
  public $entityRefName = "comision";  
  public $dataType = "string";  
  public $subtype = "typeahead";  
  public $length = "45";  


}
