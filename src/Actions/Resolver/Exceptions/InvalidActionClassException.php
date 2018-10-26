<?
  declare(strict_types=1);
  
  namespace Pion\Actions\Resolver\Exceptions;
  
  final class InvalidActionClassException extends \Exception
  {
    public function __construct(string $action)
    {
      parent::__construct("Action class [{$action}] is invalid");
    }
  }