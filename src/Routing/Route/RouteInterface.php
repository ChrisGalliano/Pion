<?
  declare(strict_types=1);

  namespace Pion\Routing\Route;

  use Pion\Actions\ActionInterface;
  use Pion\Http\Request\RequestInterface;

  interface RouteInterface
  {
    public function path(): string;

    public function isSupported(RequestInterface $request): bool;

    public function action(): ActionInterface;
  }