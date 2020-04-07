<?php

require_once("class/controller/Persist.php");

class SedePersist extends Persist { 

    protected $entityName = "sede";

    public function main($data){

        /**
         * Se inserta o actualiza una sede
         * Se inserta, actualiza o elimina un domicilio
         */
        if(!array_key_exists($data["sede"])) throw new Exception ("Sede no definida");
        
        $existsDomicilio = (array_key_exists($data["domicilio"])) ? true : false;

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
            if($existsDomicilio) {
                if (!empty($sede_bd["domicilio"])) {
                    $data["domicilio"]["id"] = $sede_bd["domicilio"];
                    $this->update("domicilio", $data["domicilio"]);    
                /**
                 * Actualizar domicilio
                 */
            } else {
                if (!empty($sede_bd["domicilio"])) $this->delete("domicilio", $sede_bd["domicilio"]);
                $data["sede"]["domicilio"] = null;
            }
        }

        if(isset($domicilio)) $data["sede"]["domicilio"] = $this->save("domicilio", $domicilio);

        $this->row("sede", $data["sede"]);
        if($deleteDomicilio) $this->delete("domicilio", $deleteDomicilio);
    }

}
