<?
  declare(strict_types=1);

  namespace Pion\Templating\Engine;

  use Pion\Templating\Assets\Manager\AssetsManagerInterface;

  interface EngineInterface
  {
    public function render(string $path, array $data): string;

    public function assetsManager(): AssetsManagerInterface;
  }