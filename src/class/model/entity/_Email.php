<?php

require_once("class/model/Entity.php");
require_once("class/model/Field.php");

class _EmailEntity extends Entity {
  public $name = "email";
  public $alias = "emai";
  public $nf = ['email', 'verificado', 'insertado', 'eliminado'];
  public $mu = ['persona'];
  public $_u = [];
  public $notNull = ['id', 'email', 'verificado', 'insertado', 'persona'];
  public $unique = ['id'];


}
