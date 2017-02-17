<?php
namespace OCFram;


use OCFram\ApplicationComponent;
use OCFram\Managers;
use OCFram\PDOFactory;
use Twig_Environment;
use Twig_Loader_Filesystem;
use Twig_SimpleFunction;

abstract class BackController extends ApplicationComponent
{
  protected $action = '';
  protected $module = '';
  protected $page = null;
  protected $view = '';
  protected $managers = null;
  protected $twig;

  public function __construct(Application $app, $module, $action)
  {
    parent::__construct($app);

    $config = $this->app()->config();
    $dbHost = $config->get('db-host');
    $dbName = $config->get('db-name');
    $dbUser = $config->get('db-user');
    $dbMdp = $config->get('db-mdp');

    $this->managers = new Managers('PDO', PDOFactory::getMysqlConnexion($dbHost, $dbName, $dbUser, $dbMdp));


    $loader = new Twig_Loader_Filesystem(__DIR__.'/../../App/Frontend/Templates');
    $loader->addPath(__DIR__ . '/../../App/Backend/Templates', 'admin');
    $this->twig = new Twig_Environment($loader, array(
        'cache' => __DIR__.'/../../cache', 'debug' => true,
    ));

//    ajout d'un générateur de lien
    $function = new Twig_SimpleFunction('link', function ($path) {
      return 'http://'.$_SERVER['SERVER_NAME'] . '/' . $path;
    });
    $this->twig->addFunction($function);

    $this->setModule($module);
    $this->setAction($action);
  }

  public function execute()
  {
    $method = 'execute'.ucfirst($this->action);

    if (!is_callable([$this, $method]))
    {
      throw new \RuntimeException('L\'action "'.$this->action.'" n\'est pas définie sur ce module');
    }

    $this->$method($this->app->httpRequest());
  }

  public function page()
  {
    return $this->page;
  }

  public function setModule($module)
  {
    if (!is_string($module) || empty($module))
    {
      throw new \InvalidArgumentException('Le module doit être une chaine de caractères valide');
    }

    $this->module = $module;
  }

  public function setAction($action)
  {
    if (!is_string($action) || empty($action))
    {
      throw new \InvalidArgumentException('L\'action doit être une chaine de caractères valide');
    }

    $this->action = $action;
  }

}
