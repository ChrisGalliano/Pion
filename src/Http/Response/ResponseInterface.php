<?
  declare(strict_types=1);

  namespace Pion\Http\Response;

  use Pion\Http\Response\Headers\HeadersCollectionInterface;
  use Pion\Http\Response\Status\StatusInterface;
  use Pion\Http\Response\Stream\StreamInterface;

  interface ResponseInterface
  {
    public function status(): StatusInterface;

    public function headers(): HeadersCollectionInterface;

    public function stream(): StreamInterface;
  }