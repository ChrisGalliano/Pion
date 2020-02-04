<?
  declare(strict_types=1);

  namespace Pion\Http\Response\Redirect\Headers;

  use Pion\Http\Response\Headers\HeaderInterface;
  use Psr\Http\Message\UriInterface;

  class LocationHeader implements HeaderInterface
  {
    /**
     * @var UriInterface
     */
    private $uri;

    public function __construct(UriInterface $uri) {
      $this->uri = $uri;
    }

    public function name(): string
    {
      return 'Location';
    }

    public function value(): string
    {
      return $this->uri->__toString();
    }
  }