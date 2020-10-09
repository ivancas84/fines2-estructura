<?php

require_once("class/model/Field.php");

class _FieldCentroEducativoNombre extends Field {

  public $type = "varchar";
  public $fieldType = "nf";
  public $default = null;
  public $length = "255";  
  public $name = "nombre";
  public $alias = "nom";
  public $entityName = "centro_educativo";


}
