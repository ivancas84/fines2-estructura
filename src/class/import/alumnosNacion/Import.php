<?php

require_once("class/import/Import.php");
require_once("class/model/Db.php");
require_once("class/tools/Validation.php");
require_once("function/array_group_value.php");


class AlumnosNacionImport extends Import{
  /**
   * Importar Alumnos de Comision
   */

  public $id = "alumnos_nacion"; //identificacion de la importacion (para facilitara la instanciacion de la clase Element)
  public $mode = "tab";
  /**
   * @property $dni_: Alumnos existentes en la comisión
   */

  public function main(){
    $this->container->getEntity("alumno")->identifier = ["per-numero_documento"];
    // $this->container->getEntity("alumno_comision")->identifier = ["alu_per-numero_documento", "comision"];

    //parent::main();
    $this->define();
    $this->identify();
    $this->query();
     $this->process();
    // echo "<pre>";
    echo "CANTIDAD " . count($this->elements);
  }

  public function identify(){
    $this->ids["persona"] = [];
    $this->ids["alumno"] = [];
    // $this->ids["alumno_comision"] = [];

    
    foreach($this->elements as &$element){
      if(!$element->process) continue;
      if(!($dni = $element->getIdentifier("persona", "numero_documento"))) continue;
      if(!($idAlumno = $element->getIdentifier("alumno"))) continue;
      // if(!($idAlumnoComision = $element->getIdentifier("alumno_comision"))) continue;

      if(!$this->idEntityFieldCheck("alumno", $idAlumno, $element)) continue;
      if(!$this->idEntityFieldCheck("persona", $dni, $element)) continue;
      // if(!$this->idEntityFieldCheck("alumno_comision", $idAlumnoComision, $element)) continue;
    }
  }

  public function query(){
    $this->queryEntity("persona","numero_documento");
    $this->queryEntity("alumno");
    $this->queryAlumnoComision();
  }


  protected function queryAlumnoComision(){
    /**
     * Consulta a la base de datos de la entidad $entityName.
     * 
     * Utilizando el campo $field (supuestamente unico) y el valor almacenado 
     * de field desde el atributo "ids".
     * Todos los resultados los carga en el atributo "dbs" que indica los va-
     * lores que fueron extraidos de la base de datos.
     */
    $this->dbs["alumno_comision"] = [];

    $render = new Render();
    $render->setSize(false);
    $render->setCondition([
      ["persona-numero_documento","=",$this->ids["persona"]],
      [
        [
          ["calendario-anio","=","2022"],["calendario-semestre","=","1"]
        ],
        [
         ["calendario-anio","=","2021","OR"], ["calendario-semestre","=","2"]
        ]
      ]
    ]);
    $render->setOrder(["calendario-anio"=>"DESC", "calendario-semestre"=>"DESC"]);
    
    $rows = $this->container->getDb()->all("alumno_comision", $render);

    //si se devuelven varias instancias del mismo identificador (no deberia pasar) solo se considerara una
    $this->dbs["alumno_comision"] = array_group_value(
      $rows,
      "alu_per_numero_documento"
    );
   
  }

  public function process(){


    $i = 2;
    $j=0;    
    foreach($this->elements as &$element) {
      $i++;

      $dni = $element->entities["persona"]->_get("numero_documento");

      if($element->institucion == "CENTRO EDUCATIVO DE NIVEL SECUNDARIO Nº462"){
        $j++;
        if(!$element->process) {
          echo "$i sin procesar";
          echo " ($j)<br>";
        } else {

          if(array_key_exists($dni, $this->dbs["alumno_comision"])) {
            $d = $this->dbs["alumno_comision"][$dni][0];
            echo $i . " " . $dni . " ESTA EN COMISION " . $d["com_sed_numero"]. $d["com_division"] . "/".$d["com_pla_anio"].$d["com_pla_semestre"]  ." " . $d["com_cal_anio"]."-".$d["com_cal_semestre"]; 
          } else {
            echo $i ." " . $dni. " no esta en ninguna comision"; 
            if (array_key_exists($dni, $this->dbs["persona"])) echo " (existe la persona)";
            else echo " (no existe la persona)";
          }
          echo " ($j)<br>";
        }
      } elseif(array_key_exists($dni, $this->dbs["alumno_comision"])) {
        $j++;
        $d = $this->dbs["alumno_comision"][$dni][0];
        echo $i . " " . $dni . " ESTA EN COMISION " . $d["com_sed_numero"]. $d["com_division"] . "/".$d["com_pla_anio"].$d["com_pla_semestre"]  ." " . $d["com_cal_anio"]."-".$d["com_cal_semestre"] . " PERTENECE A OTRO CENS"; 
        echo " ($j)<br>";

      }
    }
  }

  
}