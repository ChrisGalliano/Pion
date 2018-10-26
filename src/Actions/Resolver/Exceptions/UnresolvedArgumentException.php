<?
  declare(strict_types=1);
  
  namespace Pion\Actions\Resolver\Exceptions;
  
  final class UnresolvedArgumentException extends \Exception
  {
    public function __construct(string $argument)
    {
      parent::__construct("Required argument {$argument} was not resolved");
    }
  }