<?php

require_once("api/Base.php");
require_once("controller/ModelTools.php");



class CursoHorarioComisionInfoApi extends BaseApi {
  public $entityName = "curso_horario_comision";

  public function main($idComision) {
    return ModelTools::cursosConHorariosDeComision($idComision);
  }

}

