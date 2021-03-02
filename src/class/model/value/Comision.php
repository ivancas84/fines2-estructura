<?php
require_once("class/model/entityOptions/Value.php");
require_once("function/nombres_parecidos.php");

class ComisionValue extends ValueEntityOptions{

  public function planificacionSiguiente(){
    

    $planificacion = $this->container->getDb()->get("planificacion",$this->_get("planificacion"));
    if (
      (empty($planificacion["anio"])) 
      || (empty($planificacion["semestre"]))
      || (empty($planificacion["plan"]))
    ) return UNDEFINED;

    $anio = intval($planificacion["anio"]);
    $semestre = intval($planificacion["semestre"]);
    
    if(($anio == 3) && ($semestre == 2)) return null;

    $render = new Render();
    $render->setCondition([
      ["plan","=",$planificacion["plan"]],
    ]);

    if($semestre == 1) {
      $render->addCondition([
        ["anio","=",$anio],
        ["semestre","=",++$semestre],
      ]);
    } else {
      $render->addCondition([
        ["anio","=",++$anio],
        ["semestre","=",--$semestre],
      ]);
    }

    $planificacion = $this->container->getDb()->oneOrNull("planificacion",$render);

    return ($planificacion) ? $planificacion["id"] : null;
  }

}
