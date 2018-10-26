<?
  declare(strict_types=1);
  
  namespace Pion\Http\Request;
  
  use Pion\Http\Request\Method\RequestMethodInterface;
  use Pion\Http\Request\Parameters\ParametersInterface;
  use Psr\Http\Message\UriInterface;

  interface RequestInterface
  {
    public function uri(): UriInterface;

    public function method(): RequestMethodInterface;
    
    public function get(): ParametersInterface;
    
    public function post(): ParametersInterface;
    
    public function cookies(): ParametersInterface;
    
    public function server(): ParametersInterface;
  }