<?php

require_once("class/controller/Persist.php");

class SedePersist extends Persist { 

    protected $entityName = "sede";

    public function main($data){

        if(!array_key_exists($data["sede"])) throw new Exception ("Sede no definida");
        
        //Si una sede no tiene el domicilio definido, no estara en el array $data
        $existeDomicilio = (array_key_exists($data["domicilio"])) ? true : false;

        if($data["sede"]["id"]) {
            $sede_bd = Ma::getOrNull("sede", $data["sede"]["id"]);
        } else {
            $sede_bd = Ma::oneOrNull("sede", [
                ["numero","=",$data["sede"]["numero"]],
                ["centro_educativo","=",$data["sede"]["centro_educativo"]],
            ]);    
        }
        
        $deleteDomicilio = false;
        if (!empty($sede_bd)){
            $data["sede"]["id"] = $sede_bd["id"];
            if(isset($domiclilio)) {
                if (!empty($sede_bd["domicilio"])) $domicilio["id"] = $sede_bd["domicilio"];    
            } else {
                if (!empty($sede_bd["domicilio"])) $deleteDomicilio = $sede_bd["domicilio"];
                $data["sede"]["domicilio"] = null;
            }
        }

        if(isset($domicilio)) $data["sede"]["domicilio"] = $this->row("domicilio", $domicilio);

        $this->row("sede", $data["sede"]);
        if($deleteDomicilio) $this->delete("domicilio", $deleteDomicilio);
    }

}
