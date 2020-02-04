<?
  declare(strict_types=1);

  namespace Pion\Forms\Elements\Input\Checkbox;

  use Pion\Forms\Elements\FormElementInterface;
  use Pion\Forms\Elements\Multiple\Options\OptionInterface;
  use Pion\Forms\Elements\Validation\Collection\ElementValidationResultsCollection;
  use Pion\Forms\Elements\Validation\Collection\ElementValidationResultsCollectionInterface;
  use Pion\Forms\Elements\Validation\Display\ErrorsWidget;
  use Pion\Forms\Elements\Validation\ElementValidationResult;
  use Pion\Http\Request\Parameters\ParametersInterface;
  use Pion\Spl\Types\Boolean\BooleanInterface;
  use Pion\Spl\Types\Boolean\Validation\BooleanValidatorInterface;
  use Pion\Templating\Engine\EngineInterface;
  use Pion\Validation\Result\ValidationResult;
  use Pion\Validation\Result\ValidationResultInterface;

  class CheckboxElement implements FormElementInterface, BooleanInterface
  {
    /**
     * @var string
     */
    private $name;

    /**
     * @var OptionInterface
     */
    private $option;

    /**
     * @var bool
     */
    private $checked = false;

    /**
     * @var BooleanValidatorInterface
     */
    private $validator;

    /**
     * @var ValidationResultInterface
     */
    private $validationResult;

    public function __construct(string $name, OptionInterface $option, BooleanValidatorInterface $validator)
    {
      $this->name = $name;
      $this->option = $option;
      $this->validator = $validator;
      $this->validationResult = new ValidationResult();
    }

    public function name(): string
    {
      return $this->name;
    }

    public function handle(ParametersInterface $parameters): ElementValidationResultsCollectionInterface
    {
      $this->checked = $parameters->has($this->name());
      $this->validationResult = $this->validator->validate($this);
      return new ElementValidationResultsCollection(
        new ElementValidationResult($this, $this->validationResult)
      );
    }

    public function render(EngineInterface $engine): string
    {
      return $engine->render(
        __DIR__ . '/CheckboxElementView.html',
        [
          'errors'  => (new ErrorsWidget($this->validationResult))->render($engine),
          'name'    => $this->name(),
          'checked' => $this->bool(),
          'label'   => $this->option->label(),
        ]
      );
    }

    public function bool(): bool
    {
      return $this->checked;
    }

    public function option(): OptionInterface
    {
      return $this->option;
    }

    public function setChecked(bool $checked): void
    {
      $this->checked = $checked;
    }
  }