<?
  declare(strict_types=1);

  namespace Pion\Forms\Elements\Input\Submit;

  use Pion\Forms\Elements\FormElementInterface;
  use Pion\Forms\Elements\Validation\Collection\ElementValidationResultsCollection;
  use Pion\Forms\Elements\Validation\Collection\ElementValidationResultsCollectionInterface;
  use Pion\Http\Request\Parameters\ParametersInterface;
  use Pion\Templating\Engine\EngineInterface;

  class SubmitElement implements FormElementInterface
  {
    /**
     * @var string
     */
    private $text;

    /**
     * @var string
     */
    private $name;

    public function __construct(string $text, string $name = null)
    {
      $this->text = $text;
      $this->name = $name ?? 'submit';
    }

    public function name(): string
    {
      return $this->name;
    }

    public function handle(ParametersInterface $parameters): ElementValidationResultsCollectionInterface
    {
      return new ElementValidationResultsCollection();
    }

    public function render(EngineInterface $engine): string
    {
      return $engine->render(
        __DIR__ . '/SubmitElementView.html',
        [
          'name' => $this->name(),
          'text' => $this->text,
        ]
      );
    }
  }