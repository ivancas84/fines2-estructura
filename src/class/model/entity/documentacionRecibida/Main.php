<?php

require_once("class/model/Entity.php");
require_once("config/entityClasses.php");

class DocumentacionRecibidaEntityMain extends Entity {
  
  public static function name() { return "documentacion_recibida"; }
  public static function alias() { return "dr"; }

  public function getPk(){
    return new FieldDocumentacionRecibidaId;
  }

  public function getFieldsNf(){
    return array(
      new FieldDocumentacionRecibidaFechaRecepcion,
      new FieldDocumentacionRecibidaCalificaciones,
      new FieldDocumentacionRecibidaAsistencia,
      new FieldDocumentacionRecibidaTemasTratados,
      new FieldDocumentacionRecibidaCalificacionesDigital,
    );
  }

  public function getFields_U(){
    return array(
      new FieldDocumentacionRecibidaToma,
    );
  }


}
