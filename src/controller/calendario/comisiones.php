<?php


class CalendarioComisiones  {

    public function horarios_comisiones_autorizadas($anio_calendario, $semestre_calendario){
        return $this->container->query("horario")
        ->param("calendario-anio",$anio_calendario)
        ->param("calendario-semestre",$semestre_calendario)
        ->param("comision-autorizada",true)
        ->order(["sede-numero"=>"ASC","comision-division"=>"ASC", "asignatura-nombre"=>"ASC"])
        ->size(0)
        ->fields()
        ->all();
    }

    public function tomas_aprobadas_comisiones_autorizadas($anio_calendario, $semestre_calendario){
        return $this->container->query("toma")
        ->cond([
            ["calendario-anio","=",$anio_calendario],
            ["calendario-semestre","=",$semestre_calendario],
            ["estado","=","Aprobada"],
            ["estado_contralor","=","Pasar"]
          ])
        ->order(["docente-nombres"=>"ASC","docente-apellidos"=>"ASC"])
        ->size(0)
        ->fields()
        ->all();
    }

}