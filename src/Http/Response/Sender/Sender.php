<?
  declare(strict_types=1);
  
  namespace Pion\Http\Response\Sender;
  
  use Pion\Http\Response\ResponseInterface;

  final class Sender implements SenderInterface
  {
    /**
     * @throws \Pion\Http\Response\Sender\ResponseAlreadySentException
     */
    public function send(ResponseInterface $response): void
    {
      if (headers_sent()) {
        throw new ResponseAlreadySentException();
      }
      foreach ($response->headers()->all() as $header) {
        header(
            $header->name() . ': ' . $header->value(),
            false,
            $response->status()->code()
        );
      }
      header(
          sprintf(
              'HTTP/%s %s %s',
              '1.1',
              $response->status()->code(),
              $response->status()->text()
          ),
          true,
          $response->status()->code()
      );
  
      echo $response->stream()->body();
    }
  }