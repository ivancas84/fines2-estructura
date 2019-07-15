<?php

require_once("class/model/Entity.php");
require_once("config/entityClasses.php");

class NotaEntityMain extends Entity {
  public $name = "nota";
  public $alias = "nota";
 
  public function getPk(){
    return new FieldNotaId;
  }

  public function getFieldsNf(){
    return array(
      new FieldNotaNota,
      new FieldNotaAlta,
    );
  }

  public function getFieldsMu(){
    return array(
      new FieldNotaProfesor,
      new FieldNotaCurso,
      new FieldNotaAlumno,
    );
  }


}
