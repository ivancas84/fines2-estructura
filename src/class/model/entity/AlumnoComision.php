<?php

require_once("class/model/entity/_AlumnoComision.php");

class AlumnoComisionEntity extends _AlumnoComisionEntity  {
 
  //public $identifier = ["per-numero_documento", "com_sed-numero","com-division", "com_pla-anio", "com_pla-semestre"]; 
  public $uniqueMultiple = ["persona","comision"];
}
