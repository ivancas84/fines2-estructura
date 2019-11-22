<?php

require_once("class/controller/Persist.php");

class CentroEducativoPersist extends Persist {

    public function main($data){
        foreach($data as $d) {
            switch($d["entity"]) {
                case "domicilio": $domicilio = $d["row"]; break;
                case "centro_educativo": $centroEducativo = $d["row"]; break;
            }                    
        }

        if(empty($centroEducativo["cue"])){
          $centroEducativo["cue"] = null;
        }

        $row_ = Dba::one("centro_educativo", [
            ["nombre","=",$centroEducativo["nombre"]],
            ["cue","=",$centroEducativo["cue"]],
        ]);    
    
        if (!empty($row_)){
            $centroEducativo["id"] = $row_["id"];
            $centroEducativo["domicilio"] = $row_["domicilio"];
            if(isset($domicilio) && !empty($row_["domicilio"])) $domicilio["id"] = $row_["domicilio"];
        }
        

        if(isset($domicilio)) {
            $idDomicilio = $this->row("domicilio", $domicilio);
            $centroEducativo["domicilio"] = $idDomicilio;
        }

        $this->row("centro_educativo", $centroEducativo);
        echo "<pre>";
        print_r($this->logs);

        return $this->logs;
    }

}
