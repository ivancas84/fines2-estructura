<?php

require_once("class/model/Field.php");

class _FieldModalidadNombre extends Field {

  public $type = "varchar";
  public $fieldType = "nf";
  public $default = null;
  public $length = "45";  
  public $name = "nombre";
  public $alias = "nom";
  public $entityName = "modalidad";


}
