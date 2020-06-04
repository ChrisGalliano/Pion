<?
  declare(strict_types=1);

  namespace Pion\Application;

  use Pion\Actions\ActionInterface;
  use Pion\Actions\Resolver\ActionArgumentsResolver;
  use Pion\Actions\Resolver\Argument\Metadata\Exceptions\UnknownParameterTypeException;
  use Pion\Actions\Resolver\Exceptions\InvalidActionClassException;
  use Pion\Actions\Resolver\Exceptions\InvalidArgumentTypeException;
  use Pion\Actions\Resolver\Exceptions\UnresolvedArgumentException;
  use Pion\Application\Exceptions\InvalidActionResponseException;
  use Pion\Application\Exceptions\UndefinedRouteException;
  use Pion\Http\Request\RequestInterface;
  use Pion\Http\Response\ResponseInterface;
  use Pion\Routing\RoutingInterface;

  class Application implements ApplicationInterface
  {
    private RoutingInterface $routing;

    private ActionArgumentsResolver $actionResolver;

    public function __construct(RoutingInterface $routing, ActionArgumentsResolver $actionResolver)
    {
      $this->routing = $routing;
      $this->actionResolver = $actionResolver;
    }

    /**
     *
     * @return ResponseInterface
     * @throws \ReflectionException
     * @throws UnknownParameterTypeException
     * @throws InvalidActionClassException
     * @throws InvalidArgumentTypeException
     * @throws UnresolvedArgumentException
     * @throws UndefinedRouteException
     * @throws InvalidActionResponseException
     */
    public function dispatch(RequestInterface $request): ResponseInterface
    {
      $route = $this->routing->get($request);
      if ($route === null) {
        throw new UndefinedRouteException($request);
      }
      $actionClass = $route->actionClass();
      if (
        !class_exists($actionClass)
        || !is_subclass_of($actionClass, ActionInterface::class)
      ) {
        throw new InvalidActionClassException($actionClass);
      }
      $action = new $actionClass();
      if (!\is_callable($action)) {
        throw new InvalidActionClassException($actionClass);
      }
      $arguments = $this->actionResolver->resolve($actionClass);
      $result = $action(...$arguments);
      if (!($result instanceof ResponseInterface)) {
        throw new InvalidActionResponseException($actionClass);
      }
      return $result;
    }
  }