<?
  declare(strict_types=1);

  namespace Pion\Forms\Elements\Validation;

  use Pion\Forms\Elements\FormElementInterface;
  use Pion\Validation\Result\ValidationResultInterface;

  interface ElementValidationResultInterface
  {
    public function element(): FormElementInterface;

    public function result(): ValidationResultInterface;
  }