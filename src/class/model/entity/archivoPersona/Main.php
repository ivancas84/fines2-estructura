<?php

require_once("class/model/Entity.php");
require_once("config/entityClasses.php");

class ArchivoPersonaEntityMain extends Entity {
  
  public static function name() { return "archivo_persona"; }
  public static function alias() { return "ap"; }

  public function getPk(){
    return new FieldArchivoPersonaId;
  }

  public function getFieldsNf(){
    return array(
      new FieldArchivoPersonaAlta,
      new FieldArchivoPersonaBaja,
    );
  }

  public function getFieldsMu(){
    return array(
      new FieldArchivoPersonaPersona,
      new FieldArchivoPersonaArchivo,
    );
  }


}
