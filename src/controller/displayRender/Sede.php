<?php

require_once("class/controller/DisplayEntityRender.php");
require_once("function/array_unique_key.php");

class SedeDisplayEntityRender extends DisplayEntityRender {

  public $display;
  /**
   * El parametro display se asigna a un atributo para facilitar su manipulacion entre los distintos metodos
   */

  protected function renderComisionCondition($key){
    if(array_key_exists ($key , $this->display["params"])
    && (!empty($this->display["params"][$key]))) {
        $this->renderComision->addCondition($key, "=", $this->display["params"][$key]);
        $this->paramsComision = true;
    }
  }
  
  public function main($display) {
    $this->display = $display;
    $this->paramsComision = false;
    if(array_key_exists ("params" , $this->display)){
      $this->renderComision = new EntityRender();
      foreach($this->display["params"] as $key => $value){
        switch($key) {
          case "centro_educativo":
            /** 
             * parametros de sede 
             */
          break;
          case "modalidad":
            /**
             * parametros de comision
             */
            $this->renderComisionCondition($key);
            unset($this->display["params"][$key]);
          break;
          
          default:
            /**
             * parametros no validos
             */
            unset($this->display["params"][$key]);
        }
      }
      if($this->paramsComision){
        $comisiones = Ma::all("comision", $this->renderComision);
        $sedes = array_unique_key($comisiones, "sede");
      }
    }

    $render = EntityRender::getInstanceDisplay($this->display);
    if(isset($sedes)) $render->addCondition("id","=",$sedes);

    return $render;
  }

}

