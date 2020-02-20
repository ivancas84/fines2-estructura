<?php

require_once("class/controller/All.php");

class CoordinadorFechaAnioAll extends All {

  
  public function main() {  
    $render = new Render();
    $render->setCondition([
        ["cur_com_fecha_anio","=","2019"],
        ["cur_com_modalidad","=","5"],
    ]);
    $rows = Ma::all("toma", $render);
    $ids = array_unique(array_column($rows, "docente"));

    $render = new Render();
    $render->setCondition([
      [
        ["id","=", $ids],
        ["numero_documento","!=",["35220680","35338216","20415849","38394715","38146908","39981841","16026272","30987520"]]
        /** 
         * Quitar coordinadores incorporados de la Direccion de Adultos
         */
      ],
      ["numero_documento","=",["40979787","38605499"],"OR"],
      /** 
       * Agregar a Sabina y Clara
       */
      
    ]);
    $render->setOrder(["apellidos" => "ASC", "nombres" => "asc"]);
    return Ma::all("persona", $render);
    //echo "<pre>";
    //print_r($rows);
    //return EntitySqlo::getInstanceRequire("toma")->jsonAll($rows);
  }

}

