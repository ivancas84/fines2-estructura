<?php

require_once("../config/config.php");
require_once("class/tools/Filter.php");
require_once("class/controller/persist/ComisionesSiguientesGrupo.php");
require_once("class/model/db/Dba.php");

try {
    $grupo = Filter::getAll();
    $controller = new ComisionesSiguientesGrupoPersist();
    $controller->main($grupo);

    echo "<pre>".$controller->getSql();
    $db = Dba::dbInstance();
        
    //try { $db->multiQueryTransaction($controller->getSql()); } 
    //finally { Dba::dbClose(); }
    
    //echo "<script>window.close();</script>";

} catch(Exception $ex){
    echo $ex->getMessage();
}