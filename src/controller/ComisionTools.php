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
     * Obtiene los alumnos de una determinada comision, y actualiza el plan si no lo tiene definido
     */
    $render = $this->container->getEntityRender("alumno_comision");
    $render->setFields("alumno");
    $render->setCondition(["id","=",$this->id]);
    $rows = $this->container->db()->select("alumno_comision",$render);
    print_r($rows);
  }

  
  public function alumnosAprobados(){
    /**
     * Obtener informacion de alumnos aprobados (id de persona y cantidad de asignaturas aprobadas)
     * @return ["persona", "cantidad"]
     */
    $render = $this->container->getEntityRender("calificacion");
    $render->setCondition([
      ["persona","=",$this->alumno["persona"]],
      [
        ["nota_final",">=","7"],
        ["crec",">=","4","OR"],
      ]
    ]);
    $render->setOrder(["planificacion-anio"=>"asc","planificacion-semestre"=>"asc","asignatura-nombre"=>"asc"]);
    return $this->container->db()->all("calificacion",$render);
  }

  public function init($id){
    $this->id = $id;
    $this->comision = $this->container->db()->get("comision",$id);
    $this->initialize = true;
  }

  public function getValue(){
    return $this->container->tools("comision")->value($this->comision);
  }

}