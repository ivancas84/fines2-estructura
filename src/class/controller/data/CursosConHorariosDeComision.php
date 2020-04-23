<?php

require_once("class/controller/All.php");
require_once("class/model/Ma.php");
require_once("class/model/Render.php");
require_once("class/tools/Filter.php");
require_once("class/controller/DisplayRender.php");
require_once("class/controller/ModelTools.php");



class CursosConHorariosDeComisionData extends Data {
  public $entityName = "cursos_con_horarios_de_comision";

  public function main($idComision) {
    return ModelTools::cursosConHorariosDeComision($idComision);
  }

}

