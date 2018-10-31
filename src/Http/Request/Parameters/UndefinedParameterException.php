<?
  declare(strict_types=1);

  namespace Pion\Http\Request\Parameters;

  final class UndefinedParameterException extends \Exception
  {
    public function __construct(string $key)
    {
      parent::__construct("Parameter {$key} was not found");
    }
  }