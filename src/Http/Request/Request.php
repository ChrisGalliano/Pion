<?
  declare(strict_types=1);
  
  namespace Pion\Http\Request;
  
  use GuzzleHttp\Psr7\Uri;
  use Pion\Http\Request\Method\Get;
  use Pion\Http\Request\Method\Post;
  use Pion\Http\Request\Method\RequestMethodInterface;
  use Pion\Http\Request\Parameters\Parameters;
  use Pion\Http\Request\Parameters\ParametersInterface;
  use Psr\Http\Message\UriInterface;

  class Request implements RequestInterface
  {
    public function uri(): UriInterface
    {
      return (new Uri())
          ->withScheme(
              (
                  $this->server()->has('HTTPS')
                  && $this->server()->require('HTTPS') === 'on'
              ) ? 'https' : 'http'
          )->withHost($this->server()->require('HTTP_HOST'))
          ->withPath($this->server()->require('REQUEST_URI'))
          ->withQuery($this->server()->require('REQUEST_URI'));
    }
    
    public function method(): RequestMethodInterface
    {
      return $this->server()->require('REQUEST_METHOD') === 'POST'
          ? new Post()
          : new Get();
    }
    
    public function get(): ParametersInterface
    {
      return new Parameters($_GET);
    }
    
    public function post(): ParametersInterface
    {
      return new Parameters($_POST);
    }
    
    public function cookies(): ParametersInterface
    {
      return new Parameters($_COOKIE);
    }
    
    public function server(): ParametersInterface
    {
      return new Parameters($_SERVER);
    }
  }