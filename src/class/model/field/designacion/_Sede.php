<?php

require_once("class/model/Field.php");

class _FieldDesignacionSede extends Field {

  public $type = "varchar";
  public $fieldType = "mu";
  public $default = null;
  public $length = "45";  
  public $name = "sede";
  public $alias = "sed";
  public $entityName = "designacion";
  public $entityRefName = "sede";  


}
