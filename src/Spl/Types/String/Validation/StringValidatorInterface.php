<?
  declare(strict_types=1);

  namespace Pion\Spl\Types\String\Validation;

  use Pion\Spl\Types\String\StringInterface;
  use Pion\Validation\Result\ValidationResultInterface;

  interface StringValidatorInterface
  {
    public function validate(StringInterface $string): ValidationResultInterface;
  }