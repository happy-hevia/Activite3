<?php
namespace OCFram;

class PDOFactory
{
  public static function getMysqlConnexion($host, $name, $user, $mdp)
  {
    $db = new \PDO('mysql:host=' . $host . ';dbname=' . $name, $user, $mdp);
    $db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    
    return $db;
  }
}
