<?
  declare(strict_types=1);

  namespace Pion\Actions\Resolver\Argument\Metadata\Exceptions;

  final class UnknownParameterTypeException extends \Exception
  {
    public function __construct(string $key)
    {
      parent::__construct("Unknown type of [{$key}] parameter");
    }
  }