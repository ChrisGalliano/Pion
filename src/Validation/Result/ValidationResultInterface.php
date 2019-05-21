<?
  declare(strict_types=1);

  namespace Pion\Validation\Result;

  interface ValidationResultInterface
  {
    public function isValid(): bool;

    /**
     * @return string[]
     */
    public function errors(): array;
  }