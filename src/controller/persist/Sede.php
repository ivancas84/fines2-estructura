<?php

require_once("controller/persist.php");

class SedePersist extends Persist { 

    protected $entity_name = "sede";

    public function main($data){

        /**
         * Se inserta o actualiza una sede
         * Se inserta, actualiza o elimina un domicilio
         */
        if(!array_key_exists("sede", $data)) throw new Exception ("Sede no definida");
        
        $existsDomicilio = (array_key_exists("domicilio", $data)) ? true : false;

        if($data["sede"]["id"]) {
            $sede_bd = Ma::getOrNull("sede", $data["sede"]["id"]);
        } else {
            $sede_bd = Ma::oneOrNull("sede", [
                ["numero","=",$data["sede"]["numero"]],
                ["centro_educativo","=",$data["sede"]["centro_educativo"]],
            ]);    
        }
        

        if ($existsDomicilio) {
            if (!empty($sede_bd) && !empty($sede_bd["domicilio"])) {
                $id = $this->update("domicilio", $sede_bd["domicilio"]); 
                $data["sede"]["domicilio"] = $id;
                /**
                 * Actualizar domicilio
                 */
            } else {
                $id = $this->insert("domicilio", $data["domicilio"]);
                $data["sede"]["domicilio"] = $id;
                /**
                 * Insertar domicilio
                 */
            }
        } else {
            if (!empty($sede_bd) && !empty($sede_bd["domicilio"])) $this->delete("domicilio", $sede_bd["domicilio"]);
            $data["sede"]["domicilio"] = null;
            /**
             * Eliminar domicilio
             */
        }


        if (!empty($sede_bd)){
            $data["sede"]["id"] = $sede_bd["id"];
            $this->update("sede", $data["sede"]);
            /**
             * Actualizar sede
             */
        } else {
            $this->insert("sede", $data["sede"]);
            /**
             * Insertar sede
             */
        }
    }
}
