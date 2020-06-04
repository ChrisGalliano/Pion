<?
  declare(strict_types=1);

  namespace Pion\Http\Response\Redirect;

  use Pion\Http\Response\Headers\HeadersCollection;
  use Pion\Http\Response\Headers\HeadersCollectionInterface;
  use Pion\Http\Response\Redirect\Headers\LocationHeader;
  use Pion\Http\Response\ResponseInterface;
  use Pion\Http\Response\Status\PredefinedStatus;
  use Pion\Http\Response\Status\StatusInterface;
  use Pion\Http\Response\Stream\Stream;
  use Pion\Http\Response\Stream\StreamInterface;
  use Psr\Http\Message\UriInterface;

  class UriRedirectResponse implements ResponseInterface
  {
    /**
     * @var UriInterface
     */
    private $uri;

    /**
     * @var int
     */
    private $statusCode;

    public function __construct(UriInterface $uri, int $status = null) {
      $this->uri = $uri;
      $this->statusCode = $status ?? 302;
    }

    public function status(): StatusInterface
    {
      return new PredefinedStatus($this->statusCode, '');
    }

    public function headers(): HeadersCollectionInterface
    {
      return new HeadersCollection(new LocationHeader($this->uri));
    }

    public function stream(): StreamInterface
    {
      return new Stream('');
    }
  }