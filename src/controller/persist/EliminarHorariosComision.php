<?php

require_once("controller/Persist.php");
require_once("controller/Persist.php");



class EliminarHorariosComisionPersist extends Persist {

    protected $entity_name = "eliminar_horarios_comision";

    public function main($idComision){
        if(empty($idComision)) throw new Exception("La identificacion de comision es erronea");
        $idsHorarios = Ma::ids("horario",["cur_comision","=",$idComision]);
        if(empty($idsHorarios)) throw new Exception("La comision no posee horarios");
        return $this->deleteAll("horario", $idsHorarios);
    }
}
