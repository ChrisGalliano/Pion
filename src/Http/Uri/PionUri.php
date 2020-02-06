<?php
  declare(strict_types=1);

  namespace Pion\Http\Uri;

  use GuzzleHttp\Psr7\Uri;

  class PionUri extends Uri
  {
    public function withQueryKey(string $key, string $value): self
    {
      /** @noinspection PhpIncompatibleReturnTypeInspection */
      return static::withQueryValue($this, $key, $value);
    }
  }