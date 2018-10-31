<?
  declare(strict_types=1);

  namespace Pion\Http\Response\Headers;

  interface HeaderInterface
  {
    public function name(): string;

    public function value(): string;
  }