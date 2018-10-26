<?
  declare(strict_types=1);
  
  namespace Pion\Http\Request\Method;
  
  final class Post implements RequestMethodInterface
  {
    public function type(): string
    {
      return RequestMethodInterface::POST;
    }
  }