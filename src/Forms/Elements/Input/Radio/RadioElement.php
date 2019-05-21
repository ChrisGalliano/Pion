<?
  declare(strict_types=1);

  namespace Pion\Forms\Elements\Input\Radio;

  use Pion\Forms\Elements\FormElementInterface;
  use Pion\Forms\Elements\Multiple\Options\OptionInterface;
  use Pion\Forms\Elements\Validation\Collection\ElementValidationResultsCollection;
  use Pion\Forms\Elements\Validation\Collection\ElementValidationResultsCollectionInterface;
  use Pion\Http\Request\Parameters\ParametersInterface;
  use Pion\Spl\Types\Boolean\BooleanInterface;
  use Pion\Templating\Engine\EngineInterface;

  class RadioElement implements FormElementInterface, BooleanInterface
  {
    /**
     * @var bool
     */
    private $isChecked = false;

    /**
     * @var string
     */
    private $name;

    /**
     * @var OptionInterface
     */
    private $option;

    public function __construct(string $name, OptionInterface $option)
    {
      $this->name = $name;
      $this->option = $option;
    }

    public function name(): string
    {
      return $this->name;
    }

    public function handle(ParametersInterface $parameters): ElementValidationResultsCollectionInterface
    {
      $this->isChecked = $parameters->has($this->name()) && $parameters->require($this->name()) === $this->value();
      return new ElementValidationResultsCollection();
    }

    public function render(EngineInterface $engine): string
    {
      return $engine->render(
        __DIR__ . '/RadioElementView.html',
        [
          'name'    => $this->name(),
          'checked' => $this->bool(),
          'option'   => $this->option,
        ]
      );
    }

    public function bool(): bool
    {
      return $this->isChecked;
    }

    public function value(): string
    {
      return $this->option->value();
    }
  }