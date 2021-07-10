<?php

require_once("class/model/Field.php");

class _FieldDisposicionPendienteDisposicion extends Field {

  public $type = "varchar";
  public $fieldType = "mu";
  public $default = null;
  public $name = "disposicion";
  public $alias = "dis";
  public $entityName = "disposicion_pendiente";
  public $entityRefName = "disposicion";  
  public $dataType = "string";  
  public $subtype = "typeahead";  
  public $length = "45";  


}
