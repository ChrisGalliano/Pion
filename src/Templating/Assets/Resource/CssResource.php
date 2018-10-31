<?
  declare(strict_types=1);

  namespace Pion\Templating\Assets\Resource;

  use Pion\Templating\Assets\Resource\Path\ResourcePathInterface;

  final class CssResource implements ResourceInterface
  {
    /**
     * @var ResourcePathInterface
     */
    private $path;

    public function __construct(ResourcePathInterface $path)
    {
      $this->path = $path;
    }

    public function render(): string
    {
      return '<link rel="stylesheet" href="' . $this->path->get() . '">';
    }
  }