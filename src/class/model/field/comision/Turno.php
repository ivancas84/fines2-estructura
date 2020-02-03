<?php

require_once("class/model/field/comision/_Turno.php");

class FieldComisionTurno extends _FieldComisionTurno {
  public $subtype = "select_text";
  public $selectValues = ["Mañana", "Tarde", "Noche"];  
}
