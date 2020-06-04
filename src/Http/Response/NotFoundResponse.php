<?
  declare(strict_types=1);

  namespace Pion\Http\Response;

  use Pion\Http\Response\Headers\HeadersCollection;
  use Pion\Http\Response\Headers\HeadersCollectionInterface;
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

    public function headers(): HeadersCollectionInterface
    {
      return new HeadersCollection();
    }

    public function stream(): StreamInterface
    {
      return new Stream('404 page not found');
    }
  }