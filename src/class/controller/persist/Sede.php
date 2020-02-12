<?php

require_once("class/controller/Persist.php");

class SedePersist extends Persist { 

    protected $entityName = "sede";

    public function main($data){
        foreach($data as $d) {
            switch($d["entity"]) {
                case "domicilio": $domicilio = $d["row"]; break;
                case "sede": $sede = $d["row"]; break;
            }                    
        }
        
        if($sede["id"]) {
            $ce_bd = Ma::getOrNull("sede", $sede["id"]);
        } else {
            $ce_bd = Ma::oneOrNull("sede", [
                ["numero","=",$sede["numero"]],
                ["centro_educativo","=",$sede["centro_educativo"]],
            ]);    
        }
        
        $deleteDomicilio = false;
        if (!empty($ce_bd)){
            $sede["id"] = $ce_bd["id"];
            if(isset($domicilio)) {
                if (!empty($ce_bd["domicilio"])) $domicilio["id"] = $ce_bd["domicilio"];    
            } else {
                if (!empty($ce_bd["domicilio"])) $deleteDomicilio = $ce_bd["domicilio"];
                $sede["domicilio"] = null;
            }
        }

        if(isset($domicilio)) $sede["domicilio"] = $this->row("domicilio", $domicilio);


        $this->row("sede", $sede);
        if($deleteDomicilio) $this->delete("domicilio", $deleteDomicilio);
    }

}
