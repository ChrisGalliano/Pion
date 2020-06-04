<?php
  declare(strict_types=1);

  namespace Pion\Http\Response\Json;

  use Pion\Http\Response\Headers\HeadersCollection;
  use Pion\Http\Response\Headers\HeadersCollectionInterface;
  use Pion\Http\Response\Json\Headers\ContentTypeJsonHeader;
  use Pion\Http\Response\Status\StatusInterface;
  use Pion\Http\Response\Status\StatusOK;
  use Pion\Http\Response\Stream\Stream;
  use Pion\Http\Response\Stream\StreamInterface;

  class JsonResponse
  {

    /**
     * @var mixed[]
     */
    private $data;


    /**
     * @param mixed[] $data
     */
    public function __construct(array $data)
    {
      $this->data = $data;
    }


    public function status() : StatusInterface
    {
      return new StatusOK();
    }


    public function headers() : HeadersCollectionInterface
    {
      return new HeadersCollection(new ContentTypeJsonHeader());
    }


    public function stream() : StreamInterface
    {
      return new Stream(\json_encode($this->data));
    }
  }