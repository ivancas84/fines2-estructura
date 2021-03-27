<?php

require_once("class/model/field/comision/_Estado.php");

class FieldComisionEstado extends _FieldComisionEstado {
  public $subtype = "select";
  public $selectValues = ["Confirma", "Rectifica", "Desdobla", "Reagrupa"];  
}
