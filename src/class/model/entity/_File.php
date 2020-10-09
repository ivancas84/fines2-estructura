<?php

require_once("class/model/Entity.php");
require_once("class/model/Field.php");

class _FileEntity extends Entity {
  public $name = "file";
  public $alias = "file";
  public $main = ['id'];
  public $pk = ['id'];
  public $nf = ['name', 'type', 'content', 'size', 'created'];
  public $mu = [];
  public $_u = [];
  public $notNull = ['id', 'name', 'type', 'content', 'size', 'created'];
  public $unique = ['id'];
  public $admin = ['id', 'name', 'type', 'content', 'size', 'created'];



}
