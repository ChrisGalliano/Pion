<?
  declare(strict_types=1);

  namespace Pion\Actions;

  use Pion\Routing\Route\RouteInterface;

  /**
   * Action have to implement __invoke() method and return response ->
   * @see \Pion\Http\Response\ResponseInterface
   */
  interface ActionInterface
  {
    public static function route(): RouteInterface;
  }