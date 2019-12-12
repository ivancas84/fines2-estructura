<?php

require_once("class/api/Persist.php");

class ComisionCursoPersistApi extends PersistApi {
    protected $entityName = "comision";

    /**
     * actualizacion:
     *   si tiene cursos no se realiza carga de cursos
     *   si no tiene cursos, si se realiza la carga de cursos
     * insercion:
     *   se realiza la carga de cursos
     */

    public function persist($data){
        foreach($data as $d) {
            switch($d["entity"]) {
                case "comision": $comision = $d["row"]; break;
            }                    
        }

        if(empty($centroEducativo["cue"])){
          $centroEducativo["cue"] = null;
        }
        
        if($centroEducativo["id"]) {
            $ce_bd = Ma::getOrNull("centro_educativo", $centroEducativo["id"]);
        } else {
            $ce_bd = Ma::oneOrNull("centro_educativo", [
                ["nombre","=",$centroEducativo["nombre"]],
                ["cue","=",$centroEducativo["cue"]],
            ]);    
        }
        
        $deleteDomicilio = false;
        if (!empty($ce_bd)){
            $centroEducativo["id"] = $ce_bd["id"];
            if(isset($domicilio)) {
                if (!empty($ce_bd["domicilio"])) $domicilio["id"] = $ce_bd["domicilio"];    
            } else {
                if (!empty($ce_bd["domicilio"])) $deleteDomicilio = $ce_bd["domicilio"];
                $centroEducativo["domicilio"] = null;
            }
        }

        if(isset($domicilio)) $centroEducativo["domicilio"] = $this->persist->row("domicilio", $domicilio);

        $this->persist->row("centro_educativo", $centroEducativo);
        if($deleteDomicilio) $this->persist->delete("domicilio", $deleteDomicilio);
    }
}
