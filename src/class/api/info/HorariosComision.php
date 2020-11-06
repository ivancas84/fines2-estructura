<?php

require_once("class/api/Base.php");



class HorariosComisionInfoApi extends BaseApi {
  public $entityName = "horarios_comision";

  public function main($idComisiones) {
    return ModelTools::diasHorariosComision($idComisiones);
  }

}

