<?php

require_once("function/array_combine_key.php");

class ComisionGenerarHorariosSiguiente  {

    public function main(array $ids_comision){
        $comisiones = $this->container->query("comision")->cond([
            ["id", EQUAL, $ids_comision],
            ["comision_siguiente", EQUAL,true]
        ])->fields()->all();

        $ids_comision_ = array_column($comisiones, "id"); //si la lista inicial contiene comisiones sin siguientes vuelvo a filtrar
        
        $comisiones_horarios = $this->container->controller("dias_horarios","comision")->main($ids_comision_);
        $comisiones_horarios = array_combine_key($comisiones_horarios, "comision");

        // echo "<pre>";
        // print_r($comisiones);
        // print_r($comisiones_horarios);

        $response = [];
        foreach($comisiones as $comision){
            $r["id"] = $comision["id"];
            try {
                if(!array_key_exists($r["id"], $comisiones_horarios)) throw new Exception("La comision no tiene horarios");
                $dias = explode(",",$comisiones_horarios[$r["id"]]["dias_ids"]);
                $hora_inicio = $comisiones_horarios[$r["id"]]["hora_inicio"];
                $this->container->controller("generar_horarios_sql", "comision")->main($comision["comision_siguiente"],$hora_inicio,$dias);
            } catch (Exception $ex){
                $r["error"] = $ex->getMessage();
            }

            array_push($response,$r);
        }

        print_r($response);
        
    }
}