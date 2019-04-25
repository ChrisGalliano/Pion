<?
  declare(strict_types=1);

  namespace Pion\Routing\Route;

  use Pion\Http\Request\RequestInterface;

  class RegexRoute implements RouteInterface
  {
    /**
     * @var string
     */
    private $path;

    /**
     * @var string
     */
    private $actionClass;

    /**
     * @var string
     */
    private $pattern;

    public function __construct(string $path, string $actionClass, string $pattern)
    {
      $this->path = $path;
      $this->actionClass = $actionClass;
      $this->pattern = $pattern;
    }

    public function path(): string
    {
      return $this->path;
    }

    public function isSupported(RequestInterface $request): bool
    {
      return (bool)preg_match($this->pattern, $request->uri()->getPath());
    }

    public function actionClass(): string
    {
      return $this->actionClass;
    }
  }