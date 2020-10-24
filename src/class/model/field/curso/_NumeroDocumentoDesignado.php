<?php

require_once("class/model/Field.php");

class _FieldCursoNumeroDocumentoDesignado extends Field {

  public $type = "varchar";
  public $fieldType = "nf";
  public $default = null;
  public $name = "numero_documento_designado";
  public $alias = "ndd";
  public $entityName = "curso";
  public $dataType = "string";  
  public $subtype = "text";  
  public $length = "45";  
  public $value = "string";  


}
