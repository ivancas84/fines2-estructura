<?php

require_once("class/model/entity/_Alumno.php");

class AlumnoEntity extends _AlumnoEntity  {
 
  public $identifier = ["per-numero_documento", "com_sed-numero","com-division", "com_pla-anio", "com_pla-semestre"]; 
  
}
