<?
  declare(strict_types=1);

  namespace Pion\Routing\Route;

  use Pion\Actions\ActionInterface;
  use Pion\Http\Request\RequestInterface;

  class RegexRoute implements RouteInterface
  {
    /**
     * @var string
     */
    private string $path;

    /**
     * @var ActionInterface
     */
    private ActionInterface $action;

    /**
     * @var string
     */
    private string $pattern;

    public function __construct(string $path, ActionInterface $action, string $pattern)
    {
      $this->path = $path;
      $this->pattern = $pattern;
      $this->action = $action;
    }

    public function path(): string
    {
      return $this->path;
    }

    public function isSupported(RequestInterface $request): bool
    {
      return (bool)preg_match($this->pattern, $request->uri()->getPath());
    }

    public function action(): ActionInterface
    {
      return $this->action;
    }
  }