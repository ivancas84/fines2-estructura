<?php

require_once("class/model/field/cargaHoraria/semestre/Main.php");

class FieldCargaHorariaSemestre extends FieldCargaHorariaSemestreMain {
  public $subtype = "select_int";
  public $selectValues = [1,2];
}
