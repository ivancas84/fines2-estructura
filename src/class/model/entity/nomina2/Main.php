<?php

require_once("class/model/Entity.php");
require_once("config/entityClasses.php");

class Nomina2EntityMain extends Entity {
  public $name = "nomina2";
  public $alias = "noa";
 
  public function getPk(){
    return new FieldNomina2Id;
  }

  public function getFieldsNf(){
    return array(
      new FieldNomina2FotocopiaDocumento,
      new FieldNomina2PartidaNacimiento,
      new FieldNomina2Alta,
      new FieldNomina2ConstanciaCuil,
      new FieldNomina2CertificadoEstudios,
      new FieldNomina2AnioIngreso,
      new FieldNomina2Activo,
      new FieldNomina2Programa,
      new FieldNomina2Observaciones,
    );
  }

  public function getFieldsMu(){
    return array(
      new FieldNomina2Persona,
      new FieldNomina2Comision,
    );
  }


}
