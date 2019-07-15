<?php

require_once("class/model/field/division/turno/Main.php");

class FieldDivisionTurno extends FieldDivisionTurnoMain {
  public $subtype = "select_text";
  public $selectValues = ["Mañana", "Tarde", "Noche"];
}
