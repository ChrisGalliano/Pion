<?
  declare(strict_types=1);

  namespace Pion\Http\Response\Headers;

  interface HeadersInterface
  {
    /**
     * @return \Pion\Http\Response\Headers\HeaderInterface[]
     */
    public function all(): array;
  }