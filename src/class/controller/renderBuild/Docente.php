<?php

require_once("class/controller/RenderBuild.php");

class DocenteRenderBuild extends RenderBuild {

  public function main($display = null) {
    $render = Render::getInstanceDisplay($display);
    $render->entityName = "persona";    

    $render->addPrefix("doc-");
    $render->setFields(["docente"]);
    $render->addCondition(["docente","=",true]);

    $tomas = $this->container->getDb()->advanced("toma",$render);
    $idPersonas = array_column($tomas, "docente");

    $condition = (empty($idPersonas)) ? false : $idPersonas;
    $render = new Render();
    $render->entityName = "persona";    
    $render->setSize(0);
    $render->addCondition(["id","=",$condition]);
    return $render;
  }

}
