<?
  declare(strict_types=1);

  namespace Pion\Actions\Resolver;

  use Pion\Actions\ActionInterface;
  use Pion\Actions\Resolver\Argument\Metadata\ReflectionArgumentMetadata;
  use Pion\Actions\Resolver\Argument\Value\ValueResolverInterface;
  use Pion\Actions\Resolver\Exceptions\InvalidActionClassException;
  use Pion\Actions\Resolver\Exceptions\InvalidArgumentTypeException;
  use Pion\Actions\Resolver\Exceptions\UnresolvedArgumentException;

  class ActionResolver implements ActionResolverInterface
  {
    /**
     * @var \Pion\Actions\Resolver\Argument\Value\ValueResolverInterface[]
     */
    private $valueResolvers;

    public function __construct(ValueResolverInterface... $valueResolvers)
    {
      $this->valueResolvers = $valueResolvers;
    }

    /**
     * @throws \ReflectionException
     * @throws \Pion\Actions\Resolver\Exceptions\InvalidActionClassException
     * @throws \Pion\Actions\Resolver\Argument\Metadata\Exceptions\UnknownParameterTypeException
     * @throws \Pion\Actions\Resolver\Exceptions\InvalidArgumentTypeException
     * @throws \Pion\Actions\Resolver\Exceptions\UnresolvedArgumentException
     */
    public function resolve(string $actionClass): ActionInterface
    {
      if (
        !class_exists($actionClass)
        || !is_subclass_of($actionClass, ActionInterface::class)
      ) {
        throw new InvalidActionClassException($actionClass);
      }

      $constructor = (new \ReflectionClass($actionClass))->getConstructor();
      $arguments = [];
      if ($constructor !== null) {
        foreach ($constructor->getParameters() as $argumentReflection) {
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

          if ($value !== null && $argumentMetadata->type()->name() !== \gettype($value)) {
            throw new InvalidArgumentTypeException(
              $argumentMetadata->type()->name(),
              \gettype($value)
            );
          }
          $arguments[] = $value;
        }
      }
      return new $actionClass(...$arguments);
    }
  }