<?php

require_once("class/model/field/planificacion/_Semestre.php");

class FieldPlanificacionSemestre extends _FieldPlanificacionSemestre {
  public $subtype = "select_text";
  public $selectValues = ["1","2"];
}
