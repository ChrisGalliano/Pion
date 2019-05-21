<?
  declare(strict_types=1);

  namespace Pion\Forms\Elements\Validation\Collection;

  final class UndefinedValidationResultException extends \Exception
  {
    public function __construct(string $name)
    {
      parent::__construct("Not found validation result for element $name");
    }
  }