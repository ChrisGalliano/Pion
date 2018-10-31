<?
  declare(strict_types=1);

  namespace Pion\Application;

  use Pion\Http\Request\RequestInterface;
  use Pion\Http\Response\ResponseInterface;

  interface ApplicationInterface
  {
    public function dispatch(RequestInterface $request): ResponseInterface;
  }