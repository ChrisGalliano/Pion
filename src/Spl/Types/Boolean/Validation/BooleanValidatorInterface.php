<?
  declare(strict_types=1);

  namespace Pion\Spl\Types\Boolean\Validation;

  use Pion\Spl\Types\Boolean\BooleanInterface;
  use Pion\Validation\Result\ValidationResultInterface;

  interface BooleanValidatorInterface
  {
    public function validate(BooleanInterface $boolean): ValidationResultInterface;
  }