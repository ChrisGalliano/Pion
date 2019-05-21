<?
  declare(strict_types=1);

  namespace Pion\Forms\Elements\Multiple\Options;

  interface OptionInterface
  {
    public function value(): string;

    public function label(): string;
  }