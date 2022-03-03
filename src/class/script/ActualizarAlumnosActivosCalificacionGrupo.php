<?php
set_time_limit(0);  
require_once("class/controller/Base.php");
require_once("function/array_combine_key.php");

class ActualizarAlumnosActivosCalificacionGrupoScript extends BaseController{
  /**
   * Actualizar alumnos activos de las comisiones de un grupo.
   * 
   * Consultar comisiones de grupo. Consultar alumnos de dichas comisiones.
   * Desactivar alumnos con menos de 3 materias aprobadas. Transferir alumnos
   * con 3 o mas materias aprobadas.
   * 
   * La condicion se define directamente en el script. Se genera sql para co-
   * piar.
   */
  protected $comision_ = [];
  protected $sql = "";

  public function comision_(){
    $render = $this->container->getRender("comision");

    $render->setCondition([
      ["id","=","6209156c68e89"]
      // ["cal-anio","=","2021"],
      // ["cal-semestre","=","2"],
      // ["modalidad","=","7"],
      // ["autorizada","=",true],
      // ["comision_siguiente","=",true]
    ]);
    $render->setSize(0);

    $this->comision_ = array_combine_key(
      $this->container->getDb()->all("comision", $render),
      "id"
    ); 
  }

  public function transferirAlumnoComision($disposicionesAprobadasAlumno, $idComision){

    if($disposicionesAprobadasAlumno["cantidad"] >= 3){
      $alumnoComisionInsertar = [
        "comision" => $this->comision_[$idComision]["comision_siguiente"],
        "alumno" => $disposicionesAprobadasAlumno["alumno"],
        "activo" => true
      ];

      $this->sql .= $this->container->getControllerEntity("persist_sql", "alumno_comision")->id($alumnoComisionInsertar)["sql"];
    }
  }

  public function desactivarAlumnoComision($disposicionesAprobadasAlumno, $alumnoComision_){
    if($disposicionesAprobadasAlumno["cantidad"] < 3){
      $idAlumnoComision = $alumnoComision_[
        $disposicionesAprobadasAlumno["alumno"]
      ]["id"];
      
      $alumnoComisionActualizar = [
        "id" => $idAlumnoComision,
        "activo" => false
      ];

      $this->sql .= $this->container->getControllerEntity("persist_sql", "alumno_comision")->id($alumnoComisionActualizar)["sql"];
    }
  }


  protected function alumnoComision_($idComision){
    $render = $this->container->getRender();
    $render->addCondition(["comision","=",$idComision]);
    $render->setSize(0);
    return  array_combine_key(
      $this->container->getDb()->all("alumno_comision", $render), 
      "alumno"
    );
  }

  protected function verificarExistenciaComisionSiguiente_(){
    $render = $this->container->getRender("alumno_comision");
    
    $render->setCondition([
      "comision",
      "=", 
      array_column($this->comision_, "comision_siguiente")
    ]);
    
    $cantidad = $this->container->getDb()->count("alumno_comision",$render);

    if($cantidad) throw new Exception("Ya existen alumnos activos para las comisiones del grupo siguiente");

  }

  public function main(){
    $this->comision_();
    $this->verificarExistenciaComisionSiguiente_();

    foreach($this->comision_ as $comision){

      $disposicionesAprobadas_ = $this->container->getController("disposiciones_aprobadas_alumno_comision")->main($comision["id"]);
      $alumnoComision_ = $this->alumnoComision_($comision["id"]);
      
      foreach($disposicionesAprobadas_ as $da){
        $this->desactivarAlumnoComision($da, $alumnoComision_);
        $this->transferirAlumnoComision($da, $comision["id"]);
      }

    }
    
    // $this->container->getDb()->multi_query_transaction($this->sql);
    echo "<pre>".$this->sql;
  }    
 
}
