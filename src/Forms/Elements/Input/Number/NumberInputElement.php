<?php
  declare(strict_types=1);

  namespace Pion\Forms\Elements\Input\Number;

  use Pion\Forms\Elements\FormElementInterface;
  use Pion\Forms\Elements\Validation\Collection\ElementValidationResultsCollection;
  use Pion\Forms\Elements\Validation\Collection\ElementValidationResultsCollectionInterface;
  use Pion\Forms\Elements\Validation\Display\ErrorsWidget;
  use Pion\Forms\Elements\Validation\ElementValidationResult;
  use Pion\Http\Request\Parameters\ParametersInterface;
  use Pion\Spl\Types\Float\FloatInterface;
  use Pion\Spl\Types\Float\Validation\FloatValidatorInterface;
  use Pion\Templating\Engine\EngineInterface;
  use Pion\Validation\Result\ValidationResult;

  class NumberInputElement implements FormElementInterface, FloatInterface
  {
    /**
     * @var string
     */
    private $name;

    /**
     * @var FloatValidatorInterface
     */
    private $validator;

    /**
     * @var ValidationResult
     */
    private $validationResult;

    /**
     * @var float
     */
    private $value = 0.0;

    public function __construct(string $name, FloatValidatorInterface $validator)
    {
      $this->name = $name;
      $this->validator = $validator;
      $this->validationResult = new ValidationResult();
    }

    public function name(): string
    {
      return $this->name;
    }

    public function handle(ParametersInterface $parameters): ElementValidationResultsCollectionInterface
    {
      $this->setValue($parameters->has($this->name()) ? $parameters->require($this->name()) : 0.0);
      $this->validationResult = $this->validator->validate($this);
      return new ElementValidationResultsCollection(
        new ElementValidationResult($this, $this->validationResult)
      );
    }

    public function render(EngineInterface $engine): string
    {
      return $engine->render(
        __DIR__ . '/NumberInputElementView.html',
        [
          'errors' => (new ErrorsWidget($this->validationResult))->render($engine),
          'name'   => $this->name(),
          'value'  => $this->value(),
        ]
      );
    }

    public function value(): float
    {
      return $this->value;
    }

    public function setValue(float $value): void
    {
      $this->value = $value;
    }
  }