<?php

require_once("class/api/FurtherError.php");

class ComisionFurtherErrorApi extends FurtherErrorApi {

  public function main(){
    $data = Filter::jsonPostRequired();
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
          || empty($row = $this->container->getDb()->get("planificacion", $data["planificacion"]))
        ) return ["planificacion" => true ];
        $render= new Render();
        $render->addCondition(["sede","=",$data["sede"]]);
        $render->addCondition(["division","=",$data["division"]]);
        $render->addCondition(["modalidad","=",$data["modalidad"]]);
        $render->addCondition(["pla_anio","=",$row["anio"]]);
        $render->addCondition(["pla_semestre","=",$row["semestre"]]);
        $rows = $this->container->getDb()->all("comision", $render);
        if(count($rows) > 1) return [ "multiple" => true ];
        return ((count($rows) == 1) && ($rows[0]["id"] != $data["id"])) ? ["notUnique" => $rows[0]["id"]] : null;
          
      case "3": case "4": //educacion a distancia, presencial
        if( empty($data["planificacion"])) return ["planificacion" => true ];
        if( 
          empty($data["calendario"])
          && empty($row = $this->container->getDb()->get("planificacion", $data["planificacion"]))
        ) return null;

        $render= new Render();
        $render->addCondition("sede","=",$data["sede"]);
        $render->addCondition("division","=",$data["division"]);
        $render->addCondition("modalidad","=",$data["modalidad"]);
        $render->addCondition("cal_anio","=",$row["anio"]);
        $render->addCondition("cal_semestre","=",$row["semestre"]);
        $id = $this->container->getDb()->idOrNull("comision", $render);
        return ($id && ($id != $data["id"])) ? [ "notUnique" => $id ] : null;
      default:
        return null;
    }
  }

}
