<?php
  declare(strict_types=1);

  namespace Pion\Templating\Renderable;

  use Pion\Templating\Engine\EngineInterface;

  class PredefinedRenderable implements RenderableInterface
  {
    private string $path;

    private array $data;

    /**
     * @param string  $path
     * @param mixed[] $data
     */
    public function __construct(string $path, array $data)
    {
      $this->path = $path;
      $this->data = $data;
    }

    public function render(EngineInterface $engine): string
    {
      return $engine->render($this->path, $this->data);
    }
  }