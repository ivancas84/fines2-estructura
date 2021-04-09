<?php

require_once("class/api/Base.php");
require_once("function/php_input.php");
require_once("function/array_combine_key.php");

class TransferirAlumnoComisionApi extends BaseApi {

  public $data;
  public $sql = "";
  public $detail = [];
  public $permission = "w";

  public function main() {
    /**
     * Los datos de la entidad semiobsoleta alumno-comision para una determinada comision indicada como parametro,
     * son transferidos a los alumnos, se actualizan valores si no existen
     */
    $this->container->getAuth()->authorize($this->entityName, $this->permission);
    $this->data = php_input();
    /**
     * id: comision a transferir
     */
    
    $this->consultarComisionAlumnos();
    $this->consultarAlumnos();
    $this->persistirAlumnos();
    $this->container->getDb()->multi_query_transaction($this->sql);
    return(["id"=>$this->data["id"],"detail"=>$this->detail]);
  }

  protected function consultarComisionAlumnos(){
    $render = $this->container->getRender("alumno_comision");
    $render->setCondition(["comision","=",$this->data["id"]]);
    $this->alumnoComisionArray = array_combine_key( 
      $this->container->getDb()->all("alumno_comision", $render),
      "persona"
    );
  }

  protected function consultarAlumnos(){
    $render = $this->container->getRender("alumno");
    
    $render->setCondition([
      "persona",
      "=",
      array_keys($this->alumnoComisionArray)
    ]);
    
    $this->alumnoArray = array_combine_key( 
      $this->container->getDb()->all("alumno", $render),
      "persona"
    );
  }

  protected function persistirAlumnos(){
    foreach($this->alumnoComisionArray as $idPersona => $alumnoComision){
      $ac = $this->container->getRel("alumno_comision")->value($alumnoComision)["alumno_comision"];
      $anioIngresoAc = (int) filter_var($ac->_get("anio_ingreso"), FILTER_SANITIZE_NUMBER_INT);  
      if(array_key_exists($idPersona, $this->alumnoArray)){
        $a = $this->container->getRel("alumno")->value($this->alumnoArray[$idPersona])["alumno"];

        //actualizar solo si corresponde
        if($ac->_get("fotocopia_documento")) $a->_fastSet("tiene_documento", true);
        if($ac->_get("partida_nacimiento")) $a->_fastSet("tiene_partida_nacimiento", true);
        if($ac->_get("constancia_cuil")) $a->_fastSet("tiene_cuil", true);
        if($ac->_get("certificado_estudios")) $a->_fastSet("tiene_certificado_estudios", true);
        
        $anioIngresoA = (int) filter_var($a->_get("anio_ingreso"), FILTER_SANITIZE_NUMBER_INT);  
        if((empty($anioIngresoA) && !empty($anioIngresoAc)) || ($anioIngresoAc < $anioIngresoA)) $this->_fastSet("anio_ingreso",$anioIngresoAc);
        if($ac->_get("observaciones")) {
          if($a->_get("observaciones")) $a->_fastSet("observaciones", $a->_get("observaciones") . " / " . $ac->_get("observaciones"));
          else $a->_fastSet("observaciones", $ac->_get("observaciones"));
        }
     
      } else {
        $a = $this->container->getValue("alumno");
        $a->_fastSet("tiene_documento", $ac->_get("fotocopia_documento"));
        $a->_fastSet("tiene_cuil", $ac->_get("cuil"));
        $a->_fastSet("tiene_certificado_estudios", $ac->_get("certificado_estudios"));
        $a->_fastSet("tiene_partida_nacimiento", $ac->_get("partida_nacimiento"));
        $a->_fastSet("observaciones", $ac->_get("observaciones"));
        $a->_fastSet("persona", $ac->_get("persona"));
        $a->_fastSet("anio_ingreso", $anioIngresoAc);
      }

      $persist = $this->container->getControllerEntity("persist_sql_value", "alumno")->id($a);
      $this->sql .= $persist["sql"];
      array_push($this->detail, "alumno".$persist["id"]);
    }
  }
}
