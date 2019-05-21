<?
  declare(strict_types=1);

  namespace Pion\Forms\Elements\Input\Hidden;

  use Pion\Forms\Elements\FormElementInterface;
  use Pion\Forms\Elements\Validation\Collection\ElementValidationResultsCollection;
  use Pion\Forms\Elements\Validation\Collection\ElementValidationResultsCollectionInterface;
  use Pion\Forms\Elements\Validation\ElementValidationResult;
  use Pion\Http\Request\Parameters\ParametersInterface;
  use Pion\Spl\Types\String\StringInterface;
  use Pion\Spl\Types\String\Validation\StringValidatorInterface;
  use Pion\Templating\Engine\EngineInterface;
  use Pion\Validation\Result\ValidationResult;
  use Pion\Validation\Result\ValidationResultInterface;

  class HiddenInputElement implements FormElementInterface, StringInterface
  {
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $value = '';

    /**
     * @var StringValidatorInterface
     */
    private $validator;

    /**
     * @var ValidationResultInterface
     */
    private $validationResult;

    public function __construct(string $name, StringValidatorInterface $validator)
    {
      $this->name = $name;
      $this->validator = $validator;
      $this->validationResult = new ValidationResult();
    }

    public function string(): string
    {
      return $this->value;
    }

    public function name(): string
    {
      return $this->name;
    }

    public function handle(ParametersInterface $parameters): ElementValidationResultsCollectionInterface
    {
      $this->setValue($parameters->has($this->name()) ? $parameters->require($this->name()) : '');
      $this->validationResult = $this->validator->validate($this);
      return new ElementValidationResultsCollection(
        new ElementValidationResult($this, $this->validationResult)
      );
    }

    public function render(EngineInterface $engine): string
    {
      return $engine->render(
        __DIR__ . '/HiddenInputElementView.html',
        [
          'name' => $this->name(),
          'value' => $this->string(),
        ]
      );
    }

    public function setValue(string $value): self
    {
      $this->value = $value;
      return $this;
    }
  }