<?php
  declare(strict_types=1);

  namespace Pion\Application\Exceptions;

  final class InvalidActionResponseException extends \Exception
  {
    public function __construct(string $actionClass)
    {
      parent::__construct("Invalid action ([{$actionClass}]) response");
    }
  }