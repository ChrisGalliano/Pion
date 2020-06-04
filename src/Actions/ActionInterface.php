<?
  declare(strict_types=1);

  namespace Pion\Actions;

  use Pion\Http\Response\ResponseInterface;
  use Pion\Routing\Route\RouteInterface;

  interface ActionInterface
  {
    public static function route(): RouteInterface;

    public function render(): ResponseInterface;
  }