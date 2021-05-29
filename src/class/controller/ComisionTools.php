<?php

require_once("function/array_combine_key2.php");

class ComisionTools {

  public $container;
  public $id;
  public $comision;

  public function __construct(){
    $this->container = new Container;
  }


  public function actualizarPlanAlumnos(){
    /**
     * Obtiene los alumnos de una determinada comision, y actualiza el plan
     */
    $render = $this->container->getRender("alumno_comision");
    $render->setCondition([
      ["persona","=",$this->alumno["persona"]],
      [
        ["nota_final",">=","7"],
        ["crec",">=","4","OR"],
      ]
    ]);
  }

  
  public function alumnosAprobados(){
    /**
     * Obtener informacion de alumnos aprobados (id de persona y cantidad de asignaturas aprobadas)
     * @return ["persona", "cantidad"]
     */
    $render = $this->container->getRender("calificacion");
    $render->setCondition([
      ["persona","=",$this->alumno["persona"]],
      [
        ["nota_final",">=","7"],
        ["crec",">=","4","OR"],
      ]
    ]);
    $render->setOrder(["pla-anio"=>"asc","pla-semestre"=>"asc","asi-nombre"=>"asc"]);
    return $this->container->getDb()->all("calificacion",$render);
  }

  public function init($id){
    $this->id = $id;
    $this->comision = $this->container->getDb()->get("comision",$id);
    $this->initialize = true;
  }

  public function getValue(){
    return $this->container->getRel("comision")->value($this->comision);
  }

}