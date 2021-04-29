<?php

require_once("class/model/Field.php");

class _FieldDetallePersonaFecha extends Field {

  public $type = "date";
  public $fieldType = "nf";
  public $default = "curdate()";
  public $name = "fecha";
  public $alias = "fec";
  public $entityName = "detalle_persona";
  public $dataType = "date";  
  public $subtype = "date";  


}
