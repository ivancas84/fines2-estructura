<?php

require_once("class/model/field/idPersona/genero/Main.php");

class FieldIdPersonaGenero extends FieldIdPersonaGeneroMain {
  public $subtype = "select_text";
  public $selectValues = ["Masculino", "Feminino", "Otro"];
}
