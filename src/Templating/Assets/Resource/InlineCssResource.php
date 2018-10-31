<?
  declare(strict_types=1);

  namespace Pion\Templating\Assets\Resource;

  use Pion\Templating\Assets\Resource\Path\ResourcePathInterface;

  final class InlineCssResource implements ResourceInterface
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
      return '<style>' . file_get_contents($this->path->get()) . '</style>';
    }
  }