<?php

require_once("class/model/Field.php");

class _FieldDetallePersonaArchivo extends Field {

  public $type = "varchar";
  public $fieldType = "mu";
  public $default = null;
  public $name = "archivo";
  public $alias = "arc";
  public $entityName = "detalle_persona";
  public $entityRefName = "file";  
  public $dataType = "string";  
  public $subtype = "typeahead";  
  public $length = "45";  


}
