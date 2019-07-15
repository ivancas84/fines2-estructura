<?php

require_once("class/model/Entity.php");
require_once("config/entityClasses.php");

class HorarioEntityMain extends Entity {
  public $name = "horario";
  public $alias = "hora";
 
  public function getPk(){
    return new FieldHorarioId;
  }

  public function getFieldsNf(){
    return array(
      new FieldHorarioHoraInicio,
      new FieldHorarioHoraFin,
    );
  }

  public function getFieldsMu(){
    return array(
      new FieldHorarioDia,
      new FieldHorarioCurso,
    );
  }


}
