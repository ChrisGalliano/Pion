<?php
  declare(strict_types=1);

  namespace Pion\Application\Exceptions;

  use Pion\Actions\ActionInterface;

  final class InvalidActionResponseException extends \Exception
  {
    public function __construct(ActionInterface $action)
    {
      $actionClass = \get_class($action);
      parent::__construct("Invalid action ([{$actionClass}]) response");
    }
  }