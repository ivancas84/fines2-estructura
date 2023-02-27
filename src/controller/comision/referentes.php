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


        $sede_referentes = $this->container->controller("referentes","sede")->nombre_telefono($id_sedes);
        
        $sede_referentes = array_combine_key($sede_referentes,"sede");

        foreach($comisiones as &$comision){
            $comision["referentes"] = (array_key_exists($comision["sede"], $sede_referentes)) ? $sede_referentes[$comision["sede"]]["referentes"] : null;
        }

        return $comisiones;
    }


    public function referente_mas_actual(array $ids_comision){
        if(empty($ids_comision)) return [];
        
        $sql = "SELECT comision.id as comision, sub.persona
                FROM comision
                INNER JOIN (
                SELECT sede, MAX(hasta), persona
                FROM designacion
                WHERE hasta IS NULL
                GROUP BY sede
                ) sub ON comision.sede = sub.sede
                WHERE comision.id IN ('" . implode("', '", $ids_comision). "');
       ";


        $result = $this->container->db()->query($sql);
        $rows = $result->fetch_all(MYSQLI_ASSOC);
        $result->free();
        return $rows;
    }
}




