<?
  declare(strict_types=1);

  namespace Pion\Application;

  use Pion\Actions\Resolver\ActionResolver;
  use Pion\Application\Exceptions\UndefinedRouteException;
  use Pion\Http\Request\RequestInterface;
  use Pion\Http\Response\ResponseInterface;
  use Pion\Routing\RoutingInterface;
  use Pion\Templating\Engine\Engine;

  class Application implements ApplicationInterface
  {
    /**
     * @var \Pion\Routing\RoutingInterface
     */
    private $routing;

    /**
     * @var \Pion\Actions\Resolver\ActionResolver
     */
    private $actionResolver;

    /**
     * @var \Pion\Templating\Engine\Engine
     */
    private $engine;

    public function __construct(RoutingInterface $routing, ActionResolver $actionResolver, Engine $engine)
    {
      $this->routing = $routing;
      $this->actionResolver = $actionResolver;
      $this->engine = $engine;
    }

    /**
     * @return \Pion\Http\Response\ResponseInterface
     * @throws \ReflectionException
     * @throws \Pion\Actions\Resolver\Argument\Metadata\Exceptions\UnknownParameterTypeException
     * @throws \Pion\Actions\Resolver\Exceptions\InvalidActionClassException
     * @throws \Pion\Actions\Resolver\Exceptions\InvalidArgumentTypeException
     * @throws \Pion\Actions\Resolver\Exceptions\UnresolvedArgumentException
     * @throws \Pion\Application\Exceptions\UndefinedRouteException
     */
    public function dispatch(RequestInterface $request): ResponseInterface
    {
      $route = $this->routing->get($request);
      if ($route === null) {
        throw new UndefinedRouteException($request);
      }
      return $this->actionResolver->resolve($route->actionClass())->render($this->engine);
    }
  }