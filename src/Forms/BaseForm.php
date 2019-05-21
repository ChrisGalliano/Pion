<?
  declare(strict_types=1);

  namespace Pion\Forms;

  use Pion\Forms\Elements\FormElementInterface;
  use Pion\Forms\Elements\Validation\Collection\ElementValidationResultsCollection;
  use Pion\Forms\Handle\HandlingResult;
  use Pion\Forms\Handle\HandlingResultInterface;
  use Pion\Http\Request\Parameters\ParametersInterface;

  abstract class BaseForm implements FormInterface
  {
    /**
     * @var FormElementInterface[]
     */
    private $elements;

    public function __construct(FormElementInterface...$elements)
    {
      $this->elements = $elements;
    }

    public function handle(ParametersInterface $parameters): HandlingResultInterface
    {
      $isSubmitted = $parameters->has($this->name());
      $validationResult = new ElementValidationResultsCollection();
      if ($isSubmitted) {
        foreach ($this->elements as $element) {
          $validationResult = $validationResult->merge($element->handle($parameters));
        }
      }

      return new HandlingResult($isSubmitted, $validationResult);
    }
  }