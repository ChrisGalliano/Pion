<?
  declare(strict_types=1);

  namespace Pion\Spl\Types\Boolean\Multiple;

  use Pion\Spl\Types\Boolean\BooleanInterface;

  interface ListOfBooleansInterface
  {
    /**
     * @return BooleanInterface[]|\Generator
     */
    public function booleans(): \Generator;
  }