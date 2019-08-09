<?php

require_once("class/model/Entity.php");
require_once("config/entityClasses.php");

class CargaHorariaEntityMain extends Entity {
  public $name = "carga_horaria";
  public $alias = "ch";
 
  public function getPk(){
    return new FieldCargaHorariaId;
  }

  public function getFieldsNf(){
    return array(
      new FieldCargaHorariaAnio,
      new FieldCargaHorariaSemestre,
      new FieldCargaHorariaHorasCatedra,
    );
  }

  public function getFieldsMu(){
    return array(
      new FieldCargaHorariaAsignatura,
      new FieldCargaHorariaPlan,
    );
  }


}
