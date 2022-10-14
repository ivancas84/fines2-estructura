<?php

/**
 * CONSIDERACIONES
 * no se procesaran las personas sin dni ya que no puede asignarse la trayectoria
 * si existe mas de una inscripcion por alumno solo se procesara la primera, ignorando la segunda
 * si se vuelve a cargar el mismo archivo (respetando los parámetros), se actualizaran los datos. Con esto se da la posibilidad de correjir los errores en el csv y volverlo a cargar.
 */
set_time_limit(0);  
require_once("class/controller/Base.php");
require_once("function/settypebool.php");
require_once("function/array_group_value.php");


class AsignaturasAprobadasAlumnosScript extends BaseController {

  function main() {
    $idComision = $_REQUEST["comision"];
    $alumnoComision_ = $this->alumnoComision_($idComision);

    $idAlumno_ = array_unique(
      array_column($alumnoComision_, "alumno")
    );

    $comision = $this->container->getDb()->get("comision", $idComision);
    $comisionValue = $this->container->getEntityTools("comision")->value($comision);

    $disposicion_ = $this->disposicion_($comision["pla_plan"]);

    $alumno__calificacionAprobada_ = $this->alumno__calificacionAprobada_($idAlumno_, $comision["pla_plan"]);
    require_once("class/script/AsignaturasAprobadasAlumnos.html");

  }




  public function alumnoComision_($idComision){
    $render = $this->container->getEntityRender("alumno_comision");
    $render->setFields(["id","alumno","activo","alu_per-nombres","alu_per-apellidos","alu_per-numero_documento","alu-tramo_ingreso"]);
    $render->setSize(0);
    $render->setCondition([
      ["comision","=",$idComision],
    ]);
    $render->setOrder([
      "activo"=>"DESC",
      "alu_per-apellidos"=>"ASC",
      "alu_per-nombres"=>"ASC",
    ]);
    return $this->container->getDb()->select("alumno_comision", $render);
  }




  public function alumno__calificacionAprobada_($idAlumno_, $plan){
    /**
     * Array asociativo id_alumno => array de calificaciones aprobadas
     */
    if(empty($idAlumno_)) return [];
    $render = $this->container->getEntityRender("calificacion");
    $render->setFields(["id","alumno","nota_final","crec", "alu_per-nombres","alu_per-apellidos","alu_per-numero_documento","alu-tramo_ingreso","alu-plan","dis_pla-tramo","dis_pla-plan","dis-asignatura"]);

    $render->setSize(0);
    $render->setCondition([
      ["alumno","=",$idAlumno_],
      [
        ["nota_final",">=","7"],
        ["crec",">=","4","OR"]
      ],
      ["dis_pla-plan","=",$plan],

    ]);
    $render->setOrder(["dis_pla-anio"=>"ASC", "dis_pla-semestre"=>"ASC"]);
    
    return array_group_value(
      $this->container->getDb()->select("calificacion",$render),
      "alumno"
    );

  }

  public function disposicion_($plan){
    $render = $this->container->getEntityRender("disposicion");
    $render->setFields(["id","pla-tramo", "asignatura", "asi-nombre"]);
    $render->setSize(0);
    $render->setCondition([
      ["pla-plan","=",$plan],
    ]);
    $render->setOrder([
      "pla-anio" => "ASC",
      "pla-semestre" => "ASC",
      "asi-nombre" => "ASC",
    ]);

    return $this->container->getDb()->select("disposicion", $render);
  }

}


?>
