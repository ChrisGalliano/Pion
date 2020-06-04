<?
  declare(strict_types=1);

  namespace Pion\Actions\Resolver;

  use Pion\Actions\ActionInterface;

  interface ActionArgumentsResolverInterface
  {
    /**
     * @return mixed[]
     */
    public function resolve(ActionInterface $action): array;
  }