<?
  declare(strict_types=1);

  namespace Pion\Spl\Types\Boolean\Validation;

  use Pion\Spl\Types\Boolean\BooleanInterface;
  use Pion\Validation\Result\ValidationResult;
  use Pion\Validation\Result\ValidationResultInterface;

  class DummyBooleanValidator implements BooleanValidatorInterface
  {
    public function validate(BooleanInterface $boolean): ValidationResultInterface
    {
      return new ValidationResult();
    }
  }