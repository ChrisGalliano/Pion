<?
  declare(strict_types=1);
  
  namespace Pion\Http\Response\Stream;
  
  interface StreamInterface
  {
    public function body(): string;
  }