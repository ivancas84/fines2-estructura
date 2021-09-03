<?php

require_once("class/api/Base.php");
require_once("function/php_input.php");
require_once("function/array_combine_key.php");

class TransferirAlumnosActivosApi extends BaseApi {
  /**
   * Transferir alumnos activos de un periodo a otro de la misma division
   */

  public $data;
  public $sql = "";
  public $detail = [];
  public $permission = "w";
  public $entityName = "alumno_comision";

  public function main() {
    /**
     * Los datos de la entidad semiobsoleta alumno-comision para una determinada comision indicada como parametro,
     * son transferidos a los alumnos, se actualizan valores si no existen
     */
    $this->container->getAuth()->authorize($this->entityName, $this->permission);
    if(!$this->data) $this->data = php_input();
    /**
     * id: comision a transferir
     */
    
    $this->comision = $this->container->getDb()->get("comision",$this->data["id"]);

    $this->alumnoComision_();
    $this->alumnoComisionSiguiente_();
    $this->alumnoComisionInsertar_();
    $this->persistAlumnoComisionInsertar_();

    $this->container->getDb()->multi_query_transaction($this->sql);
    return(["id"=>$this->data["id"],"detail"=>$this->detail]);
  }

  protected function alumnoComision_(){
    $render = $this->container->getControllerEntity("render_build", "alumno_comision")->main();
    $render->setCondition(["comision","=",$this->comision["id"]]);
    $render->setSize(0);
    $this->alumnoComision_ = $this->container->getDb()->all("alumno_comision",$render);
  }

  protected function alumnoComisionSiguiente_(){
    $render = $this->container->getControllerEntity("render_build", "alumno_comision")->main();
    $render->setCondition(["comision","=",$this->comision["comision_siguiente"]]);
    $render->setSize(0);
    $this->alumnoComisionSiguiente_ = $this->container->getDb()->all("alumno_comision",$render);
  }

  protected function alumnoComisionInsertar_(){
    $this->alumnoComisionInsertar_ = [];

    foreach($this->alumnoComision_ as $ac){
      $insert = true;
      foreach($this->alumnoComisionSiguiente_ as $acs){
        if($acs["alumno"] == $ac["alumno"] ) {
          $insert = false;
          break;
        }
      }
      if($insert) array_push($this->alumnoComisionInsertar_, $ac);
    }
  }

  protected function persistAlumnoComisionInsertar_(){
    foreach($this->alumnoComisionInsertar_ as $aci){
      $a = [
        "alumno" => $aci["alumno"],
        "comision" => $this->comision["comision_siguiente"],
        "activo" => true
      ];

      $p = $this->container->getControllerEntity("persist_sql", "alumno_comision")->id($a);
      $this->sql .= $p["sql"];
      array_push($this->detail,"comision".$p["id"]);
    }
  }


}
