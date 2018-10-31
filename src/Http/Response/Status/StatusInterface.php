<?
  declare(strict_types=1);

  namespace Pion\Http\Response\Status;

  interface StatusInterface
  {
    public function code(): int;

    public function text(): string;
  }