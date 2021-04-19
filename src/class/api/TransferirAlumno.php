<?php

require_once("class/api/Base.php");
require_once("function/php_input.php");
require_once("function/array_combine_key.php");

class TransferirAlumnoApi extends BaseApi {

  public $data;
  public $sql = "";
  public $detail = [];

  public function main() {
    $this->container->getAuth()->authorize($this->entityName, $this->permission);
    $this->data = php_input();
    /**
     * id: persona a transferir
     * persona: dni de la persona a las cuales se transferiran los datos
     */
    $this->transferirEntidadAlumno();
    $this->transferirEntidadAlumnoComision();
    $this->transferirEntidadCalificacion();
    $this->transferirEntidadDetallePersona();

    $this->sql .= $this->container->getSqlo("persona")->delete([$this->data["id"]]);
    
    //echo "<pre>".$this->sql;
    $this->container->getDb()->multi_query_transaction($this->sql);
    array_push($this->detail, "persona".$this->data["id"]);
    return(["id"=>null,"detail"=>$this->detail]);
  }

  public function transferirEntidadAlumnoComision(){
    $render = $this->container->getRender("alumno_comision");
    $render->setCondition([
      ["persona","=",$this->data["id"]]
    ]);
    $transferir = array_combine_key(
      $this->container->getDb()->all("alumno_comision",$render),
      "comision"
    );

    $render = $this->container->getRender("alumno_comision");
    $render->setCondition([
      ["persona","=",$this->data["persona"]]
    ]);
    $existentes = array_combine_key( 
      $this->container->getDb()->all("alumno_comision",$render),
      "comision"
    );

    foreach($transferir as $comisionAt => $alumno){
      $at = $this->container->getRel("alumno_comision")->value($alumno)["alumno_comision"];

      if(in_array($comisionAt, $existentes)){
        $ae = $this->container->getRel("alumno_comision")->value($existentes[$comisionAt])["alumno_comision"];
        
        if($at->_get("fotocopia_documento")) $ae->_fastSet("fotocopia_documento", true);
        if($at->_get("partida_nacimiento")) $ae->_fastSet("partida_nacimiento", true);
        if($at->_get("constancia_cuil")) $ae->_fastSet("constancia_cuil", true);
        if($at->_get("certificado_estudios")) $ae->_fastSet("certificado_estudios", true);
        if($at->_get("anio_ingreso")) $ae->_fastSet("anio_ingreso", $at->_get("anio_ingreso"));
        if($at->_get("activo")) $ae->_fastSet("activo", true);
        if($at->_get("observaciones")) {
          if($ae->_get("observaciones")) $ae->_fastSet("observaciones", $ae->_get("observaciones") . " / " . $at->_get("observaciones"));
          else $ae->_fastSet("observaciones", $at->_get("observaciones"));
        }
          
        $ae->_call("reset")->_call("check");
        if($ae->logs->isError()) throw new Exception($ae->logs->toString());
        $this->sql .= $this->container->getSqlo("alumno_comision")->update($ae->_toArray("sql"));
        $this->sql .= $this->container->getSqlo("alumno_comision")->delete([$at->_get("id")]);
        array_push($this->detail, "alumno_comision".$at->_get("id"));      
        array_push($this->detail, "alumno_comision".$ae->_get("id"));
      } else {
        $at->_fastSet("persona",$this->data["persona"]);
        $at->_call("reset")->_call("check");
        if($at->logs->isError()) throw new Exception($at->logs->toString());
        $this->sql .= $this->container->getSqlo("alumno_comision")->update($at->_toArray("sql"));      
        array_push($this->detail, "alumno_comision".$at->_get("id"));
      }
    }
  }

