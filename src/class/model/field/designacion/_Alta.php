<?php

require_once("class/model/Field.php");

class _FieldDesignacionAlta extends Field {

  public $type = "timestamp";
  public $fieldType = "nf";
  public $default = "current_timestamp()";
  public $name = "alta";
  public $alias = "alt";
  public $entityName = "designacion";
  public $dataType = "timestamp";  
  public $subtype = "timestamp";  
  public $value = "datetime";  


}
