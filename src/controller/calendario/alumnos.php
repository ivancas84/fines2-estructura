<?php


class CalendarioAlumnos  {

    public function alumnos_comision_activos_con_siguiente($anio_calendario, $semestre_calendario){
        return $this->container->query("alumno_comision")
        ->param("calendario-anio",$anio_calendario)
        ->param("calendario-semestre",$semestre_calendario)
        ->param("estado","Activo")
        ->param("comision-comision_siguiente",true)
        ->size(0)
        ->fields()
        ->all();
    }

    public function alumnos_comision($anio_calendario, $semestre_calendario){
        return $this->container->query("alumno_comision")
        ->param("calendario-anio",$anio_calendario)
        ->param("calendario-semestre",$semestre_calendario)
        ->size(0)
        ->fields()
        ->all();
    }

}