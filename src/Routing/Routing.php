<?
  declare(strict_types=1);
  
  namespace Pion\Routing;
  
  use Pion\Http\Request\RequestInterface;
  use Pion\Routing\Route\RouteInterface;

  class Routing implements RoutingInterface
  {
    /**
     * @var \Pion\Routing\Route\RouteInterface[]
     */
    private $routes;
    
    public function __construct(RouteInterface... $routes)
    {
      $this->routes = $routes;
    }
    
    public function get(RequestInterface $request): ?RouteInterface
    {
      $result = null;
      foreach ($this->routes as $route) {
        if ($route->isSupported($request)) {
          $result = $route;
          break;
        }
      }
      return $result;
    }
  }