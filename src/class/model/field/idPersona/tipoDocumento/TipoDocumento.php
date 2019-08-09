<?php

require_once("class/model/field/idPersona/tipoDocumento/Main.php");

class FieldIdPersonaTipoDocumento extends FieldIdPersonaTipoDocumentoMain {
  public $subtype = "select_text";
  public $selectValues = ["DNI", "LI", "LE", "Pasaporte", "Otro"];
}
