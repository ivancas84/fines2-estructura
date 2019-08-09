<?php

require_once("class/model/Entity.php");
require_once("config/entityClasses.php");

class ArchivoEntityMain extends Entity {
  
  public static function name() { return "archivo"; }
  public static function alias() { return "arch"; }

  public function getPk(){
    return new FieldArchivoId;
  }

  public function getFieldsNf(){
    return array(
      new FieldArchivoNombre,
      new FieldArchivoArchivo,
      new FieldArchivoTipo,
      new FieldArchivoTamanio,
    );
  }


}
