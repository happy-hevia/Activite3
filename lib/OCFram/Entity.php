<?php
namespace OCFram;

abstract class Entity
{
  use Hydrator;

  protected $id;

  public function __construct(array $donnees = [])
  {
    if (!empty($donnees))
    {
      $this->hydrate($donnees);
    }
  }

  public function isNew()
  {
    return empty($this->id);
  }

  public function id()
  {
    return $this->id;
  }

  public function setId($id)
  {
    $this->id = (int) $id;
  }

}
