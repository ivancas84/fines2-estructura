<?php


class AlumnoCalificaciones  {

    public function aprobadas_por_anio($id_alumno, $plan, $anio = 1){
        return $this->container->query("calificacion")->cond([
            ["plan_pla-id","=",$plan],  
            ["planificacion_dis-anio",">=",$anio],      
            ["alumno","=",$id_alumno],
            [
              ["nota_final",">=","7"],
              ["crec",">=","4","OR"],
            ]
          ])->fields(["anio"=>"planificacion_dis-anio","cantidad"=> "count"])
          ->size(0)
          ->group(["anio"=>"planificacion_dis-anio"])
          ->order(["planificacion_dis-anio"=>"asc"])
          ->order(["planificacion_dis-semestre"=>"asc"])->all();
    }
}