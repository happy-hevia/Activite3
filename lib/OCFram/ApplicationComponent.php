<?php
namespace OCFram;

use OCFram\Application;

abstract class ApplicationComponent
{
  protected $app;
  
  public function __construct(Application $app)
  {
    $this->app = $app;
  }
  
  public function app()
  {
    return $this->app;
  }
}
