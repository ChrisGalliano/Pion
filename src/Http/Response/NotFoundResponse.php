<?
  declare(strict_types=1);

  namespace Pion\Http\Response;

  use Pion\Http\Response\Headers\Headers;
  use Pion\Http\Response\Headers\HeadersInterface;
  use Pion\Http\Response\Status\StatusInterface;
  use Pion\Http\Response\Status\StatusOK;
  use Pion\Http\Response\Stream\Stream;
  use Pion\Http\Response\Stream\StreamInterface;

  final class NotFoundResponse implements ResponseInterface
  {
    public function status(): StatusInterface
    {
      return new StatusOK();
    }

    public function headers(): HeadersInterface
    {
      return new Headers();
    }

    public function stream(): StreamInterface
    {
      return new Stream('404 page not found');
    }
  }