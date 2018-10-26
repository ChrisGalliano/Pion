<?
  declare(strict_types=1);
  
  namespace Pion\Http\Request\Method;
  
  interface RequestMethodInterface
  {
    public const POST = 'post';
    public const GET  = 'get';
    
    public function type(): string;
  }