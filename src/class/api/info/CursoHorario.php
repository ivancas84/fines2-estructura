<?php

require_once("class/api/Base.php");
require_once("class/controller/ModelTools.php");
require_once("class/tools/Filter.php");


class CursoHorarioInfoApi extends BaseApi {
  public $entityName = "curso_horario";

  public function main() {
    $idCursos = Filter::jsonPostRequired(); //siempre deben recibirse ids
    return  ModelTools::cursoHorario($idCursos);

  }

}

