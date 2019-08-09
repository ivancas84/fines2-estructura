<?php

require_once("class/model/Entity.php");
require_once("config/entityClasses.php");

class IdPersonaEntityMain extends Entity {
  public $name = "id_persona";
  public $alias = "ip";
 
  public function getPk(){
    return new FieldIdPersonaId;
  }

  public function getFieldsNf(){
    return array(
      new FieldIdPersonaNombres,
      new FieldIdPersonaApellidos,
      new FieldIdPersonaSobrenombre,
      new FieldIdPersonaFechaNacimiento,
      new FieldIdPersonaTipoDocumento,
      new FieldIdPersonaNumeroDocumento,
      new FieldIdPersonaEmail,
      new FieldIdPersonaGenero,
      new FieldIdPersonaCuil,
      new FieldIdPersonaAlta,
    );
  }


}
