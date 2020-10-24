<?php

require_once("class/model/Field.php");

class _FieldDesignacionHasta extends Field {

  public $type = "date";
  public $fieldType = "nf";
  public $default = null;
  public $name = "hasta";
  public $alias = "has";
  public $entityName = "designacion";
  public $dataType = "date";  
  public $subtype = "date";  
  public $value = "datetime";  


}
