<?php

require_once("class/api/Base.php");
require_once("class/controller/ModelTools.php");

class CursoHorarioBaseApi extends BaseApi {
  public $entityName = "curso_horario";

  public function main() {
    $idCursos = Filter::jsonPostRequired(); //siempre deben recibirse ids
    return  ModelTools::cursoHorario($idCursos);

  }

}

