<?
  declare(strict_types=1);

  namespace Pion\Templating\Assets\Manager\Exceptions;

  final class UndefinedSectionException extends \Exception
  {
    public function __construct(string $name)
    {
      parent::__construct("Section with name {$name} does not exist");
    }
  }