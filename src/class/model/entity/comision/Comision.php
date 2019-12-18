<?php

require_once("class/model/entity/comision/Main.php");

class ComisionEntity extends ComisionEntityMain {
    public function getFieldsUniqueMultiple(){
        return array(
          Field::getInstanceRequire("comision", "division"),
          Field::getInstanceRequire("comision", "sede"),
        );
      }
}
