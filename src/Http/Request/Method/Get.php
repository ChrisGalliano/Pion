<?
  declare(strict_types=1);
  
  namespace Pion\Http\Request\Method;
  
  final class Get implements RequestMethodInterface
  {
    public function type(): string
    {
      return RequestMethodInterface::GET;
    }
  }