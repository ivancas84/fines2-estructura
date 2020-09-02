<?php

require_once("class/controller/All.php");
require_once("class/model/Ma.php");
require_once("class/model/Render.php");
require_once("class/tools/Filter.php");
require_once("class/controller/DisplayRender.php");
require_once("class/controller/ModelTools.php");



class HorariosComisionData extends Data {
  public $entityName = "horarios_comision";

  public function main($idComisiones) {
    return ModelTools::diasHorariosComision($idComisiones);
  }

}

