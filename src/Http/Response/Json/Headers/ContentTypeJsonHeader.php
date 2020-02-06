<?php
  declare(strict_types=1);

  namespace Pion\Http\Response\Json\Headers;

  use Pion\Http\Response\Headers\HeaderInterface;

  class ContentTypeJsonHeader implements HeaderInterface
  {
    public function name(): string
    {
      return 'Content-Type';
    }

    public function value(): string
    {
      return 'application/json';
    }
  }