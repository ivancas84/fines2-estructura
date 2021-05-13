<?php

require_once("class/model/Field.php");

class _FieldAlumnoFechaTitulacion extends Field {

  public $type = "date";
  public $fieldType = "nf";
  public $default = null;
  public $name = "fecha_titulacion";
  public $alias = "ft";
  public $entityName = "alumno";
  public $dataType = "date";  
  public $subtype = "date";  


}
