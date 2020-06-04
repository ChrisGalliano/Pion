<?
  declare(strict_types=1);

  namespace Pion\Http\Response\Headers;

  final class HeadersCollection implements HeadersCollectionInterface
  {
    /**
     * @var HeaderInterface[]
     */
    private array $headers;

    public function __construct(HeaderInterface...$headers)
    {
      $this->headers = $headers;
    }

    /**
     * @return HeaderInterface[]
     */
    public function all(): array
    {
      return $this->headers;
    }

    public function add(HeaderInterface $header): HeadersCollectionInterface
    {
      $this->headers[] = $header;
      return $this;
    }
  }