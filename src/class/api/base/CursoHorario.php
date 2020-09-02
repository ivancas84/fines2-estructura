<?php

require_once("class/api/Base.php");

class CursoHorarioBaseApi extends BaseApi {
  public $entityName = "curso_horario";

  public function main($idCursos) {
    return ModelTools::cursoHorario($idCursos);
  }

}

