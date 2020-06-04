<?
  declare(strict_types=1);

  namespace Pion\Actions\Resolver\Exceptions;

  final class InvalidActionClassException extends \Exception
  {
    public function __construct(string $actionClass)
    {
      parent::__construct("Action class [{$actionClass}] is invalid");
    }
  }