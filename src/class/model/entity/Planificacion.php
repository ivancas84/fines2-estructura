<?php

require_once("class/model/entity/_Planificacion.php");

class PlanificacionEntity extends _PlanificacionEntity {

  public $uniqueMultiple = ["anio","semestre","plan"];
  public $main = ["plan", "anio", "semestre"];

}
