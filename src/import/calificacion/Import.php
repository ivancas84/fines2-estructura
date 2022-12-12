<?php

require_once("import/Import.php");
require_once("model/Db.php");
require_once("tools/Validation.php");
require_once("function/array_group_value.php");
require_once("function/settypebool.php");

class CalificacionImport extends Import{
  /**
   * Importar Calificaciones
   */
  public $mode = "tab";
  public $idCurso;
  public $curso; //curso
  public $dni_; //dnis de alumnos existentes en el curso
  public $alumno_; //datos de alumnos existentes en el curso
  public $id = "calificacion"; //identificacion de la importacion (para facilitara la instanciacion de la clase Element)
  public $cantidadEvaluados = 0;
  public $cantidadAprobados = 0;
  public $cantidadDesaprobados = 0;
  public $fecha = null;

  public function config(){
    if(Validation::is_empty($this->idCurso)) throw new Exception("El id del curso no se encuentra definido");

    $this->curso = $this->container->query("curso")->fieldsTree()->param("id", $this->idCurso)->one();
    if(empty($this->curso)) throw new Exception("El curso no existe");

    $this->dni_();
    $this->container->entity("persona")->identifier = ["numero_documento"];
    $this->container->entity("alumno")->identifier = ["persona-numero_documento"];
    $this->container->entity("calificacion")->identifier = ["persona-numero_documento", "disposicion-planificacion", "disposicion-asignatura"];
    $this->container->entity("disposicion")->identifier = ["planificacion", "asignatura"];
  }


  public function dni_(){
    $alumnoComision = $this->container->query("alumno_comision")
    ->cond(["comision","=",$this->curso["comision"]])
    ->fields()
    ->all();
    $this->dni_ = array_column($alumnoComision,"persona_numero_documento");
    $this->alumno_ = array_group_value($alumnoComision, "persona_numero_documento");
  }

  public function identify(){
    $this->ids["persona"] = [];
    $this->ids["disposicion"] = [];
    $this->ids["calificacion"] = [];
    $this->ids["alumno"] = [];
    
    foreach($this->elements as &$element){
      if(!$element->process) continue;
      if($element->identifyCheck("alumno")) continue;
      if($element->identifyCheck("calificacion")) continue;
      if($element->identifyCheck("persona")) continue;
      if($element->identify("disposicion")) continue;
      
    }
  }

  public function query(){
    $this->queryEntity("persona");
    $this->queryEntity("disposicion");
    $this->queryEntity("calificacion");
    $this->queryEntity("alumno");

  }

  public function process(){    
    foreach($this->elements as &$element) {
      if(!$element->process) continue;
     
      
      $this->existsPersona($element);
      $element->exists("disposicion");
      $element->exists("alumno");


      $idCalificacion = $this->processCalificacion($element);
    }
  }


  
  public function existsPersona(&$element){
    $element->exists("persona");
    $dni = $element->entities["persona"]->_get("numero_documento");
 
    /**
     * Variante del insertElement para verificar los nomrbes de la persona
     */
     
    $personaExistente = $this->container->value("persona");
    $personaExistente->_fromArray($this->dbs["persona"][$dni], "set");
    if(!$element->entities["persona"]->checkNombresParecidos($personaExistente)){
      $element->logs->addLog("persona", "error", "En la base existe una persona cuyos datos no coinciden");
      $element->process = false;
      return false;
    } 

    if(!in_array($dni, $this->dni_)) {
      $element->logs->addLog("persona", "error", "La persona no existe en la comision");
      $element->process = false;
      return false;
    } else {
      $pos = array_search($dni, $this->dni_);
      unset($this->dni_[$pos]);
    }

    return $dni;
  }



  public function processCalificacion(&$element){
    $element->entities["calificacion"]->_set("disposicion",
      $element->entities["disposicion"]->_get("id")
    );
    $element->entities["calificacion"]->_set("alumno",
      $element->entities["alumno"]->_get("id")
    );

    $idCalificacion = $this->processCalificacionElement($element);

    if(Validation::is_empty($element->entities["calificacion"]->_get("crec"))
      && Validation::is_empty($element->entities["calificacion"]->_get("nota_final"))) {
        $element->process = false;
        $element->logs->addLog("calificacion", "info", "Calificacion vacia, no se actualizara ningun valor");
        return false;                
    }
    return $idCalificacion;
  }

  public function processCalificacionElement(&$element){

    try {

      $value = $element->entities["calificacion"]->_get("identifier");
      if(key_exists($value, $this->dbs["calificacion"])) {
        $existente = $this->container->value("calificacion");
        $existente->_fromArray($this->dbs["calificacion"][$value], "set");
        $element->entities["calificacion"]->_set("id",$existente->_get("id"));
        $compare = $element->compare("calificacion", $existente);  
        
        if(
          (in_array("crec", $compare) && !Validation::is_empty($existente->_get("crec"))) 
          || (in_array("nota_final", $compare) && !Validation::is_empty($existente->_get("nota_final")))
        ) {
          $element->logs->addLog("calificacion", "error", "Calificacion diferente, no se actualizara ningun valor");
          $element->process = false;
          return false;
        }

        
        $element->update($compare, "calificacion", $existente, "calificacion", true);
      } else {        
        $element->insert("calificacion");
      }
  
      return $value;
    } catch (Exception $e) {
      $element->process = false;
      $element->logs->addLog($name,"error",$e->getMessage());
      return false;
    }



  }


  public function summary() {
    parent::summary();
    if(count($this->dni_)) {
      echo "<p>Los siguientes alumnos activos no fueron evaluados:<p>";

      foreach($this->dni_ as $dni) {
        $activo = settypebool($this->alumno_[$dni][0]["activo"]);
        if($activo) echo  $dni . " " . $this->alumno_[$dni][0]["persona_apellidos"] . " " . $this->alumno_[$dni][0]["persona_nombres"]. "<br/>";
      }
    }
}












}