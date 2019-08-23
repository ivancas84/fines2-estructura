<?php

require_once("class/model/Entity.php");
require_once("class/model/Field.php");

class Nomina2EntityMain extends Entity {
  public $name = "nomina2";
  public $alias = "noa";
 
  public function getPk(){
    return Field::getInstanceRequire("nomina2", "id");
  }

  public function getFieldsNf(){
    return array(
      Field::getInstanceRequire("nomina2", "fotocopia_documento"),
      Field::getInstanceRequire("nomina2", "partida_nacimiento"),
      Field::getInstanceRequire("nomina2", "alta"),
      Field::getInstanceRequire("nomina2", "constancia_cuil"),
      Field::getInstanceRequire("nomina2", "certificado_estudios"),
      Field::getInstanceRequire("nomina2", "anio_ingreso"),
      Field::getInstanceRequire("nomina2", "activo"),
      Field::getInstanceRequire("nomina2", "programa"),
      Field::getInstanceRequire("nomina2", "observaciones"),
    );
  }

  public function getFieldsMu(){
    return array(
      Field::getInstanceRequire("nomina2", "persona"),
      Field::getInstanceRequire("nomina2", "comision"),
    );
  }


}
