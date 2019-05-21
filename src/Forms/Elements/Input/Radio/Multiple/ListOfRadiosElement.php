<?
  declare(strict_types=1);

  namespace Pion\Forms\Elements\Input\Radio\Multiple;

  use Pion\Forms\Elements\FormElementInterface;
  use Pion\Forms\Elements\Input\Radio\RadioElement;
  use Pion\Forms\Elements\Multiple\Options\ListOfOptionsInterface;
  use Pion\Forms\Elements\Validation\Collection\ElementValidationResultsCollection;
  use Pion\Forms\Elements\Validation\Collection\ElementValidationResultsCollectionInterface;
  use Pion\Forms\Elements\Validation\Display\ErrorsWidget;
  use Pion\Forms\Elements\Validation\ElementValidationResult;
  use Pion\Http\Request\Parameters\ParametersInterface;
  use Pion\Spl\Types\String\StringInterface;
  use Pion\Spl\Types\String\Validation\StringValidatorInterface;
  use Pion\Templating\Engine\EngineInterface;
  use Pion\Validation\Result\ValidationResult;
  use Pion\Validation\Result\ValidationResultInterface;

  class ListOfRadiosElement implements FormElementInterface, StringInterface
  {
    /**
     * @var string
     */
    private $name;

    /**
     * @var RadioElement[]
     */
    private $radios = [];

    /**
     * @var StringValidatorInterface
     */
    private $validator;

    /**
     * @var ValidationResultInterface
     */
    private $validationResult;

    public function __construct(string $name, ListOfOptionsInterface $options, StringValidatorInterface $validator)
    {
      $this->name = $name;
      $i = 0;
      foreach ($options->all() as $option) {
        $this->radios[] = new RadioElement($name . $i++, $option);
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
      foreach ($this->radios as $radio) {
        $radio->handle($parameters);
      }
      $this->validationResult = $this->validator->validate($this);
      return new ElementValidationResultsCollection(
        new ElementValidationResult($this, $this->validationResult)
      );
    }

    public function render(EngineInterface $engine): string
    {
      return $engine->render(
        __DIR__ . '/ListOfRadiosElementView.html',
        [
          'errors' => (new ErrorsWidget($this->validationResult))->render($engine),
          'radios' => $this->radios,
          'engine' => $engine,
        ]
      );
    }

    public function string(): string
    {
      $result = '';
      foreach ($this->radios as $radio) {
        if ($radio->bool()) {
          $result = $radio->value();
          break;
        }
      }
      return $result;
    }
  }