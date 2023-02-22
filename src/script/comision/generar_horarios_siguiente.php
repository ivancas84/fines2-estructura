<?php


class ComisionGenerarHorariosSiguienteScript {

    public function main(){

        $anio_calendario = $_REQUEST["anio"];
        $semestre_calendario = $_REQUEST["semestre"];

        $ids_comision = $this->container->query("comision")->field("id")->cond([
            ["calendario-anio",EQUAL,$anio_calendario],
            ["calendario-semestre",EQUAL,$semestre_calendario],
            ["comision_siguiente",EQUAL,true]
        ])->size(0)->column();

        $response = $this->container->controller("horarios","comision")->generar_horarios_siguiente($ids_comision);
        echo "<pre>";
        print_r($response);
    }
}