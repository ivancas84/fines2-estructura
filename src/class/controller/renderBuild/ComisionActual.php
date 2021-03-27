<?php

require_once("class/controller/RenderBuild.php");

class ComisionActualRenderBuild extends RenderBuild {

  public function main($display) {
    $render = Render::getInstanceDisplay($display);
    $render->entityName = "comision";
    $date = new Date();
    $render->addCondition([
      ["fecha_anio","=",$date->format("Y-m-d")],
      ["fecha_semestre","=",semester($date)],
      ["mod-nombre","=","Fines 2"],
      ["sed_ce-nombre","=","CENS 456"]
    ]);
    
    return $render;
  }

}

