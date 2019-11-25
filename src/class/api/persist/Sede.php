<?php

require_once("class/api/Persist.php");

class SedePersistApi extends PersistApi {
    /**
     * una sede siempre debe tener definido un numero y una dependencia
     * estos valores seran utilizados para consultar la unicidad
     */
    public function persist($data){
        foreach($data as $d) {
            switch($d["entity"]) {
                case "domicilio": $domicilio = $d["row"]; break;
                case "sede": $sede = $d["row"]; break;
            }                    
        }
        
        if($sede["id"]) {
            $ce_bd = Dba::getOrNull("sede", $sede["id"]);
        } else {
            $ce_bd = Dba::oneOrNull("sede", [
                ["numero","=",$sede["nombre"]],
                ["centro_educativo","=",$sede["centro_educativo"]],
            ]);    
        }
        
        $deleteDomicilio = false;
        if (!empty($ce_bd)){
            $sede["id"] = $ce_bd["id"];
            if(isset($domicilio)) {
                if (!empty($ce_bd["domicilio"])) $domicilio["id"] = $ce_bd["domicilio"];    
                $sede["domicilio"] = $this->persist->row("domicilio", $domicilio);        
            } else {
                if (!empty($ce_bd["domicilio"])) $deleteDomicilio = $ce_bd["domicilio"];
                $sede["domicilio"] = null;
            }
        }

        $this->persist->row("sede", $sede);
        if($deleteDomicilio) $this->persist->delete("domicilio", $deleteDomicilio);
    }
}
