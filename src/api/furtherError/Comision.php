<?php

require_once("api/FurtherError.php");
require_once("function/php_input.php");

class ComisionFurtherErrorApi extends FurtherErrorApi {

  public function main(){
    /**
     * @todo Falta verificar que, por ejemplo, si voy a cargar una comision de 1/2 que la de 1/1 sea la misma modalidad y plan
     */
    $data = php_input();
    if(empty($data)) return ["empty" => true];

    if(
      empty($data["sede"]) 
      || empty($data["division"])
      || empty($data["modalidad"])
    ) return ["empty"=> true];

    switch ($data["modalidad"]) {
      case "1": case "2": //fines2, secundaria con oficios
        if( 
          empty($data["planificacion"])
          || empty($row = $this->container->db()->get("planificacion", $data["planificacion"]))
        ) return ["planificacion" => true ];
        $render= new EntityRender();
        $render->addCondition(["sede","=",$data["sede"]]);
        $render->addCondition(["division","=",$data["division"]]);
        $render->addCondition(["modalidad","=",$data["modalidad"]]);
        $render->addCondition(["pla-anio","=",$row["anio"]]);
        $render->addCondition(["pla-semestre","=",$row["semestre"]]);
        $rows = $this->container->db()->all("comision", $render);
        if(count($rows) > 1) return [ "multiple" => true ];
        return ((count($rows) == 1) && ($rows[0]["id"] != $data["id"])) ? ["notUnique" => $rows[0]["id"]] : null;
          
      case "3": case "4": //educacion a distancia, presencial
        if( empty($data["planificacion"])) return ["planificacion" => true ];
        if( 
          empty($data["calendario"])
          && empty($row = $this->container->db()->get("planificacion", $data["planificacion"]))
        ) return null;

        $render= new EntityRender();
        $render->addCondition(["sede","=",$data["sede"]]);
        $render->addCondition(["division","=",$data["division"]]);
        $render->addCondition(["modalidad","=",$data["modalidad"]]);

        if($data["calendario"]) {
          $render->addCondition(["calendario","=",$data["calendario"]]);
        } else {
          $render->addCondition(["cal-anio","=",$row["anio"]]);
          $render->addCondition(["cal-semestre","=",$row["semestre"]]);
        }

        $id = $this->container->db()->idOrNull("comision", $render);
        return ($id && ($id != $data["id"])) ? [ "notUnique" => $id ] : null;
      default:
        return null;
    }
  }

}
