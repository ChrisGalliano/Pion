<?

  declare(strict_types=1);

  namespace Pion\Templating\Assets\Resource\Path;

  class PredefinedResourcePath implements ResourcePathInterface
  {
    /**
     * @var string
     */
    private $path;

    public function __construct(string $path) {
      $this->path = $path;
    }

    public function get() : string {
      return $this->path;
    }
  }