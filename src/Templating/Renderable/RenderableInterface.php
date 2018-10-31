<?
  declare(strict_types=1);

  namespace Pion\Templating\Renderable;

  use Pion\Templating\Engine\EngineInterface;

  interface RenderableInterface
  {
    public function render(EngineInterface $engine): string;
  }