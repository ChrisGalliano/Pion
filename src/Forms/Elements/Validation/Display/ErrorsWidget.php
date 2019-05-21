<?
  declare(strict_types=1);

  namespace Pion\Forms\Elements\Validation\Display;

  use Pion\Templating\Engine\EngineInterface;
  use Pion\Templating\Renderable\RenderableInterface;
  use Pion\Validation\Result\ValidationResult;

  class ErrorsWidget implements RenderableInterface
  {
    /**
     * @var ValidationResult
     */
    private $validationResult;

    public function __construct(ValidationResult $validationResult)
    {
      $this->validationResult = $validationResult;
    }

    public function render(EngineInterface $engine): string
    {
      return $engine->render(
        __DIR__ . '/ErrorsWidgetView.html',
        [
          'validationResult' => $this->validationResult,
        ]
      );
    }
  }