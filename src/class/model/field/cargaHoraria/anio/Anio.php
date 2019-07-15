<?php

require_once("class/model/field/cargaHoraria/anio/Main.php");

class FieldCargaHorariaAnio extends FieldCargaHorariaAnioMain {
  public $subtype = "select_int";
  public $selectValues = [1,2,3];
}
