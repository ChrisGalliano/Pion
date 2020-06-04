<?
  declare(strict_types=1);

  namespace Pion\Http\Response\Headers;

  interface HeadersCollectionInterface
  {
    /**
     * @return HeaderInterface[]
     */
    public function all(): array;

    public function add(HeaderInterface $header): self;
  }