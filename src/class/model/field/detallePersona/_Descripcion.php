<?php

require_once("class/model/Field.php");

class _FieldDetallePersonaDescripcion extends Field {

  public $type = "varchar";
  public $fieldType = "nf";
  public $default = null;
  public $length = "255";  
  public $name = "descripcion";
  public $alias = "des";
  public $entityName = "detalle_persona";


}
