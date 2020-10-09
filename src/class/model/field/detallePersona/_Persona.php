<?php

require_once("class/model/Field.php");

class _FieldDetallePersonaPersona extends Field {

  public $type = "varchar";
  public $fieldType = "mu";
  public $default = null;
  public $length = "45";  
  public $name = "persona";
  public $alias = "per";
  public $entityName = "detalle_persona";
  public $entityRefName = "persona";  


}
