<?
  declare(strict_types=1);
  
  namespace Pion\Templating\Engine;
  
  use Pion\Templating\Assets\Manager\AssetsManagerInterface;

  final class Engine implements EngineInterface
  {
    /**
     * @var AssetsManagerInterface
     */
    private $assetsManager;
  
    public function __construct(AssetsManagerInterface $assetsManager) {
      $this->assetsManager = $assetsManager;
    }
  
    public function render(string $path, array $data): string
    {
      ob_start();
      extract($data, EXTR_OVERWRITE);
      /** @noinspection PhpIncludeInspection */
      require $path;
      return ob_get_clean();
    }
    
    public function assetsManager(): AssetsManagerInterface
    {
      return $this->assetsManager;
    }
  }