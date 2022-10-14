<?php

require_once("class/controller/Base.php");
require_once("function/array_group_value.php");
require_once("function/array_combine_key.php");


class Informe20211Script extends BaseController{
  

  public function main(){
    $this->idAlumno_();
    $this->alumno_();
    $this->imprimirCalificacion_();
    $this->imprimirAlumnoSinCalificacion_();
  }

  public function idAlumno_(){
    $render = $this->container->getEntityRender("alumno_comision");
    $render->setSize(false);
    $render->setCondition([
      ["calendario-anio","=","2021"],
      ["calendario-semestre","=","2"],
      ["sede-centro_educativo","=",'6047d36d50316'],
      ["activo","=",true]
    ]);

    $this->alumnoComision_ = array_group_value(
      $this->container->getDb()->all("alumno_comision",$render),
      "alumno"
    );

    $this->idAlumno_=array_keys($this->alumnoComision_);
    
 
  }


  public function alumno_(){
    $render = $this->container->getEntityRender("calificacion");
    $render->setSize(false);
    $render->setOrder(["dis_pla-plan"=>"ASC","dis_pla-anio"=>"ASC","dis_pla-semestre"=>"ASC","dis_asi-codigo"=>"ASC"]);
    $render->setCondition([
      ["alumno","=",$this->idAlumno_],
      [
        ["nota_final",">=","7"],
        ["crec",">=","4","OR"]
      ]
    ]);



    $this->alumno_ = array_group_value(
      $this->container->getDb()->all("calificacion",$render),
      "alumno"
    );

    $this->calificacion_ = $this->alumno_;

    foreach($this->calificacion_ as $idAlumno => &$calificacion_){
      $calificacion_ = array_group_value(
        $calificacion_,
        "dis_pla_anio"
      );

      foreach ($calificacion_ as $anio => &$calificacion2_){
          $calificacion2_ = array_group_value(
            $calificacion2_,
            "dis_pla_semestre"
          );
      }
    }
  }

  public function imprimirCalificacion_(){
    $html = "";
    $i = 0;
    foreach($this->alumno_ as $idAlumno  => $data){
      $i++;
      $a = $this->container->getEntityTools("calificacion")->value($data[0]);
      $html .= "<h2>".$i . " " . $a["persona"]->_get("apellidos","X").", ".$a["persona"]->_get("nombres","Xx Yy")." DNI " .$a["persona"]->_get("numero_documento"  ). "</h2>";

      $html .= "<h3>".$a["plan1"]->_get("orientacion","Xx")." " . $a["plan1"]->_get("resolucion"). " (" . $a["plan1"]->_get("distribucion_horaria"). ")</h3>";

      foreach($this->calificacion_[$idAlumno] as $anio => $cal2_){
        foreach($cal2_ as $semestre => $calificacion_){
          $html .= "<h4> Calificaciones " . $anio . "/" . $semestre . "</h4>
          <ul>";
          foreach($calificacion_ as $calificacion){                 
            $c = $this->container->getEntityTools("calificacion")->value($calificacion);
            $nota = ($c["calificacion"]->_get("nota_final")) ? $c["calificacion"]->_get("nota_final") : $c["calificacion"]  ->_get("crec")."c";
            $html .= "<li>".$c["asignatura1"]->_get("nombre","xx").": " . $nota ."</li>";
          }
          $html .= "</ul>";
        }
        
      }
      $html .= "<h4> Legajo</h4>
  <ul>
";
    $html .= "<li>Estado Inscripción: ".$c["alumno"]->_get("estado_inscripcion") . "</li>";
    $html .= "<li>Adeuda legajo: ".$c["alumno"]->_get("adeuda_legajo") . "</li>";
    $html .= "
  </ul>
";

    }
    echo $html;
  }

  public function imprimirAlumnoSinCalificacion_(){
    $html = "";
    $i = 0;

    $idAlumnosConCalificacion = array_keys($this->alumno_);

    foreach($this->alumnoComision_ as $idAlumno  => $data){
      if(in_array($idAlumno,$idAlumnosConCalificacion)) continue;
      $i++;
      $a = $this->container->getEntityTools("alumno_comision")->value($data[0]);
      $html .= "<h2>".$i . " " . $a["persona"]->_get("apellidos","X").", ".$a["persona"]->_get("nombres","Xx Yy")." DNI " .$a["persona"]->_get("numero_documento"  ). "</h2>
";  
    }
    echo $html;
  }



}
