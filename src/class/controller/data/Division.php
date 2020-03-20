<?php

require_once("class/controller/All.php");
require_once("class/model/Ma.php");
require_once("class/model/Render.php");
require_once("class/tools/Filter.php");
require_once("class/controller/DisplayRender.php");
require_once("class/controller/ModelTools.php");
require_once("function/subarray_combine_keys.php");


class DivisionData extends Data {
  public $entityName = "division";


  public function main($display) {
    $displayRender = DisplayRender::getInstanceRequire("comision");
    $render = $displayRender->main($display);
    
    $render->setOrder(["sede"=>"ASC","division"=>"ASC"]);
    $render->setSize(false);    
    $render->setPage(1);
    /**
     * anular size y page
     * si se desean definir estos parametros deben aplicarse sobre el resultado procesado
     */

    $rows = Ma::all("comision", $render);
    return subarray_combine_keys($rows, ["sede", "division", "sed_nombre", "sed_numero"]);
  }
  

}

