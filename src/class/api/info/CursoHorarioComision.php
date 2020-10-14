<?php

require_once("class/controller/All.php");
require_once("class/model/Ma.php");
require_once("class/model/Render.php");
require_once("class/tools/Filter.php");
require_once("class/controller/DisplayRender.php");
require_once("class/controller/ModelTools.php");



class CursoHorarioComisionInfoApi extends BaseApi {
  public $entityName = "curso_horario_comision";

  public function main($idComision) {
    return ModelTools::cursosConHorariosDeComision($idComision);
  }

}

