<?php

require_once("function/array_group_value.php");
require_once("function/array_combine_key.php");


class ComisionAlumnos  {

    public function cantidad_alumnos_activos(array $ids_comision) {
        return $this->container->query("alumno_comision")
            ->cond(["comision", EQUAL, $ids_comision])
            ->cond(["estado", EQUAL, "Activo"])
            ->fields(["cantidad"=>"count"])
            ->group(["comision"])
            ->size(0)->all();
    }

    public function cantidad_aprobados(array $ids_comision) {
        $alumno_comision = $this->container->query("alumno_comision")
            ->cond(["comision", EQUAL, $ids_comision])
            ->size(0)->fields()->all();
        $alumno_comision = array_group_value($alumno_comision,"comision");
        
        $response = [];

        foreach($alumno_comision as $id_comision => $ac){
            $ids_alumno = array_unique(array_column($ac, "alumno"));
            $plan = $ac[0]["plan-id"];
            $anio = $ac[0]["planificacion-anio"];
            $semestre = $ac[0]["planificacion-semestre"];
            $alumnos_cantidad_calificaciones = $this->container->controller("calificaciones","alumno")->aprobadas_por_tramo($ids_alumno, $plan, $anio, $semestre);

            $total = 0;
            foreach($alumnos_cantidad_calificaciones as $c){
              if($c["cantidad"]>=3) $total++;
            }
        
            array_push($response, [
              "comision" => $id_comision,
              "cantidad_aprobados" => $total,
            ]);
        }
        
      }
}