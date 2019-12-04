<?php

require_once("class/model/field/comision/turno/Main.php");

class FieldComisionTurno extends FieldComisionTurnoMain {
  public $subtype = "select_text";
  public $selectValues = ["Mañana", "Tarde", "Noche"];
}
