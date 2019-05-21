<?
  declare(strict_types=1);

  namespace Pion\Forms\Elements\Validation\Collection;

  use Pion\Forms\Elements\Validation\ElementValidationResultInterface;

  interface ElementValidationResultsCollectionInterface
  {
    public function merge(ElementValidationResultsCollectionInterface $collection): self;

    public function isValid(): bool;

    public function get(string $name): ElementValidationResultInterface;

    /**
     * @return ElementValidationResultInterface[]
     */
    public function all(): array ;
  }