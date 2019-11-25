<?php

require_once("class/api/Persist.php");

class CentroEducativoPersistApi extends PersistApi {

    public function persist($data){
        foreach($data as $d) {
            switch($d["entity"]) {
                case "domicilio": $domicilio = $d["row"]; break;
                case "centro_educativo": $centroEducativo = $d["row"]; break;
            }                    
        }

        if(empty($centroEducativo["cue"])){
          $centroEducativo["cue"] = null;
        }
        
        if($centroEducativo["id"]) {
            $ce_bd = Dba::getOrNull("centro_educativo", $centroEducativo["id"]);
        } else {
            $ce_bd = Dba::oneOrNull("centro_educativo", [
                ["nombre","=",$centroEducativo["nombre"]],
                ["cue","=",$centroEducativo["cue"]],
            ]);    
        }
        
        $deleteDomicilio = false;
        if (!empty($ce_bd)){
            $centroEducativo["id"] = $ce_bd["id"];
            if(isset($domicilio)) {
                if (!empty($ce_bd["domicilio"])) $domicilio["id"] = $ce_bd["domicilio"];    
                $centroEducativo["domicilio"] = $this->persist->row("domicilio", $domicilio);        
            } else {
                if (!empty($ce_bd["domicilio"])) $deleteDomicilio = $ce_bd["domicilio"];
                $centroEducativo["domicilio"] = null;
            }
        }

        $this->persist->row("centro_educativo", $centroEducativo);
        if($deleteDomicilio) $this->persist->delete("domicilio", $deleteDomicilio);
    }

}
