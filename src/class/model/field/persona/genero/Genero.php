<?php

require_once("class/model/field/persona/genero/Main.php");

class FieldPersonaGenero extends FieldPersonaGeneroMain {
  public $subtype = "select_text";
  public $selectValues = ["Femenino", "Masculino", "Otro"];
}
