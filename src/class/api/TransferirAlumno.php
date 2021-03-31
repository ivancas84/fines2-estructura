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
    $this->transferirEntidadCalificacion();

    $this->sql .= $this->container->getSqlo("persona")->delete([$this->data["id"]]);
    $this->container->getDb()->multi_query_transaction($this->sql);
    array_push($this->detail, "persona".$this->data["id"]);
    return(["id"=>null,"detail"=>$this->detail]);
  }

  public function transferirEntidadAlumno(){
    $render = $this->container->getRender("alumno");
    $render->setCondition([
      ["persona","=",$this->data["id"]]
    ]);
    $transferir = array_combine_key(
      $this->container->getDb()->all("alumno",$render),
      "comision"
    );

    $render = $this->container->getRender("alumno");
    $render->setCondition([
      ["persona","=",$this->data["persona"]]
    ]);
    $existentes = array_combine_key( 
      $this->container->getDb()->all("alumno",$render),
      "comision"
    );

    foreach($transferir as $comisionAt => $alumno){
      $at = $this->container->getRel("alumno")->value($alumno)["alumno"];

      if(in_array($comisionAt, $existentes)){
        $ae = $this->container->getRel("alumno")->value($existentes[$comisionAt])["alumno"];
        
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
