<?
  declare(strict_types=1);

  namespace Pion\Http\Response\Headers;

  final class Headers implements HeadersInterface
  {
    /**
     * @var \Pion\Http\Response\Headers\HeaderInterface[]
     */
    private $headers;

    public function __construct(HeaderInterface... $headers)
    {
      $this->headers = $headers;
    }

    /**
     * @return \Pion\Http\Response\Headers\HeaderInterface[]
     */
    public function all(): array
    {
      return $this->headers;
    }
  }