<?
  declare(strict_types=1);

  namespace Pion\Actions\Resolver;

  use Pion\Actions\ActionInterface;
  use Pion\Actions\Resolver\Argument\Metadata\Exceptions\UnknownParameterTypeException;
  use Pion\Actions\Resolver\Argument\Metadata\ReflectionArgumentMetadata;
  use Pion\Actions\Resolver\Argument\Value\ValueResolverInterface;
  use Pion\Actions\Resolver\Exceptions\InvalidArgumentTypeException;
  use Pion\Actions\Resolver\Exceptions\UnresolvedArgumentException;
  use Pion\Application\Exceptions\ActionHaveToBeCallableException;

  class ActionArgumentsResolver implements ActionArgumentsResolverInterface
  {
    /**
     * @var ValueResolverInterface[]
     */
    private array $valueResolvers;

    public function __construct(ValueResolverInterface...$valueResolvers)
    {
      $this->valueResolvers = $valueResolvers;
    }

    /**
     * @return mixed[]
     * @throws ActionHaveToBeCallableException
     * @throws UnknownParameterTypeException
     * @throws InvalidArgumentTypeException
     * @throws UnresolvedArgumentException
     * @throws \ReflectionException
     */
    public function resolve(ActionInterface $action): array
    {
      $invoke = (new \ReflectionClass($action))->getMethod("__invoke");
      if ($invoke === null) {
        throw new ActionHaveToBeCallableException($action);
      }
      $arguments = [];
      foreach ($invoke->getParameters() as $argumentReflection) {
        $argumentMetadata = new ReflectionArgumentMetadata($argumentReflection);
        $value = null;
        $isResolved = false;
        foreach ($this->valueResolvers as $valueResolver) {
          if ($valueResolver->isSupported($argumentMetadata)) {
            $value = $valueResolver->value($argumentMetadata);
            $isResolved = true;
          }
        }

        if (!$isResolved && $argumentReflection->isDefaultValueAvailable()) {
          $value = $argumentReflection->getDefaultValue();
        }

        if ($value === null && !$argumentReflection->allowsNull()) {
          throw new UnresolvedArgumentException($argumentReflection->getName());
        }

        $valueType = \is_object($value) ? \get_class($value) : \gettype($value);
        if (
          $value !== null
          && $argumentMetadata->type()->name() !== $valueType
          && (
            \is_object($value)
            && !is_subclass_of(
              $valueType,
              $argumentMetadata->type()->name()
            )
          )
        ) {
          throw new InvalidArgumentTypeException(
            $argumentMetadata->type()->name(),
            $valueType
          );
        }
        $arguments[] = $value;
      }
      return $arguments;
    }
  }