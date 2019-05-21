<?
  declare(strict_types=1);

  namespace Pion\Forms\Handle;

  use Pion\Forms\Elements\Validation\Collection\ElementValidationResultsCollectionInterface;

  class HandlingResult implements HandlingResultInterface
  {
    /**
     * @var bool
     */
    private $isSubmitted;

    /**
     * @var ElementValidationResultsCollectionInterface
     */
    private $result;

    public function __construct(bool $isSubmitted, ElementValidationResultsCollectionInterface $result)
    {
      $this->isSubmitted = $isSubmitted;
      $this->result = $result;
    }

    public function isSubmitted(): bool
    {
      return $this->isSubmitted;
    }

    public function results(): ElementValidationResultsCollectionInterface
    {
      return $this->result;
    }
  }