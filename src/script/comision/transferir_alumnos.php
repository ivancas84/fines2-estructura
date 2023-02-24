<?php


class ComisionTransferirAlumnosScript {

    public function main(){

        $id_comision = $_REQUEST["id"];
        $id_comision_transferir = $_REQUEST["id_transferir"];

        $ids_alumno_comision = $this->container->query("alumno_comision")->param("comision",$id_comision)->field("id")->column();
        if(empty($ids_alumno_comision)) throw new Exception("No existen alumnos para transferir");
        $sql = "";
        $detail = [];
        foreach($ids_alumno_comision as $id){
            $data = [
                "id"=>$id,
                "comision"=>$id_comision_transferir
            ];
            $persist = $this->container->controller("persist_sql","alumno_comision")->id($data);
            $sql .= $persist["sql"];
            array_push($detail, $persist["id"]);
        }

        $this->container->db()->multi_query_transaction($sql);
        
        echo "<pre>".$sql;
        print_r($detail);
        //return["detail"=>$detail];

    }
}