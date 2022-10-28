<?php

require_once("class/api/Base.php");
require_once("class/controller/ModelTools.php");



class CursoHorarioComisionInfoApi extends BaseApi {
  public $entityName = "curso_horario_comision";

  public function main($idComision) {
    return ModelTools::cursosConHorariosDeComision($idComision);
  }

}

