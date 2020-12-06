<?php

require_once("class/controller/RenderBuild.php");

class DocenteRenderBuild extends RenderBuild {

  public function main($display = null) {
    $render = Render::getInstanceDisplay($display);
    $render->entityName = "persona";    

    $r = clone $render;
    $r->addPrefix("doc-");
    $tomas = $this->container->getDb()->all("toma",$r);
    $idPersonas = array_column($tomas, "docente");
    $condition = (empty($idPersonas)) ? false : $idPersonas;
    $render->addCondition(["id","=",$condition]);
    return $render;
  }

}

