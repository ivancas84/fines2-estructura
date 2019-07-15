<?php

require_once("class/model/Entity.php");
require_once("config/entityClasses.php");

class AlumnoEntityMain extends Entity {
  public $name = "alumno";
  public $alias = "alum";
 
  public function getPk(){
    return new FieldAlumnoId;
  }

  public function getFieldsNf(){
    return array(
      new FieldAlumnoFotocopiaDocumento,
      new FieldAlumnoPartidaNacimiento,
      new FieldAlumnoConstanciaCuil,
      new FieldAlumnoCertificadoEstudios,
      new FieldAlumnoAnioIngreso,
      new FieldAlumnoObservaciones,
    );
  }

  public function getFields_U(){
    return array(
      new FieldAlumnoPersona,
    );
  }


}
