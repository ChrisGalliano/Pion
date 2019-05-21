<?
  declare(strict_types=1);

  namespace Pion\Forms\Elements\Validation;

  use Pion\Forms\Elements\FormElementInterface;
  use Pion\Validation\Result\ValidationResultInterface;

  class ElementValidationResult implements ElementValidationResultInterface
  {
    /**
     * @var FormElementInterface
     */
    private $element;

    /**
     * @var ValidationResultInterface
     */
    private $result;

    public function __construct(FormElementInterface $element, ValidationResultInterface $result)
    {
      $this->element = $element;
      $this->result = $result;
    }

    public function element(): FormElementInterface
    {
      return $this->element;
    }

    public function result(): ValidationResultInterface
    {
      return $this->result;
    }
  }