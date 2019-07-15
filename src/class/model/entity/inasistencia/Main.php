<?php

require_once("class/model/Entity.php");
require_once("config/entityClasses.php");

class InasistenciaEntityMain extends Entity {
  public $name = "inasistencia";
  public $alias = "inas";
 
  public function getPk(){
    return new FieldInasistenciaId;
  }

  public function getFieldsNf(){
    return array(
      new FieldInasistenciaFechaDesde,
      new FieldInasistenciaFechaHasta,
      new FieldInasistenciaModulosSemanales,
      new FieldInasistenciaModulosMensuales,
      new FieldInasistenciaArticulo,
      new FieldInasistenciaInciso,
      new FieldInasistenciaObservaciones,
    );
  }

  public function getFieldsMu(){
    return array(
      new FieldInasistenciaToma,
    );
  }


}
