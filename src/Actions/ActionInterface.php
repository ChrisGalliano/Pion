<?
  declare(strict_types=1);

  namespace Pion\Actions;

  use Pion\Http\Response\ResponseInterface;
  use Pion\Routing\Route\RouteInterface;
  use Pion\Templating\Engine\EngineInterface;
  use Psr\Http\Message\UriInterface;

  interface ActionInterface
  {
    public static function route(): RouteInterface;

    public function render(EngineInterface $engine): ResponseInterface;

    public function uri(): UriInterface;
  }