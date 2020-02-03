<?php

require_once("class/model/field/persona/_Genero.php");

class FieldPersonaGenero extends _FieldPersonaGenero {
  public $subtype = "select_text";
  public $selectValues = ["Femenino", "Masculino", "Otro"];
}
