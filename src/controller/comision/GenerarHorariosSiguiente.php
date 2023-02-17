<?php


class GenerarHorariosSiguienteComision  {

    public function main(array $ids_comision){

        $comisiones = $this->container->query("comision")->fields()->cond(
            ["id",EQUAL,$ids_comision],
            ["comision_siguiente",EQUAL,true]
        )->size(0)->all();
        $ids_comision_ = array_column($commisiones, "id"); 
        $comision_horario_s = $this->container->controller_("model_tools")->cursosConHorariosDeComision($ids_comision);



    }
}