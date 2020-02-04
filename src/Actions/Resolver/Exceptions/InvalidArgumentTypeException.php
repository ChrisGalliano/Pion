<?
  declare(strict_types=1);

  namespace Pion\Actions\Resolver\Exceptions;

  final class InvalidArgumentTypeException extends \Exception
  {
    public function __construct(string $expected, string $resolved)
    {
      parent::__construct(
        "Invalid argument resolving result expected type {$expected},
      type {$resolved} was resolved"
      );
    }
  }