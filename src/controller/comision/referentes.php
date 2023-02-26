<?php

require_once("function/array_combine_keys.php");
require_once("function/array_combine_key.php");


class ComisionReferentes  {

    
    /**
     * @return array of arrays, each element: ["id","sede","referentes"]
     */
    public function nombre_telefono(array $ids_comision){
        $comisiones = $this->container->query("comision")->param("id", $ids_comision)->fields(["id","sede"])->all();
        $id_sedes = array_unique(array_column($comisiones,"sede"));


        $sede_referentes = $this->container->query("designacion")
        ->str_agg(["referentes"=>["persona-nombres", "persona-apellidos", "persona-telefono"]])
        ->param("sede",$id_sedes)
        ->param("hasta",false)
        ->param("cargo-descripcion","Referente")
        ->group(["sede"])->all();


        $sede_referentes = array_combine_key($sede_referentes,"sede");

        foreach($comisiones as &$comision){
            $comision["referentes"] = (array_key_exists($comision["sede"], $sede_referentes)) ? $sede_referentes[$comision["sede"]]["referentes"] : null;
        }

        return $comisiones;
    }

}




