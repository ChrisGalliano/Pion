<?
  declare(strict_types=1);

  namespace Pion\Templating\Assets\Manager;

  use Pion\Templating\Assets\Resource\ResourceInterface;

  interface AssetsManagerInterface
  {
    public function add(ResourceInterface $resource, string $section): AssetsManagerInterface;

    public function render(string $section = null): void;
  }