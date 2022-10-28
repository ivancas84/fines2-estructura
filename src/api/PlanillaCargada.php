<?php

require_once("class/api/Base.php");
require_once("function/php_input.php");
class PlanillaCargadaApi extends BaseApi {

  public function main() {
    $this->container->getAuth()->authorize("toma", "r");
    $idToma_ = php_input();

    $render = $this->container->getEntityRender("toma");
    $render->setCondition([
      ["id","=",$idToma_],
    ]);
    $render->setFields(["id","curso"]);
    
    $toma_ = $this->container->getDb()->select("toma",$render);
    $idCurso_ = array_column($toma_, "curso");

    $render = $this->container->getEntityRender("calificacion");
    $render->setCondition([
      ["curso","=",$idCurso_],
    ]);
    $render->setFields(["curso"]);

    $cursoConCalificacion_ = array_column(
      $this->container->getDb()->select("calificacion",$render),
      "curso"
    );

    //print_r($idCurso_);

    //print_r($cursoConCalificacion_);

    foreach($toma_ as &$toma){
      $toma["planilla_cargada"] = false;
      if(in_array($toma["curso"],$cursoConCalificacion_)) $toma["planilla_cargada"] = true;
    }  
    
    return $toma_;

    // print_r($toma_);
    // die("test");
  }

}
