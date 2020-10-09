<?php

require_once("class/model/Field.php");

class _FieldAsignaturaCodigo extends Field {

  public $type = "varchar";
  public $fieldType = "nf";
  public $default = null;
  public $length = "45";  
  public $name = "codigo";
  public $alias = "cod";
  public $entityName = "asignatura";


}
