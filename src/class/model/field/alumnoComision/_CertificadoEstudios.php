<?php

require_once("class/model/Field.php");

class _FieldAlumnoComisionCertificadoEstudios extends Field {

  public $type = "tinyint";
  public $fieldType = "nf";
  public $default = "0";
  public $name = "certificado_estudios";
  public $alias = "ce";
  public $entityName = "alumno_comision";
  public $dataType = "boolean";  
  public $subtype = "checkbox";  
  public $length = "1";  


}
