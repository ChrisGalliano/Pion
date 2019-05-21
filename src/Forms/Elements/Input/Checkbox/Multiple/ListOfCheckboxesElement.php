<?
  declare(strict_types=1);

  namespace Pion\Forms\Elements\Input\Checkbox\Multiple;

  use Pion\Forms\Elements\FormElementInterface;
  use Pion\Forms\Elements\Input\Checkbox\CheckboxElement;
  use Pion\Forms\Elements\Multiple\Options\ListOfOptionsInterface;
  use Pion\Forms\Elements\Validation\Collection\ElementValidationResultsCollection;
  use Pion\Forms\Elements\Validation\Collection\ElementValidationResultsCollectionInterface;
  use Pion\Forms\Elements\Validation\Display\ErrorsWidget;
  use Pion\Forms\Elements\Validation\ElementValidationResult;
  use Pion\Http\Request\Parameters\ParametersInterface;
  use Pion\Spl\Types\Boolean\BooleanInterface;
  use Pion\Spl\Types\Boolean\Multiple\ListOfBooleansInterface;
  use Pion\Spl\Types\Boolean\Multiple\Validation\ListOfBooleansValidatorInterface;
  use Pion\Spl\Types\Boolean\Validation\DummyBooleanValidator;
  use Pion\Templating\Engine\EngineInterface;
  use Pion\Validation\Result\ValidationResult;
  use Pion\Validation\Result\ValidationResultInterface;

  class ListOfCheckboxesElement implements FormElementInterface, ListOfBooleansInterface
  {
    /**
     * @var string
     */
    private $name;

    /**
     * @var CheckboxElement[]
     */
    private $checkboxes = [];

    /**
     * @var ListOfBooleansValidatorInterface
     */
    private $validator;

    /**
     * @var ValidationResultInterface
     */
    private $validationResult;

    public function __construct(
      string $name, ListOfOptionsInterface $options, ListOfBooleansValidatorInterface $validator
    ) {
      $this->name = $name;
      foreach ($options->all() as $option) {
        $this->checkboxes[] = new CheckboxElement($option, new DummyBooleanValidator());
      }
      $this->validator = $validator;
      $this->validationResult = new ValidationResult();
    }

    public function name(): string
    {
      return $this->name;
    }

    public function handle(ParametersInterface $parameters): ElementValidationResultsCollectionInterface
    {
      foreach ($this->checkboxes() as $checkbox) {
        $checkbox->handle($parameters);
      }
      $this->validationResult = $this->validator->validate($this);
      return new ElementValidationResultsCollection(
        new ElementValidationResult($this, $this->validationResult)
      );
    }

    /**
     * @return CheckboxElement[]
     */
    public function checkboxes(): array
    {
      return $this->checkboxes;
    }

    public function render(EngineInterface $engine): string
    {
      return $engine->render(
        __DIR__ . '/ListOfCheckboxesView.html',
        [
          'errors'     => (new ErrorsWidget($this->validationResult))->render($engine),
          'engine'     => $engine,
          'checkboxes' => $this->checkboxes(),
        ]
      );
    }

    /**
     * @return BooleanInterface[]|\Generator
     */
    public function booleans(): \Generator
    {
      yield from $this->checkboxes();
    }
  }