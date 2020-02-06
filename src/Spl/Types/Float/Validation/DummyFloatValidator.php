<?php
  declare(strict_types=1);

  namespace Pion\Spl\Types\Float\Validation;

  use Pion\Spl\Types\Float\FloatInterface;
  use Pion\Validation\Result\ValidationResult;
  use Pion\Validation\Result\ValidationResultInterface;

  class DummyFloatValidator implements FloatValidatorInterface
  {
    public function validate(FloatInterface $float): ValidationResultInterface
    {
      return new ValidationResult();
    }
  }