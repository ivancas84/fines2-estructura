<?php

require_once("class/model/field/planificacion/_Anio.php");

class FieldPlanificacionAnio extends _FieldPlanificacionAnio {
  public $main = true;
  public $subtype = "select_text";
  public $selectValues = ["1","2","3"];
}
