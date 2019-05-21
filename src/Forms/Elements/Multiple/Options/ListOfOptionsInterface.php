<?
  declare(strict_types=1);

  namespace Pion\Forms\Elements\Multiple\Options;

  interface ListOfOptionsInterface
  {
    /**
     * @return OptionInterface[]|\Generator
     */
    public function all(): \Generator;
  }