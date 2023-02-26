<?php

require_once("function/array_combine_keys.php");
require_once("function/array_combine_key.php");


class SedeReferentes  {

    
    /**
     * @return array of arrays, each element: ["id","sede","referentes"]
     */
    public function nombre_telefono(array $ids_sede){
        return $this->container->query("designacion")
        ->str_agg(["referentes"=>["persona-nombres", "persona-apellidos", "persona-telefono"]])
        ->param("sede",$ids_sede)
        ->param("hasta",false)
        ->param("cargo-descripcion","Referente")
        ->size(0)
        ->group(["sede"])->all();
    }

}




