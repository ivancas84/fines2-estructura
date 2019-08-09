<?php

require_once("class/model/Entity.php");
require_once("config/entityClasses.php");

class TomaEntityMain extends Entity {
  public $name = "toma";
  public $alias = "toma";
 
  public function getPk(){
    return new FieldTomaId;
  }

  public function getFieldsNf(){
    return array(
      new FieldTomaFechaToma,
      new FieldTomaFechaInicio,
      new FieldTomaFechaFin,
      new FieldTomaFechaEntradaContralor,
      new FieldTomaEstado,
      new FieldTomaObservaciones,
      new FieldTomaComentarioContralor,
      new FieldTomaAlta,
      new FieldTomaTipoMovimiento,
      new FieldTomaEstadoContralor,
    );
  }

  public function getFieldsMu(){
    return array(
      new FieldTomaCurso,
      new FieldTomaProfesor,
      new FieldTomaReemplaza,
    );
  }


}
