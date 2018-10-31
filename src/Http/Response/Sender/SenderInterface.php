<?
  declare(strict_types=1);

  namespace Pion\Http\Response\Sender;

  use Pion\Http\Response\ResponseInterface;

  interface SenderInterface
  {
    public function send(ResponseInterface $response): void;
  }