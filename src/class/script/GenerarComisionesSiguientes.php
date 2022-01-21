<?php
set_time_limit(0);  
require_once("class/controller/Base.php");

class GenerarComisionesSiguientesScript extends BaseController{
 

  public function main(){
    $container = new Container;
    $import = $container->getImport("comisiones_siguientes");
    $import->idCalendario = 2;
    $import->anio ="2021";
    $import->semestre = "2";
    $import->modalidad =  '1';
    $import->centroEducativo = '6047d36d50316';
    $import->initialize();
    $import->defineSource();
    $import->main();
    $import->summary();
  }    
 
}
