<?
  declare(strict_types=1);

  namespace Pion\Spl\Types\Boolean\Multiple\Validation;

  use Pion\Spl\Types\Boolean\Multiple\ListOfBooleansInterface;
  use Pion\Validation\Result\ValidationResult;
  use Pion\Validation\Result\ValidationResultInterface;

  class DummyListOfBooleansValidator implements ListOfBooleansValidatorInterface
  {
    public function validate(ListOfBooleansInterface $booleans): ValidationResultInterface
    {
      return new ValidationResult();
    }
  }