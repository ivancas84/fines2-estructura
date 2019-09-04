<?php

require_once("../../config/config.php");

require_once("class/model/Values.php");
require_once("class/import/Import.php");
require_once("class/import/Element.php");

require_once("function/settypebool.php");
require_once("function/array_combine_key.php");
require_once("function/array_unique_key.php");
require_once("function/strto.php");
require_once("function/in_array_r.php");

require_once("function/nombres_parecidos.php");
require_once("class/model/Dba.php");

set_time_limit ( 0 );


class ImportElement_ extends ImportElement {
    
    public function setEntities($row) {
        $this->setEntity_("plan", $row, "plan_");
        $this->setEntity_("carga_horaria", $row, "carga_horaria_");
        $this->setEntity_("asignatura", $row, "asignatura_");
        $this->setEntity_("clasificacion", $row, "clasificacion_");
    }
}

class Import_ extends Import {

    public function element($i, $data){
        $element = new ImportElement_($i, $data); 
        array_push($this->elements, $element);
    }
   
    public function identify(){
        $this->ids["persona"] = [];
        $this->ids["lugar"] = [];
        $this->ids["inscripcion_vud"] = [];
        $this->ids["alumno"] = [];

        foreach($this->elements as &$element){
            $this->identifyValue_("plan", $element["plan"]->_identifier());
            $this->identifyValue_("carga_horaria", $element["plan"]->_identifier());
            $this->identifyValue_("asignatra", $element["plan"]->_identifier());
            $this->identifyValue_("plan", $element["plan"]->_identifier());
            


            $dni = $element->entities["persona"]->numeroDocumento();
            if($element->entities["persona"]->isEmpty($dni)){
                $element->process = false;                
                $element->addError("El número de documento no se encuentra definido");
                continue;
            }
        
            array_push($this->ids["persona"], $element->entities["persona"]->numeroDocumento);        
            
            $element->entities["lugar"]->setIdentifier_(
                $element->entities["lugar"]->distrito().UNDEFINED.
                $element->entities["lugar"]->provincia()
            );

            if(!in_array($element->entities["lugar"]->identifier_(), $this->ids["lugar"])) array_push($this->ids["lugar"], $element->entities["lugar"]->identifier_());

            $element->entities["inscripcion_vud"]->setIdentifier_(
                $element->entities["inscripcion_vud"]->fechaPreinscripcion("Y-m-d H:i:s").UNDEFINED.
                $element->entities["persona"]->numeroDocumento()
            );        

            array_push($this->ids["inscripcion_vud"], $element->entities["inscripcion_vud"]->identifier_());            
        }
    }

    
    public function query(){

        $this->queryEntityField_("persona","numero_documento");
        $this->ids["alumno"] = array_unique_key($this->dbs["persona"], "id");

        $this->queryEntityField_("alumno","persona");
        $this->queryEntityIdentifier_("lugar");
        $this->queryEntityIdentifier_("inscripcion_vud");
    }

    public function process(){
        $this->processPersonas();
        $this->processAlumnos();
        $this->processLugar();
        $this->processInscripcionesVud();
    }

    public function processAlumnos(){
        foreach($this->elements as &$element) {
            if(!$element->process) continue;
            
            $element->entities["alumno"]->setPersona($element->entities["persona"]->id());
            if(key_exists($element->entities["persona"]->id(), $this->dbs["alumno"])){
                $alumnoExistente = EntityValues::getInstanceRequire("alumno");
                $alumnoExistente->fromArray($this->dbs["alumno"][$element->entities["persona"]->id()]);
                $this->update_($element, "alumno", $alumnoExistente);            
            } else {
                $this->insert_($element, "alumno");            
            }
            $this->dbs["alumno"][$element->entities["persona"]->id()] = $element->entities["alumno"]->toArray();
        }
      }

    public function processLugar(){
        foreach($this->elements as &$element) {
            if(!$element->process) continue;
        
            $this->processEntityIdentifier_($element, "lugar");
        }
    }

    public function processInscripcionesVud(){
        foreach($this->elements as &$element) {
            if(!$element->process) continue;
            
            $element->entities["inscripcion_vud"]->setAlumno($element->entities["alumno"]->id());
            $element->entities["inscripcion_vud"]->setLugar($element->entities["lugar"]->id());

            $this->processEntityIdentifier_($element, "inscripcion_vud");
        }
    }
}

$import = new ImportInscripcionesVud();
$import->file = $_GET["archivo"]; //ubicado en el directorio tmp con extension csv
$import->pathSummary = PATH_ROOT . "doc/informe/" . date("YmdHis") . "_".$import->file;

$import->execute();
// echo "<pre>";


