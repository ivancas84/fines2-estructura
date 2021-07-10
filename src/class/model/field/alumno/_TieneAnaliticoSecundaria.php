<?php

require_once("class/model/Field.php");

class _FieldAlumnoTieneAnaliticoSecundaria extends Field {

  public $type = "tinyint";
  public $fieldType = "nf";
  public $default = "0";
  public $name = "tiene_analitico_secundaria";
  public $alias = "tas";
  public $entityName = "alumno";
  public $dataType = "boolean";  
  public $subtype = "checkbox";  
  public $length = "1";  


}
