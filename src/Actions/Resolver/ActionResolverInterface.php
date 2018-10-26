<?
  declare(strict_types=1);
  
  namespace Pion\Actions\Resolver;
  
  use Pion\Actions\ActionInterface;

  interface ActionResolverInterface
  {
    public function resolve(string $actionClass) : ActionInterface;
  }