  public function transferirEntidadAlumno(){
    $render = $this->container->getRender("alumno");
    $render->setCondition([
      ["persona","=",$this->data["id"]]
    ]);
    $transferir = $this->container->getDb()->oneOrNull("alumno",$render);

    if(empty($transferir)) return; //si no tiene alumno el que se transfiere

    $render = $this->container->getRender("alumno");
    $render->setCondition([
      ["persona","=",$this->data["persona"]]
    ]);
    $existente = $this->container->getDb()->oneOrNull("alumno",$render);

    $at = $this->container->getValue("alumno")->_fromArray($transferir,"_set");

    if(!empty($existente)){
      $ae = $this->container->getValue("alumno")->_fromArray($existente,"_set");
      if($at->_get("tiene_documento")) $ae->_fastSet("tiene_documento", true);
      if($at->_get("tiene_partida_nacimiento")) $ae->_fastSet("tiene_partida_nacimiento", true);
      if($at->_get("tiene_cuil")) $ae->_fastSet("tiene_cuil", true);
      if($at->_get("tiene_certificado_estudios")) $ae->_fastSet("tiene_certificado_estudios", true);
      if($at->_get("anio_ingreso")) $ae->_fastSet("anio_ingreso", $at->_get("anio_ingreso"));
      if($at->_get("observaciones")) {
        if($ae->_get("observaciones")) $ae->_fastSet("observaciones", $ae->_get("observaciones") . " / " . $at->_get("observaciones"));
        else $ae->_fastSet("observaciones", $at->_get("observaciones"));
      }

      if($at->_get("documento")) $ae->_fastSet("documento", $at->_get("documento"));
      if($at->_get("partida_nacimiento")) $ae->_fastSet("partida_nacimiento", $at->_get("partida_nacimiento"));
      if($at->_get("certificado_estudios")) $ae->_fastSet("certificado_estudios", $at->_get("certificado_estudios"));
      if($at->_get("cuil")) $ae->_fastSet("cuil", $at->_get("cuil"));

      $ae->_call("reset")->_call("check");
      if($ae->logs->isError()) throw new Exception($ae->logs->toString());
      $this->sql .= $this->container->getSqlo("alumno")->update($ae->_toArray("sql"));
      $this->sql .= $this->container->getSqlo("alumno")->delete([$at->_get("id")]);
      array_push($this->detail, "alumno".$at->_get("id"));      
      array_push($this->detail, "alumno".$ae->_get("id"));
    } else {
      $at->_fastSet("persona",$this->data["persona"]);
      $at->_call("reset")->_call("check");
      if($at->logs->isError()) throw new Exception($at->logs->toString());
      $this->sql .= $this->container->getSqlo("alumno")->update($at->_toArray("sql"));      
      array_push($this->detail, "alumno".$at->_get("id"));
    }
  }


  public function transferirEntidadCalificacion(){
    $render = $this->container->getRender("calificacion");
    $render->setCondition([
      ["persona","=",$this->data["id"]]
    ]);
    $transferir = array_combine_key(
      $this->container->getDb()->all("calificacion",$render),
      "curso"
    );

    $render = $this->container->getRender("calificacion");
    $render->setCondition([
      ["persona","=",$this->data["persona"]]
    ]);
    $existentes = array_combine_key( 
      $this->container->getDb()->all("calificacion",$render),
      "curso"
    );

    foreach($transferir as $curso => $calificacion){
      $tr = $this->container->getRel("calificacion")->value($calificacion)["calificacion"];

      if(in_array($curso, $existentes)){
        $ex = $this->container->getRel("calificacion")->value($existentes[$curso])["calificacion"];
        
        $compare = $this->compare($tr,$ex);
        if(!empty($compare)) throw new Exception("No se puede transferir, comparacion erronea: ". $compare);
        
        if($tr->_get("nota1")) $ex->_fastSet("nota1", $tr->_get("nota1"));
        if($tr->_get("nota2")) $ex->_fastSet("nota2", $tr->_get("nota2"));
        if($tr->_get("nota3")) $ex->_fastSet("nota3", $tr->_get("nota3"));
        if($tr->_get("nota_final")) $ex->_fastSet("nota_final", $tr->_get("nota_final"));
        if($tr->_get("crec")) $ex->_fastSet("crec", $tr->_get("crec"));
        if($tr->_get("porcentaje_asistencia")) $ex->_fastSet("porcentaje_asistencia", $tr->_get("porcentaje_asistencia"));
        if($tr->_get("observaciones")) {
          if($ex->_get("observaciones")) $ex->_fastSet("observaciones", $ex->_get("observaciones") . " / " . $tr->_get("observaciones"));
          else $ex->_fastSet("observaciones", $tr->_get("observaciones"));
        }
          
        $ex->_call("reset")->_call("check");
        if($ex->logs->isError()) throw new Exception($ex->logs->toString());
        $this->sql .= $this->container->getSqlo("calificacion")->update($ex->_toArray("sql"));
        $this->sql .= $this->container->getSqlo("calificacion")->delete([$tr->_get("id")]);
        array_push($this->detail, "calificacion".$tr->_get("id"));      
        array_push($this->detail, "calificacion".$ex->_get("id"));
      } else {
        $tr->_fastSet("persona",$this->data["persona"]);
        $tr->_call("reset")->_call("check");
        if($tr->logs->isError()) throw new Exception($tr->logs->toString());
        $this->sql .= $this->container->getSqlo("calificacion")->update($tr->_toArray("sql"));      
        array_push($this->detail, "calificacion".$tr->_get("id"));
      }
    }

  }

  public function transferirEntidadDetallePersona(){
    $persist = $this->container->getController("model_resources")->transferirEntidad("detalle_persona","persona", $this->data["id"],$this->data["persona"]);
    $this->sql .= $persist["sql"];
    $this->detail = array_merge($this->detail,$persist["detail"]);
  }


  public function compare($tr, $ex){
    $a = $tr->_toArray("sql");
    $b = $ex->_toArray("sql");
    $compare = [];
    foreach($a as $ka => $va) {
      if( ($ka =="id") || ($ka =="persona") || ($ka =="observaciones") ) continue;
      if(((is_null($va) || $va == "null")) || !key_exists($ka, $b) || $b[$ka]) continue;
      if($b[$ka] !== $va) array_push($compare, $ka);
    }
    return (empty($compare)) ? true : implode(", ", $compare);
  }
}
