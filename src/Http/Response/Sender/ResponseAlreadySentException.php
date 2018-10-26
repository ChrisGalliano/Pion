<?
  declare(strict_types=1);
  
  namespace Pion\Http\Response\Sender;
  
  final class ResponseAlreadySentException extends \Exception
  {
    public function __construct()
    {
      parent::__construct('Response already sent');
    }
  }