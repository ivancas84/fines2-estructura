<?php

require_once("class/model/field/comision/_Turno.php");

class FieldComisionTurno extends _FieldComisionTurno {
  public $subtype = "select";
  public $selectValues = ["Mañana", "Tarde", "Vespertino"];  
}
