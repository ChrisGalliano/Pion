<?

  declare(strict_types=1);

  namespace Pion\Templating\Assets\Resource\Path;

  interface ResourcePathInterface
  {
    public function get() : string;
  }