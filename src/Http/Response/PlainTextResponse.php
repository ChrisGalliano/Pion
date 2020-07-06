<?
  declare(strict_types=1);

  namespace Pion\Http\Response;

  use Pion\Http\Response\Headers\HeadersCollection;
  use Pion\Http\Response\Headers\HeadersCollectionInterface;
  use Pion\Http\Response\Status\StatusInterface;
  use Pion\Http\Response\Status\StatusOK;
  use Pion\Http\Response\Stream\Stream;
  use Pion\Http\Response\Stream\StreamInterface;

  final class PlainTextResponse implements ResponseInterface
  {
    private string $content;

    private HeadersCollectionInterface $headers;

    public function __construct(string $content, HeadersCollectionInterface $headers = null)
    {
      $this->content = $content;
      $this->headers = $headers ?? new HeadersCollection();
    }

    public function status(): StatusInterface
    {
      return new StatusOK();
    }

    public function headers(): HeadersCollectionInterface
    {
      return $this->headers;
    }

    public function stream(): StreamInterface
    {
      return new Stream($this->content);
    }
  }