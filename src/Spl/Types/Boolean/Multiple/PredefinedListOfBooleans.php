<?
  declare(strict_types=1);

  namespace Pion\Spl\Types\Boolean\Multiple;

  use Pion\Spl\Types\Boolean\BooleanInterface;

  class PredefinedListOfBooleans implements ListOfBooleansInterface
  {
    /**
     * @var BooleanInterface[]
     */
    private $booleans;

    public function __construct(BooleanInterface...$booleans)
    {
      $this->booleans = $booleans;
    }

    public function add(BooleanInterface $string): void
    {
      $this->booleans[] = $string;
    }

    /**
     * @return BooleanInterface[]|\Generator
     */
    public function booleans(): \Generator
    {
      yield from $this->booleans;
    }
  }