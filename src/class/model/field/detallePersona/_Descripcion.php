<?php

require_once("class/model/Field.php");

class _FieldDetallePersonaDescripcion extends Field {

  public $type = "text";
  public $fieldType = "nf";
  public $default = null;
  public $name = "descripcion";
  public $alias = "des";
  public $entityName = "detalle_persona";
  public $dataType = "text";  
  public $subtype = "textarea";  
  public $length = "65535";  


}
