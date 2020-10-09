<?php

require_once("class/model/Field.php");

class _FieldCursoComision extends Field {

  public $type = "varchar";
  public $fieldType = "mu";
  public $default = null;
  public $length = "45";  
  public $name = "comision";
  public $alias = "com";
  public $entityName = "curso";
  public $entityRefName = "comision";  


}
