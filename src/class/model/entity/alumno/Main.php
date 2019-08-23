<?php

require_once("class/model/Entity.php");
require_once("class/model/Field.php");

class AlumnoEntityMain extends Entity {
  public $name = "alumno";
  public $alias = "alum";
 
  public function getPk(){
    return Field::getInstanceRequire("alumno", "id");
  }

  public function getFieldsNf(){
    return array(
      Field::getInstanceRequire("alumno", "fotocopia_documento"),
      Field::getInstanceRequire("alumno", "partida_nacimiento"),
      Field::getInstanceRequire("alumno", "constancia_cuil"),
      Field::getInstanceRequire("alumno", "certificado_estudios"),
      Field::getInstanceRequire("alumno", "anio_ingreso"),
      Field::getInstanceRequire("alumno", "observaciones"),
    );
  }

  public function getFields_U(){
    return array(
      Field::getInstanceRequire("alumno", "persona"),
    );
  }


}
