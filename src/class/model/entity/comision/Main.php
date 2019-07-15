<?php

require_once("class/model/Entity.php");
require_once("config/entityClasses.php");

class ComisionEntityMain extends Entity {
  public $name = "comision";
  public $alias = "comi";
 
  public function getPk(){
    return new FieldComisionId;
  }

  public function getFieldsNf(){
    return array(
      new FieldComisionAnio,
      new FieldComisionSemestre,
      new FieldComisionObservaciones,
      new FieldComisionFecha,
      new FieldComisionAlta,
      new FieldComisionBaja,
      new FieldComisionUsuario,
      new FieldComisionComentario,
      new FieldComisionAutorizada,
      new FieldComisionApertura,
      new FieldComisionPublicar,
      new FieldComisionFechaAnio,
      new FieldComisionFechaSemestre,
    );
  }

  public function getFieldsMu(){
    return array(
      new FieldComisionComisionSiguiente,
      new FieldComisionDivision,
    );
  }


}
