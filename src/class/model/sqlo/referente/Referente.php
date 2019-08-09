<?php

require_once("class/model/sqlo/referente/Main.php");

//***** implementacion de Sqlo para una determinada tabla *****
class ReferenteSqlo extends ReferenteSqloMain{


  public function deleteAll(array $ids) { //@override
    if(empty($ids)) throw new Exception("No existen identificadores definidos");
    $ids_ = $this->sql->formatIds($ids);
    $baja = date('Y-m-d H:i:s');
    $sql = "
UPDATE " . $this->entity->sn_() . " SET baja = '{$baja}'
WHERE {$this->entity->getPk()->getName()} IN ({$ids_});
";

    $detail = $ids;
    array_walk($detail, function(&$item) { $item = $this->entity->getName().$item; });
    return ["ids"=>$ids, "sql"=>$sql, "detail"=>$detail];
  }
}
