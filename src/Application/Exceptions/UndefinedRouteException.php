<?
  declare(strict_types=1);
  
  namespace Pion\Application\Exceptions;
  
  use Pion\Http\Request\RequestInterface;

  final class UndefinedRouteException extends \Exception
  {
    public function __construct(RequestInterface $request)
    {
      parent::__construct('Undefined route ' . $request->uri()->__toString());
    }
  }