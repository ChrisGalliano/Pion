<?
  declare(strict_types=1);

  namespace Pion\Application;

  use Pion\Actions\Resolver\ActionResolver;
  use Pion\Actions\Resolver\Argument\Metadata\Exceptions\UnknownParameterTypeException;
  use Pion\Actions\Resolver\Exceptions\InvalidActionClassException;
  use Pion\Actions\Resolver\Exceptions\InvalidArgumentTypeException;
  use Pion\Actions\Resolver\Exceptions\UnresolvedArgumentException;
  use Pion\Application\Exceptions\UndefinedRouteException;
  use Pion\Http\Request\RequestInterface;
  use Pion\Http\Response\ResponseInterface;
  use Pion\Routing\RoutingInterface;

  class Application implements ApplicationInterface
  {
    private RoutingInterface $routing;

    private ActionResolver $actionResolver;

    public function __construct(RoutingInterface $routing, ActionResolver $actionResolver)
    {
      $this->routing = $routing;
      $this->actionResolver = $actionResolver;
    }

    /**
     * @return ResponseInterface
     * @throws \ReflectionException
     * @throws UnknownParameterTypeException
     * @throws InvalidActionClassException
     * @throws InvalidArgumentTypeException
     * @throws UnresolvedArgumentException
     * @throws UndefinedRouteException
     */
    public function dispatch(RequestInterface $request): ResponseInterface
    {
      $route = $this->routing->get($request);
      if ($route === null) {
        throw new UndefinedRouteException($request);
      }
      return $this->actionResolver->resolve($route->actionClass())->render();
    }
  }