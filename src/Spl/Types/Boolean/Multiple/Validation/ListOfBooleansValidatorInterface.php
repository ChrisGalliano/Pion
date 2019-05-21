<?
  declare(strict_types=1);

  namespace Pion\Spl\Types\Boolean\Multiple\Validation;

  use Pion\Spl\Types\Boolean\Multiple\ListOfBooleansInterface;
  use Pion\Validation\Result\ValidationResultInterface;

  interface ListOfBooleansValidatorInterface
  {
    public function validate(ListOfBooleansInterface $booleans): ValidationResultInterface;
  }