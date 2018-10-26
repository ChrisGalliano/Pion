<?
  declare(strict_types=1);
  
  namespace Pion\Http\Response\Status;
  
  final class StatusNotFound implements StatusInterface
  {
    public function code(): int
    {
      return 404;
    }
    
    public function text(): string
    {
      return 'Not Found';
    }
  }