<?php

require_once("class/model/Entity.php");
require_once("config/entityClasses.php");

class SedeEntityMain extends Entity {
  public $name = "sede";
  public $alias = "sede";
 
  public function getPk(){
    return new FieldSedeId;
  }

  public function getFieldsNf(){
    return array(
      new FieldSedeNumero,
      new FieldSedeNombre,
      new FieldSedeOrganizacion,
      new FieldSedeObservaciones,
      new FieldSedeTipo,
      new FieldSedeAlta,
      new FieldSedeBaja,
      new FieldSedeUsuario,
    );
  }

  public function getFieldsMu(){
    return array(
      new FieldSedeDependencia,
      new FieldSedeTipoSede,
    );
  }

  public function getFields_U(){
    return array(
      new FieldSedeDomicilio,
    );
  }


}
