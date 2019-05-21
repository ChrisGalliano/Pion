<?
  declare(strict_types=1);

  namespace Pion\Spl\Types\String\Validation;

  use Pion\Spl\Types\String\StringInterface;
  use Pion\Validation\Result\ValidationResult;
  use Pion\Validation\Result\ValidationResultInterface;

  class DummyStringValidator implements StringValidatorInterface
  {
    public function validate(StringInterface $string): ValidationResultInterface
    {
      return new ValidationResult();
    }
  }