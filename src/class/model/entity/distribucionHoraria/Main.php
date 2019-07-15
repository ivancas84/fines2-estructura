<?php

require_once("class/model/Entity.php");
require_once("config/entityClasses.php");

class DistribucionHorariaEntityMain extends Entity {
  public $name = "distribucion_horaria";
  public $alias = "dh";
 
  public function getPk(){
    return new FieldDistribucionHorariaId;
  }

  public function getFieldsNf(){
    return array(
      new FieldDistribucionHorariaDia,
      new FieldDistribucionHorariaHorasCatedra,
    );
  }

  public function getFieldsMu(){
    return array(
      new FieldDistribucionHorariaCargaHoraria,
    );
  }


}
