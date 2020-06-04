<?
  declare(strict_types=1);

  namespace Pion\Templating\Response;

  use Pion\Http\Response\Headers\HeadersCollection;
  use Pion\Http\Response\Headers\HeadersCollectionInterface;
  use Pion\Http\Response\ResponseInterface;
  use Pion\Http\Response\Status\StatusInterface;
  use Pion\Http\Response\Status\StatusOK;
  use Pion\Http\Response\Stream\Stream;
  use Pion\Http\Response\Stream\StreamInterface;
  use Pion\Templating\Engine\EngineInterface;
  use Pion\Templating\Renderable\RenderableInterface;

  final class TemplatedResponse implements ResponseInterface
  {
    /**
     * @var \Pion\Templating\Renderable\RenderableInterface
     */
    private $renderable;

    /**
     * @var \Pion\Templating\Engine\EngineInterface
     */
    private $engine;

    /**
     * @var HeadersCollectionInterface
     */
    private $headers;

    public function __construct(
      RenderableInterface $renderable, EngineInterface $engine, HeadersCollectionInterface $headers = null
    ) {
      $this->renderable = $renderable;
      $this->engine = $engine;
      $this->headers = $headers ?: new HeadersCollection();
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
      return new Stream($this->renderable->render($this->engine));
    }
  }