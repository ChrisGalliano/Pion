<?
  declare(strict_types=1);

  namespace Pion\Forms\Handle;

  use Pion\Forms\Elements\Validation\Collection\ElementValidationResultsCollectionInterface;

  interface HandlingResultInterface
  {
    public function isSubmitted(): bool;

    public function results(): ElementValidationResultsCollectionInterface;
  }