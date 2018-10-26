<?
  declare(strict_types=1);
  
  namespace Pion\Routing;
  
  use Pion\Http\Request\RequestInterface;
  use Pion\Routing\Route\RouteInterface;

  interface RoutingInterface
  {
    public function get(RequestInterface $request): ?RouteInterface;
  }